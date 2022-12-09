<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/profile', name: 'app_user_profile')]
    public function index( Request $request,EntityManagerInterface $manager,
                            UserPasswordHasherInterface $hasherPassword, UserRepository $userRepository , FileUploader $fileUploader): Response
    {
        $user = $this->security->getUser();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('password')->getData()) {

                $hashPassword = $hasherPassword->hashPassword($user, $form->get('password')->getData());
                $user->setPassword($hashPassword);
                $manager->persist($user);
                $manager->flush();
                $this->addFlash('succes', 'Mot de passe modifié avec succès.');
                return $this->redirectToRoute('app_home');
            }
            //###################image#######################

            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $product->setBrochureFilename($newFilename);
            }


            ###############################################

            $user = $form->getData();


            $manager->persist($user);

            $manager->flush();

            $this->addFlash('success', 'Profil modifié avec succès.');


        }



        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'editProfilForm' => $form->createView(),
            'user' => $user,
        ]);
    }
}
