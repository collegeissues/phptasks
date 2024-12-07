<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(Request $request): Response
    {
        return $this->render('index.html.twig', [
            'name' => $request->query->get('name', 'Человек')
        ]);
    }

    #[Route('/popa', name: 'app_index2')]
    public function popa(Request $request): Response
    {
        return $this->render('index2.html.twig', [
            'name' => $request->query->get('321', '123')
        ]);
    }
}
