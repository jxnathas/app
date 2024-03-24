<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CidadaoController extends AbstractController
{
    #[Route('/cidadao', name: 'app_cidadao')]
    public function index(): Response
    {
        return $this->render('cidadao/index.html.twig', [
            'controller_name' => 'CidadaoController',
        ]);
    }
}
