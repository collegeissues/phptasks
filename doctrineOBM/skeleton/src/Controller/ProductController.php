<?php

namespace App\Controller;

use App\Entity\Productp33;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'create_product', methods: ['POST'])]
    public function create(EntityManagerInterface $em, Request $request): Response {
        $product = new Productp33();
        $product->setName($request->request->get('name'));
        $product->setCount($request->request->get('count'));
        $product->setPrice($request->request->get('coast'));

        $em->persist($product);
        $em->flush();

        return $this->redirect('/');
    }

    #[Route('/product/create')]
    public function formCreate(): Response
    {
        return $this->render('product/create.html.twig');
    }
}
