<?php

namespace App\Controller;

use App\Entity\Coach;
use App\Form\CoachType;
use App\Repository\CoachRepository;
use http\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoachController extends AbstractController
{
    #[Route('/coach', name: 'app_coach')]
    public function index(CoachRepository $coachRepository): Response
    {

        $lstCoach = $coachRepository->findAll();

        return $this->render('coach/index.html.twig', [
            'controller_name' => 'CoachController',
            'lstCoach' => $lstCoach,
        ]);

    }



    //######################## Show coach #########################\\
    #[Route('/Coach/{id}', name: 'app_coach_show')]
    public function show(Coach $coach): Response
    {
        $sportCoach = $coach->getSports();
        dump($sportCoach);

        return $this->render('coach/show.html.twig', [
            'controller_name' => 'CoachController',
            'coach' => $coach,
            'sports' => $sportCoach,
        ]);
    }

    //######################## edit coach #########################\\
    #[Route('{id}/editCoach', name: 'app_coach_edit')]
    public function edit(Request $request, Coach $coach, CoachRepository $coachRepository): Response
    {
        $form = $this->createForm(CoachType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coachRepository->save($coach, true);

            return $this->redirectToRoute('app_coach', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coach/edit.html.twig', [
            'coach' => $coach,
            'form' => $form,
        ]);
    }

    //######################## new coach #########################\\
    #[Route('/newCoach', name: 'app_coach_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CoachRepository $coachRepository): Response
    {
        $coach = new Coach();
        $form = $this->createForm(CoachType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $coachRepository->save($coach, true);

            return $this->redirectToRoute('app_coach', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coach/new.html.twig', [
            'coach' => $coach,
            'form' => $form,
        ]);
    }

    //######################## delete coach #########################\\

    #[Route('/{id}', name: 'app_coach_delete', methods: ['POST'])]
    public function delete(Request $request, Coach $coach, CoachRepository $coachRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coach->getId(), $request->request->get('_token'))) {
            $coachRepository->remove($coach, true);
        }

        return $this->redirectToRoute('app_coach', [], Response::HTTP_SEE_OTHER);
    }
}
