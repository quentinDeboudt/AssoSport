<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\User;
use App\Repository\LessonRepository;
use App\Repository\StateRepository;
use ContainerRiS27O4\getSecurity_Validator_UserPasswordService;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Echo_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use function MongoDB\BSON\toJSON;

class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'app_planning')]
    public function index( LessonRepository $lesson , StateRepository $stateRepository): Response
    {

        $lessons = $lesson->findAll();


        $dt = new \DateTime();
        $dt->format('d/m/Y H:i:s');

        $stateClosed = $stateRepository->findAll();
        $stateClosed =$stateClosed[0];


        return $this->render('planning/index.html.twig', [
            'lessons' => $lessons,
            'time' => $dt,
            'state' => $stateClosed
        ]);
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
