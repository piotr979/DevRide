<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->buildIconListFromFilenames();exit;
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                'class' => 'article-form__input'
            ]])
            ->add('subtitle', TextType::class, [
                'attr' => [
                    'class' => 'article-form__input'
                ]
            ])
            ->add('icon', ChoiceType::class, [
                'choices' => [
                    'basic' => 0,
                    'second' => 1
                ],
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
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
    private function buildIconListFromFilenames()
    {
        $files = array_diff(scandir('images/article_icons'), ['..','.']);

        dump($files);
    }
}
