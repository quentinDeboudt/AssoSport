<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Form\SportType;
use App\Repository\SportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SportController extends AbstractController
{
    #[Route('/sport', name: 'app_sport')]
    public function index(SportRepository $sportRepository): Response
    {
        $lstSport = $sportRepository->findAll();

        return $this->render('sport/index.html.twig', [
            'controller_name' => 'SportController',
            'lstSport' => $lstSport,
        ]);
    }



    //######################## Show Sport #########################\\
    #[Route('/{id}', name: 'app_sport_show')]
    public function show(Sport $sport): Response
    {

        return $this->render('sport/show.html.twig', [
            'controller_name' => 'SportController',
            'sport' => $sport,
        ]);
    }

    //######################## edit Sport #########################\\
    #[Route('/{id}/edit', name: 'app_sport_edit')]
    public function edit(Request $request, Sport $sport, SportRepository $sportRepository): Response
    {
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $sportRepository->save($sport, true);

            return $this->redirectToRoute('app_sport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sport/edit.html.twig', [
            'sport' => $sport,
            'form' => $form,
        ]);
    }

    //######################## new Sport #########################\\
    #[Route('/new', name: 'app_sport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SportRepository $sportRepository): Response
    {
        $sport = new Sport();
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sportRepository->save($sport, true);

            return $this->redirectToRoute('app_sport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sport/new.html.twig', [
            'sport' => $sport,
            'form' => $form,
        ]);
    }

    //######################## delete Sport #########################\\
    #[Route('/{id}', name: 'app_sport_delete', methods: ['POST'])]
    public function delete(Request $request, Sport $sport, SportRepository $sportRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sport->getId(), $request->request->get('_token'))) {
            $sportRepository->remove($sport, true);
        }

        return $this->redirectToRoute('app_sport', [], Response::HTTP_SEE_OTHER);
    }
}
