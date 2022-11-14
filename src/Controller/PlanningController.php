<?php

namespace App\Controller;

use App\Repository\LessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function MongoDB\BSON\toJSON;

class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'app_planning')]
    public function index( LessonRepository $lesson): Response
    {
        $lessons = $lesson->findAll();

        return $this->render('planning/index.html.twig', [
            'lessons' => $lessons,
        ]);
    }
}
