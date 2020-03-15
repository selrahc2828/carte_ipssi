<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\{DeckCarte, Carte, Deck};
use App\Repository\DeckCarteRepository; 
use Doctrine\ORM\EntityManagerInterface;

class DeckCarteController extends AbstractController
{

    private $entityManager;
    private $DeckCarteRepository;

    public function __construct(EntityManagerInterface $entityManager, DeckCarteRepository $DeckCarteRepository){
        $this->entityManager = $entityManager;
        $this->DeckCarteRepository = $DeckCarteRepository;
    }

    /**
     * @Route("/deck/carte", name="deck_carte")
     */
    public function index()
    {
        return $this->render('deck_carte/index.html.twig', [
            'controller_name' => 'DeckCarteController',
        ]);
    }

    /**
     * @Route("/ajoutDeck/{carte_id}/{deck_id}", name="ajout_carte")
	 */
    public function ajoutCarte(Carte $carte_id, Deck $deck_id)
    {
    	$deck_carte = $this->DeckCarteRepository->findOneBy(['deck'=>$deck_id,'carte'=>$carte_id]);

		if($deck_carte) {
			$nb_base = $deck_carte->getNombre();
    		$deck_carte->setNombre($nb_base +1);
		}

        $this->entityManager->persist($deck_carte);
        $this->entityManager->flush();

        return $this->redirectToRoute('deck_index');
    }

    /**
     * @Route("/enleverDuDeck/{carte_id}/{deck_id}", name="enleverDuDeck")
	 */
    public function enleverUneCarte(Carte $carte_id, Deck $deck_id)
    {
    	$deck_carte = $this->DeckCarteRepository->findOneBy(['deck'=>$deck_id,'carte'=>$carte_id]);

		if($deck_carte) {
			$nb_base = $deck_carte->getNombre();
    		$deck_carte->setNombre($nb_base -1);
		}

        $this->entityManager->persist($deck_carte);
        $this->entityManager->flush();

        return $this->redirectToRoute('deck_index');
    }
}
