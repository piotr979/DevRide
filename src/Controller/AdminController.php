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
       $articles = $this->doctrine->getRepository(Article::class)->findAll();
        return $this->render('admin/articles.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/new-article', name: 'new-article')]
    public function newArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->doctrine->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash('notice','Your article has been saved');
            return $this->redirectToRoute('articles');
        }
        return $this->render('admin/new-article.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/edit-article/{id}', name: 'edit-article')]
    public function editArticle($id, Request $request, ManagerRegistry $doctrine): Response
    {
        $article = $doctrine->getRepository(Article::class)->find($id);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $em = $doctrine->getManager();
           $em->persist($article);
           $em->flush();
           return $this->redirectToRoute('articles');
        }
        return $this->render('admin/edit-article.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/article-delete/{id}', name: 'article-delete')]
    public function articleDelete($id)
    {
        $article = $this->doctrine->getRepository(Article::class)->find($id);
        $em = $this->doctrine->getManager();
        $em->remove($article);
        $em->flush();
        $this->addFlash('notice','Item has been removed.');
        return $this->redirectToRoute('articles');
    }

    #[Route('/website-settings', name: 'website-settings')]
    public function websiteSettings()
    {
        return $this->render('admin/website-settings.html.twig');
    }

}
