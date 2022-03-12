<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = $this->createUser('user@user.com', '12345678', []);
        $userAdmin = $this->createUser('admin@admin.com', '123456', ["ROLE_ADMIN"]);
        $manager->persist($user);
        $manager->persist($userAdmin);
        $manager->flush();
    }
    public function createUser(string $email, string $password, array $roles)
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        $user->setRoles($roles);
        return $user;
    }
}
