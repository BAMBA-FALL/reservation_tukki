<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FrontUserController extends AbstractController
{
    #[Route('/user', name: 'app_front_user')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        //on recupère l'utilisateur connecté 
        $user = $this->getUser();
        //on crée un formulaire de User avec le datas du user connecté et on le passe à la vue
        $form = $this->createForm(UserType::class, $user);
        //on hydrate le User avec les données du formulaire posté potentiellement 
        $form->handleRequest($request);
        //on vérifie que le formulaire est soummis et valide
        if($form->isSubmitted() && $form->isValid()){
            // dd($form->getData()); //Recupérer l'instance du Use mais pas les propriétés mapped false
            // dd($form->all()); //Recupérer tous les données (champs) du formulaire y compris les mapped false
            // dd($form->get('plainPassword')->getDat()); //on recupérela donnée d'un champ en particulier y compris les mapped false
            //dd($request->request->get('plainPassword')); //on recupére la valeur d'un champ non pas dans le formulaire, mais dans la requete
            // $request->request récupère les données de la requete POST pour la requête GET  il faut utiliser request->query
            if(!is_null($request->request->get('plainPassword'))){
                $user->setPassword($userPasswordHasherInterface->hashPassword($user, $request->request->get('plainPassword')));
                $entityManagerInterface->persist($user);
            }
            $entityManagerInterface->flush();
        $this->addFlash('success','Votre profil a été bien modifié ');
        //on redirige vers le profile
        return $this->redirectToRoute('app_front_user');
        }
        return $this->render('front_user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
