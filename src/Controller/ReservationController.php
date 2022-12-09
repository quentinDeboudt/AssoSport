<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\LessonRepository;
use App\Repository\UserRepository;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(UserRepository $userRepository, LessonRepository $lessonRepository): Response
    {


        $lstUserLesson2 = $userRepository->findUserLesson();
        //dd($lstUserLesson2);

        //$lstUserLesson = $user->findUserLesson();

        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'lstLesson' => $lstUserLesson,
        ]);
    }
}