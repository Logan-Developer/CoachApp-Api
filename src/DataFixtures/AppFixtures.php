<?php

namespace App\DataFixtures;

use App\Entity\Drink;
use App\Entity\User;
use App\Entity\Workshop;
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

        $user = new User();
        $user->setFirstname('Admin');
        $user->setLastname('Admin');
        $user->setEmail('admin.admin@gmail.com');
        $user->setLogin('admin');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$M29mdnI3Yllndy9SUnJtUA$z/NNWjaaZP1JU6ll0aRKbJe3r4ISUdNFJO35SF5rqGs');
        $manager->persist($user);


        $workshop = new Workshop();
        $workshop->setTitle('Atelier de musculation pure');
        $workshop->setDescription('Un atelier pour les fous de musculation! Tout le monde peut y participer!');
        $workshop->setIntensityUnity("All levels");
        $workshop->setPerfUnity("Unity");
        $workshop->setImage('Workshop_boxe.png');
        $manager->persist($workshop);

        $drink = new Drink();
        $drink->setTitle('Bière');
        $drink->setDescription('Une boisson déconseillée à la salle de sport');
        $drink->setImage('Workshop_drink.png');
        $manager->persist($drink);

        $manager->flush();
    }
}
