<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use App\Entity\Location;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures implements ORMFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager ){
        $User1 = new User();

        // hash the password (based on the security.yaml config for the $user class)
        $plaintextPassword = 'azertyuiop';
        $hashedPassword = $this->passwordHasher->hashPassword(
            $User1,
            $plaintextPassword
        );
        $User1
            ->setFirstName('Quentin')
            ->setLastName('Deboudt')
            ->setEmail('deboudtquentin@gmail.com')
            ->setRoles((array)'ROLE_ADMIN')
            ->setPassword($hashedPassword)
            ->setIsVerified(true)
        ;
        $manager->persist($User1);
        $manager->flush();



        $Coach1 = new Coach();
        $Coach1 ->setName('Romain');
        $manager->persist($Coach1);
        $manager->flush();

        $Coach2 = new Coach();
        $Coach2 ->setName('Mike');
        $manager->persist($Coach2);
        $manager->flush();

        $location1 = new Location();
        $location1 ->setName('Salle de sport');
        $location1 ->setAddress('10 rue de pichorons');

        $manager->persist($location1);
        $manager->flush();
    }
}
