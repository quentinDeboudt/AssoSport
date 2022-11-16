<?php

namespace App\Controller;

use App\Repository\LessonRepository;
use ContainerRiS27O4\getSecurity_Validator_UserPasswordService;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Echo_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'app_planning')]
    public function index( LessonRepository $lesson): Response
    {

        $lessons = $lesson->findAll();


        $dt = new \DateTime();
        $dt->format('d/m/Y H:i:s');

        return $this->render('planning/index.html.twig', [
            'lessons' => $lessons,
            'time' => $dt,
        ]);
    }
}
