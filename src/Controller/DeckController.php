<?php

namespace App\Controller;

use App\Entity\Deck;
use App\Form\DeckType;
use App\Repository\{DeckRepository, CarteRepository};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request,Response};
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/deck")
 */
class DeckController extends AbstractController
{
    /**
     * @Route("/", name="deck_index", methods={"GET"})
     */
    public function index(DeckRepository $deckRepository): Response
    {
        //return $this->render('deck/index.html.twig', [
        return $this->render('one_page/liste.html.twig', [
            'decks' => $deckRepository->findBy(array('createur'=> $this->getUser())),
            'titre' => "Affichage des decks"
        ]);
    }

    /**
     * @Route("/new", name="deck_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $deck = new Deck();
        $form = $this->createForm(DeckType::class, $deck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deck->setCreateur($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deck);
            $entityManager->flush();

            return $this->redirectToRoute('deck_index');
        }

        //return $this->render('deck/new.html.twig', [
        return $this->render('one_page/form.html.twig', [
            'deck' => $deck,
            'form' => $form->createView(),
            'titre' => "Création de Deck"
        ]);
    }

    /**
     * @Route("/{id}", name="deck_show", methods={"GET"})
     */
    public function show(Deck $deck): Response
    {
        //return $this->render('deck/show.html.twig', [
        return $this->render('one_page/show.html.twig', [
            'deck' => $deck,
            'ListeCarteDeck' => $deck->getDeckCartes(),
            'titre' => "Détail du deck"
        ]);
    }

    /**
     * @Route("/{id}/edit", name="deck_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Deck $deck, CarteRepository $cartes): Response
    {
        $form = $this->createForm(DeckType::class, $deck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('deck_index');
        }

        //return $this->render('deck/edit.html.twig', [
        return $this->render('one_page/constructionDeck.html.twig', [
            'deck' => $deck,
            'ListeCarteDeck' => $deck->getDeckCartes(),
            'cartes' => $cartes->findAll(),
            'form' => $form->createView(),
            'titre' => "Modifier le deck"
        ]);
    }

    /**
     * @Route("/{id}", name="deck_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Deck $deck): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deck->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($deck);
            $entityManager->flush();
        }

        return $this->redirectToRoute('deck_index');
    }
}
