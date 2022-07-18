<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use App\Services\TinyMCEProcessor;

#[Route('admin')]
class AdminController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /* Main route of admin page */
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

            // converts all <chapter> tags to navigator chapters
            $article->setContent(TinyMCEProcessor::convertToChapter($article->getContent()));
            $em->persist($article);
            $em->flush();

            $this->addFlash('notice', 'Your article has been saved');
            return $this->redirectToRoute('articles');
        }
        return $this->render('admin/new-article.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/edit-article/{id}', name: 'edit-article')]
    public function editArticle(Article $article, Request $request): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->doctrine->getManager();
            $article->setContent(TinyMCEProcessor::convertToChapter($article->getContent()));
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('articles');
        }
        return $this->render('admin/edit-article.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/categories', name: 'categories')]
    public function categories(Request $request)
    {
        $categories = $this->doctrine->getRepository(Category::class)->findAll();
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newCat = $form->getData()->getName();
            // check for duplicate  
            if (in_array($newCat, $categories)) {
                $this->addFlash(
                   'notice',
                   'Category exists. Enter different name.'
                );    
            } else if ($newCat === '') {
                $this->addFlash(
                    'notice',
                    'Field was blank. Enter category name.'
                );
            } else {
                $em = $this->doctrine->getManager();
                $em->persist($category);
                $em->flush();
                $this->addFlash(
                    'notice',
                    'New category has been created.'
                );
            };
            return $this->redirectToRoute('categories');
        }
        
        return $this->render('admin/categories.html.twig', [
            'categories' => $categories,
            'catForm' => $form->createView()
        ]);
    }
    
    #[Route('/category-save/{id}/{name}', name: 'category-save')]
    public function categorySave($id, $name = "nothing")
    {
        $category = $this->doctrine->getRepository(Category::class)->find($id);
        $category->setName($name);
        $em = $this->doctrine->getManager();
        $em->persist($category);
        $em->flush();
        return $this->redirectToRoute('categories');
    }

    #[Route('/article-delete/{id}', name: 'article-delete')]
    public function articleDelete($id)
    {
        $article = $this->doctrine->getRepository(Article::class)->find($id);
        $em = $this->doctrine->getManager();
        $em->remove($article);
        $em->flush();
        $this->addFlash('notice', 'Item has been removed.');
        return $this->redirectToRoute('articles');
    }

    #[Route('/category-delete/{id}', name: 'category-delete')]
    public function categoryDelete($id)
    {
        $category = $this->doctrine->getRepository(Category::class)->find($id);
        $em = $this->doctrine->getManager();
        $em->remove($category);
        $em->flush();
        $this->addFlash('notice', 'Item has been removed.');
        return $this->redirectToRoute('categories');
    }

    #[Route('/website-settings', name: 'website-settings')]
    public function websiteSettings()
    {
        return $this->render('admin/website-settings.html.twig');
    }
}
