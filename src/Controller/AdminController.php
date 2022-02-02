<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;

#[Route('admin')]
class AdminController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    #[Route('/', name: 'articles')]
    public function index(): Response
    {
       $em = $this->doctrine->getRepository(Article::class)->findAll();
        return $this->render('admin/articles.html.twig');
    }

    #[Route('/new-article', name: 'new-article')]
    public function newArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form);exit;
        }
        return $this->render('admin/new-article.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/edit-article/{id}', name: 'edit-article')]
    public function editArticle($id): Response
    {
        $article = $this->doctrine->getRepository(Article::class)->find($id);
        $form = $this->createForm(Article::class, $article);
        return $this->render('admin/edit-article.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
