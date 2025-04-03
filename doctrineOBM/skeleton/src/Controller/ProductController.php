<?php

namespace App\Controller;

use App\Entity\Productp33;
use App\Repository\CategoryRepository;
use App\Repository\Productp33Repository;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Core\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'create_product', methods: ['POST'])]
    public function create(
        EntityManagerInterface $em,
        Request $request,
        CategoryRepository $categoryRepository,
        ValidatorInterface $validator
    ): Response {
        $product = new Productp33();
        // Устанавливаем все необходимые поля, включая title
        $product->setTitle($request->request->get('title'));
        $product->setName($request->request->get('name'));
        $product->setCount($request->request->get('count'));
        $product->setPrice($request->request->get('price'));
        $product->setCategory($categoryRepository->find($request->request->get('category')));

        // Выполняем валидацию объекта
        $errors = $validator->validate($product);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            // Возвращаем ошибки с кодом 400 (Bad Request)
            return new Response(implode(', ', $errorMessages), 400);
        }

        $em->persist($product);
        $em->flush();

        return $this->redirect('/');
    }

    #[Route('/product/{productp33}', name: 'delete_product', methods: ['DELETE'])]
    public function delete(Productp33 $productp33, EntityManagerInterface $em): Response {
        $em->remove($productp33);
        $em->flush();

        return $this->redirect('/product');
    }



    #[Route('/product/{productp33}', name: 'edit_product', methods: ['PUT'])]
    public function edit(EntityManagerInterface $em, Request $request, CategoryRepository $categoryRepository, Productp33 $productp33): Response {


        $productp33->setName($request->request->get('name'));
        $productp33->setCount($request->request->get('count'));
        $productp33->setPrice($request->request->get('price'));
        $productp33->setCategory($categoryRepository->find($request->request->get('category')));

        $em->flush();
        return $this->redirect('/');
    }



    #[Route('/product/create', name: 'product_create', methods: ['GET', 'POST'])]
    public function formCreate(
        Request $request,
        CategoryRepository $categoryRepository,
        ValidatorInterface $validator,
        EntityManagerInterface $em
    ): Response {
        if ($request->isMethod('GET')) {
            $categories = $categoryRepository->findAll();
            return $this->render('product/create.html.twig', ['categories' => $categories]);
        }

        if ($request->isMethod('POST')) {


            $product = new Productp33();


            $product->setTitle($request->request->get('title'));
            $product->setName($request->request->get('name'));

            $uploadedFile = $request->files->get('file');

            if ($uploadedFile) {
                $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();
                $targetDirectory = $this->getParameter('uploads_directory');

                try {
                    $uploadedFile->move($targetDirectory, $newFilename);
                    $product->setImagePath($newFilename);
                } catch (FileException $e) {
                    $errorMessages[] = 'Ошибка при загрузке файла: ' . $e->getMessage();
                    $categories = $categoryRepository->findAll();
                    return $this->render('product/create.html.twig', [
                        'categories' => $categories,
                        'errors' => $errorMessages
                    ]);
                }
            }

            $errors = $validator->validate($product);
            if (count($errors) > 0) {
                $errorMessages = [];
                foreach ($errors as $error) {
                    $errorMessages[] = $error->getMessage();
                }
                $categories = $categoryRepository->findAll();
                return $this->render('product/create.html.twig', [
                    'categories' => $categories,
                    'errors' => $errorMessages
                ]);
            }


            $em->persist($product);
            $em->flush();

            return $this->redirect('/product');
        }

        return new Response('Method Not Allowed', 405);
    }

    #[Route('/product/{productp33}', name: "formEdit")]
    public function formEdit(CategoryRepository $categoryRepository, Productp33 $productp33): Response
    {


        $categories = $categoryRepository->findAll();


        return $this->render('product/edit.html.twig', ['categories' => $categories, 'productp33' => $productp33]);
    }

    #[Route('/product', name: 'index_product')]
    public function index(Request $request, Productp33Repository $productp33Repository, CategoryRepository $categoryRepository): Response
    {
        $search = $request->query->get('search');
        $searchByPrice = $request->query->get('searchByPrice');
        $searchByCategory = $request->query->get('searchByCategory');



        $sortField = $request->query->get('sortField');
        $sortDirection = $request->query->get('sortDirection');

        $qb = $productp33Repository->createQueryBuilder('p');

        if ($search) {$qb->andWhere('p.name = :name');$qb->setParameter('name', $search);}
        if ($searchByPrice) {$qb->andWhere('p.price = :price');$qb->setParameter('price', $searchByPrice);}
        if ($searchByCategory) {$qb->andWhere('p.category = :category');$qb->setParameter('category', $searchByCategory);}

        if ($sortField) {$qb->addOrderBy('p.' . $sortField, $sortDirection);}

        $products = $qb->getQuery()->getResult();


        return $this->render('product/index.html.twig', ["products" => $products, "categories" => $categoryRepository->findAll(), "search" => $search, "searchByPrice" => $searchByPrice]);
    }

    #[Route('/product/download')]
    public function download(): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/product.xlsx';

        $file = new File($filePath); 
        return $this->file($file);
    }
}
