<?php

namespace App\Controller;

use App\Entity\Productp33;
use App\Repository\CategoryRepository;
use App\Repository\Productp33Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'create_product', methods: ['POST'])]
    public function create(EntityManagerInterface $em, Request $request, CategoryRepository $categoryRepository): Response {
        $product = new Productp33();
        $product->setName($request->request->get('name'));
        $product->setCount($request->request->get('count'));
        $product->setPrice($request->request->get('price'));
        $product->setCategory($categoryRepository->find($request->request->get('category')));

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

    #[Route('/product/{productp33}', name: "formEdit")]
    public function formEdit(CategoryRepository $categoryRepository, Productp33 $productp33): Response
    {


        $categories = $categoryRepository->findAll();


        return $this->render('product/edit.html.twig', ['categories' => $categories, 'productp33' => $productp33]);
    }

    #[Route('/product/create')]
    public function formCreate(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('product/create.html.twig', ['categories' => $categories]);
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
}
