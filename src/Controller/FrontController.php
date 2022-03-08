<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /* *********************
    ** MAIN PAGE
    ************************/

    #[Route('/', name: 'main')]
    public function index(): Response
    {
        $articles = $this->doctrine->getRepository(Article::class)->findAll();
        //dump($articles);
        return $this->render('front/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /* *********************
    ** CONTACT
    ************************/

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
        }
        return $this->render('front/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /* *********************
    ** READING ARTICLE (DARKER PAGE)
    ************************/

    #[Route('/article-read/{id}', name: 'article-read')]
    public function articleRead($id)
    {
        $article = $this->doctrine->getRepository(Article::class)->find($id);
        return $this->render('front/article-read.html.twig', [
            'article' => $article
        ]);
    }

      /* *********************
    ** DISPLAY ARTICLES BY CATEGORY 
    ************************/

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
