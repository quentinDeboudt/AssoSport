<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\LessonRepository;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function MongoDB\BSON\toJSON;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(LessonRepository $lessonRepository): Response
    {

        $lstUserLesson = $lessonRepository->findAll();


        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'lstLesson' => $lstUserLesson,
        ]);
    }
}