<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            'php',
            'symfony',
            'swift',
            'news',
            'mySQL',
            'twig',
            'html/css',
            'javascript'
        ];
        
        foreach($categories as $category) {
            $catReady = $this->createCategory($category);
            $manager->persist($catReady);
        }
        $manager->flush();
    }
    public function createCategory(string $name)
    {
        $category = new Category();
        $category->setName($name);
        return $category;
    }
}
