<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\ContactType;
use App\Form\SubscribeType;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /* Main route of front page */
    #[Route('/', name: 'main')]
    public function index(Request $request): Response
    {
        $articles = $this->doctrine->getRepository(Article::class)->findAll();
        $subscribeForm = $this->createForm(SubscribeType::class);
        $subscribeForm->handleRequest($request);
        if ($subscribeForm->isSubmitted() && $subscribeForm->isValid()) {
            $subscriberData = $subscribeForm->getData();
        }
        return $this->render('front/index.html.twig', [
            'articles' => $articles,
            'subscribeForm' => $subscribeForm->createView()
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            // TO BE DONE
            
        }
        return $this->render('front/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /* Article page (dark one) */
    #[Route('/article-read/{id}', name: 'article-read')]
    public function articleRead($id)
    {
        $article = $this->doctrine->getRepository(Article::class)->find($id);
        return $this->render('front/article-read.html.twig', [
            'article' => $article
        ]);
    }

    #[Route('/articles-category/{category}', name: 'articles-category')]
    public function articlesByCategory($category)
    {
        $articles = $this->doctrine->getRepository(Article::class)->findByCategory($category);
        return $this->render('front/articles-by-category.html.twig', [
            'articles' => $articles,
            'category' => $category
        ]);
    }
}
