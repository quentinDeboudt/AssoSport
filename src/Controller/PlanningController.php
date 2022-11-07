<?php

namespace App\Controller;

use App\Repository\LessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'app_planning')]
    public function index( LessonRepository $lesson): Response
    {
        $events = $lesson->findAll();

        $rdvs = [];
        foreach ($events as $event){
            $rdvs[] =[
                'id' => $event->getId(),
                'Start' => $event->getStartTime()->format('Y-m-d H:i:s'),
                'end' => $event->getEndTime()->format('Y-m-d H:i:s'),
                'title' => $event->getName(),
                'Coach' => $event->getCoach(),
                'location' => $event->getLocation(),
                'participants' => $event->getParticipants(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
                'AllDay' => $event->isAllDay(),
                'NbPlace' => $event->getNbPlace(),
            ];
        }

        $data =json_encode($rdvs);

        return $this->render('planning/index.html.twig', compact('data'));
    }
}
