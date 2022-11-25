<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\User;
use App\Repository\LessonRepository;
use App\Repository\StateRepository;
use ContainerRiS27O4\getSecurity_Validator_UserPasswordService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'app_planning')]
    public function index( LessonRepository $lesson , StateRepository $stateRepository): Response
    {

        $events = $lesson->findAll();

        $lessons = [];

        foreach ($events as $event){
            $lessons[] = [
                'title' => $event->getName(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'place'=> $event->getNbPlace(),
                'coach'=> $event->getCoach(),
                'allDay' => false,
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
                'id' => $event->getId(),
            ];
        }
        $data = json_encode($lessons);


        return $this->render('planning/index.html.twig', compact('data'));

    }


    /*************************** Join Lesson ***************************/
    /*******************************************************************/

    #[Route('/join/{lesson}', name: 'join')]
    public function join(Lesson $lesson, LessonRepository $lessonRepository, StateRepository $stateRepository ): Response
    {
        /**
         * @var User $currentParticipant
         */
        $currentParticipant = $this->getUser();

        if($lesson->getState()->getWording() == 'Activity closed'){
            throw $this->createAccessDeniedException('Vous ne pouvez pas vous inscrire');
        }

        $lesson->addParticipant($currentParticipant);



        if ( count($lesson->getParticipants()) == $lesson->getNbPlace()){
            $stateClosed = $stateRepository->findOneBy(['wording' => 'Activity closed']);
            $lesson->setState($stateClosed);
        }


        $lessonRepository->save($lesson, true);
        $this->addFlash("success","Inscription validée.");
        return $this->redirectToRoute('app_planning');

    }


    /*************************** desist Lesson ***************************/
    /*******************************************************************/

    #[Route('/desist/{lesson}', name: 'desist')]
    public function desist(Lesson $lesson, LessonRepository $lessonRepository, StateRepository $stateRepository ): Response
    {
        /**
         * @var User $currentParticipant
         */
        $currentParticipant = $this->getUser();

        $lesson->removeParticipant($currentParticipant);
        if (count($lesson->getParticipants()) < $lesson->getNbPlace()){
            $stateOpened = $stateRepository->findOneBy(['wording' => 'Activity opened']);
            $lesson->setState($stateOpened);
        }

        $lessonRepository->save($lesson, true);
        $this->addFlash("success","Désistement validé.");
        return $this->redirectToRoute('app_planning');

    }

}
