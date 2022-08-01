<?php

namespace App\Form;

use App\Entity\Article;
use App\Repository\CategoryRepository;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Category;

class ArticleType extends AbstractType
{
    private CategoryRepository $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'article-form__input'
                ]
            ])
            ->add('subtitle', TextType::class, [
                'attr' => [
                    'class' => 'article-form__input',
                    'maxLength' => 512
                ]
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('icon', ChoiceType::class, [
                'choices' => $this->buildIconListFromFilenames(),
                'attr' => [
                    'class' => 'article-form__input'
                ]
            ])
            ->add('content', TextareaType::class, [
                'required' => true
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-admin btn-admin__primary'
                ]
            ]);
    }
    private function buildIconListFromFilenames(): array
    {
        // get rid of dots
        $files = array_diff(scandir('images/article_icons/color'), ['..', '.']);

        // remove extensions
        $filesWithoutExtension = array_map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        }, $files);

        // replace dashes and underscoures
        $filenamesFiltered = str_replace(['_', '-'], ' ', $filesWithoutExtension);

        // combine arrays
        return array_combine($filenamesFiltered, $files);
    }
    private function getCategories()
    {

        $result = array_map('current', $this->categoryRepo->getAllCategoriesStripped());
        return array_flip($result);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }
}
