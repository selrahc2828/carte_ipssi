<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Form\CarteType;
use App\Repository\CarteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request ,Response};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/carte")
 */
class CarteController extends AbstractController
{
    /**
     * @Route("/", name="carte_index", methods={"GET"})
     */
    public function index(CarteRepository $carteRepository): Response
    {
        //return $this->render('carte/index.html.twig', [
        return $this->render('one_page/liste.html.twig', [
            'cartes' => $carteRepository->findAll(),
            'titre' => "Affichage des cartes : " 
        ]);
    }

    /**
     * @Route("/new", name="carte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carte = new Carte();
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get("image")->getData();
            $date = new \DateTime();
            $nom_image = "carte_".$date->format('Y-m-d-H-i-s').".".$image->guessExtension();
            $image->move($this->getParameter('dossier_carte'), $nom_image);
            $carte->setImage($nom_image);

            $carte->setCreateur($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carte);
            $entityManager->flush();

            return $this->redirectToRoute('carte_index');
        }

        //return $this->render('carte/new.html.twig', [
        return $this->render('one_page/form.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
            'titre' => "Création de carte : "
        ]);
    }

    /**
     * @Route("/{id}", name="carte_show", methods={"GET"})
     */
    public function show(Carte $carte): Response
    {
        //return $this->render('carte/show.html.twig', [
        return $this->render('one_page/show.html.twig', [
            'carte' => $carte,
            'titre' => "Afficher une carte"
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Carte $carte): Response
    {
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carte_index');
        }

        //return $this->render('carte/edit.html.twig', [
        return $this->render('one_page/form.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
            'titre' => "Modifier la carte : "
        ]);
    }

    /**
     * @Route("/{id}", name="carte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Carte $carte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carte_index');
    }
}
