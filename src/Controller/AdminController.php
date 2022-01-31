<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\NewsArticle;

#[Route('admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'articles')]
    public function index(ManagerRegistry $doctrine): Response
    {
       $em = $doctrine->getRepository(NewsArticle::class)->findAll();
        return $this->render('admin/index.html.twig');
    }

    #[Route('/new-article', name: 'new-article')]
    public function newArticle(): Response
    {
        return $this->render('admin/new-article.html.twig');
    }

    #[Route('/edit-article', name: 'edit-article')]
    public function editArticle(): Response
    {
        return $this->render('admin/edit-article.html.twig');
    }


}
