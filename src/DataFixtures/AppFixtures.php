<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use App\Entity\Lesson;
use App\Entity\Location;
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

        $location2 = new Location();
        $location2 ->setName('Terrain Exterieur');
        $location2 ->setAddress('rue du sport');

        $manager->persist($location2);
        $manager->flush();

        $lesson1 = new Lesson();
        $lesson1
            ->setName("test")
            ->setAllDay(false)
            ->setStartTime(date_create('2022-11-09 16:00:00'))
            ->setEndTime(date_create('2022-11-09 17:00:00'))
            ->setCoach( $Coach2)
            ->setLocation($location1)
            ->setBackgroundColor('#B00020')
            ->setBorderColor('#004D7B')
            ->setTextColor('#FFFFFF')
            ->setNbPlace(32)
        ;
        $manager->persist($lesson1);
        $manager->flush();







    }

}
