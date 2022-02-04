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
         $category = $this->createCategory('php');
         $category = $this->createCategory('symfony');
         $category = $this->createCategory('swift');
         $category = $this->createCategory('news');
         $category = $this->createCategory('article');
         $manager->persist($category);
         $manager->flush();
    }
    public function createCategory(string $name)
    {
        $category = new Category();
        $category->setName($name);
        return $category;
    }
}
