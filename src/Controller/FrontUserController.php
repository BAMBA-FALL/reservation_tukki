<?php

namespace App\Controller;
use APP\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontUserController extends AbstractController
{
    #[Route('/user', name: 'app_front_user')]
    public function index(): Response
    {
        //on recupère l'utilisateur connecté 
        $user = $this->getUser();
        //on crée un formulaire de User avec le datas du user connecté et on le passe à la vue
        $form = $this->createForm(UserType::class, $user);
        return $this->render('front_user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
