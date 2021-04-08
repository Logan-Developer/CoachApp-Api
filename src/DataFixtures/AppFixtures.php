<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setFirstname('Bob');
        $user->setLastname('Sponge');
        $user->setEmail('bob.sponge@gmail.com');
        $user->setLogin('bsponge');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$M29mdnI3Yllndy9SUnJtUA$z/NNWjaaZP1JU6ll0aRKbJe3r4ISUdNFJO35SF5rqGs');
        $manager->persist($user);
        $manager->flush();
    }
}
