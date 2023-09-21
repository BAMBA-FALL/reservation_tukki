<?php

namespace App\Controller;

use App\Entity\CarouselHotel;
use App\Form\CarouselHotelType;
use App\Repository\CarouselHotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/carousel/hotel')]
class AdminCarouselHotelController extends AbstractController
{
    #[Route('/', name: 'app_admin_carousel_hotel_index', methods: ['GET'])]
    public function index(CarouselHotelRepository $carouselHotelRepository): Response
    {
        return $this->render('admin_carousel_hotel/index.html.twig', [
            'carousel_hotels' => $carouselHotelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_carousel_hotel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carouselHotel = new CarouselHotel();
        $form = $this->createForm(CarouselHotelType::class, $carouselHotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carouselHotel);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_carousel_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_carousel_hotel/new.html.twig', [
            'carousel_hotel' => $carouselHotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_carousel_hotel_show', methods: ['GET'])]
    public function show(CarouselHotel $carouselHotel): Response
    {
        return $this->render('admin_carousel_hotel/show.html.twig', [
            'carousel_hotel' => $carouselHotel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_carousel_hotel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CarouselHotel $carouselHotel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarouselHotelType::class, $carouselHotel, ["isNew"=>false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_carousel_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_carousel_hotel/edit.html.twig', [
            'carousel_hotel' => $carouselHotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_carousel_hotel_delete', methods: ['POST'])]
    public function delete(Request $request, CarouselHotel $carouselHotel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carouselHotel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($carouselHotel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_carousel_hotel_index', [], Response::HTTP_SEE_OTHER);
    }
}
