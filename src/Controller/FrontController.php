<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig');
    }

    #[Route('/phpbasics', name: 'phpbasics')]
    public function phpbasics(): Response
    {
        return $this->render('front/phpbasics.html.twig');
    }
}
