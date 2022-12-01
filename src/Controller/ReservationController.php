<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function MongoDB\BSON\toJSON;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(): Response
    {

        $user = $this->getUser();
        $lstLessonsUser = $user->getLessons();
        json_encode($lstLessonsUser);
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'lstLesson' => $lstLessonsUser,
        ]);
    }


}
