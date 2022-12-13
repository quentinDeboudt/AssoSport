<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use App\Entity\Lesson;
use App\Entity\Location;
use App\Entity\Sport;
use App\Entity\State;
use App\Entity\User;
use App\Repository\CoachRepository;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use function Symfony\Component\Intl\Countries;

class AppFixtures implements ORMFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher, CoachRepository $coachRepository)
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
            ->setBrochureFilename('uploads/brochures/profile.jpeg')
        ;
        $manager->persist($User1);
        $manager->flush();

        $User2 = new User();
        $User2
            ->setFirstName('Cedric')
            ->setLastName('Renouleau')
            ->setEmail('ced2412@gmail.com')
            ->setRoles((array)'ROLE_USER')
            ->setPassword($hashedPassword)
            ->setIsVerified(true)
            ->setBrochureFilename('Directory/IconProfil.png')
        ;
        $manager->persist($User2);
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

        $location2 = new Location();
        $location2 ->setName('Terrain Exterieur');
        $location2 ->setAddress('rue du sport');

        $manager->persist($location2);
        $manager->flush();

        $State1 = new State();
        $State1 ->setWording('Activity opened');

        $manager->persist($State1);
        $manager->flush();

        $State2 = new State();
        $State2 ->setWording('Activity closed');

        $manager->persist($State2);
        $manager->flush();

        $sport1 = new Sport();
        $sport1->setName('velo');
        $manager->persist($sport1);

        $sport2 = new Sport();
        $sport2->setName('Boxe');
        $manager->persist($sport2);

        $sport3 = new Sport();
        $sport3->setName('Muscul');
        $manager->persist($sport3);
        $manager->flush();


        $lesson1 = new Lesson();
        $lesson1
            ->setName($sport1)
            ->setStart(date_create('2022-12-12 09:53:09'))
            ->setEnd(date_create('2022-12-12 09:53:09'))
            ->setAllDay(false)
            ->setCoach( $Coach2)
            ->setLocation($location1)
            ->setBackgroundColor('#006E90')
            ->setBorderColor('#004D7B')
            ->setTextColor('#FFFFFF')
            ->setNbPlace(32)
            ->setState($State1)
        ;
        $manager->persist($lesson1);
        $manager->flush();
/*
        $lesson2 = new Lesson();
        $lesson2
            ->setName($sport2)
            ->setStart(date_create('22/10/22 10:00:00'))
            ->setEnd(date_create('22/10/22 11:00:00'))
            ->setAllDay(false)
            ->setCoach( $Coach1)
            ->setLocation($location2)
            ->setBackgroundColor('#5B8C5A')
            ->setBorderColor('#004D7B')
            ->setTextColor('#FFFFFF')
            ->setNbPlace(10)
            ->setState($State1)
        ;
        $manager->persist($lesson2);
        $manager->flush();

        $lesson3 = new Lesson();
        $lesson3
            ->setName($sport3)
            ->setStart(date_create('21/10/22 10:00:00'))
            ->setEnd(date_create('21/10/22 11:00:00'))
            ->setAllDay(false)
            ->setCoach( $Coach2)
            ->setLocation($location1)
            ->setBackgroundColor('#F15025')
            ->setBorderColor('#004D7B')
            ->setTextColor('#FFFFFF')
            ->setNbPlace(10)
            ->setState($State1)
        ;
        $manager->persist($lesson3);
        $manager->flush();

*/




    }

}
