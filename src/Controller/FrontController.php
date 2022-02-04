<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class FrontController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        $articles = $this->doctrine->getRepository(Article::class)->findAll();
        return $this->render('front/index.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/phpbasics', name: 'phpbasics')]
    public function phpbasics(): Response
    {
        return $this->render('front/phpbasics.html.twig');
    }

    #[Route('/article-read/{id}', name: 'article-read')]
    public function articleRead($id)
    {
        $article = $this->doctrine->getRepository(Article::class)->find($id);
        return $this->render('front/article-read.html.twig', [
            'article' => $article
        ]);
    }

}
