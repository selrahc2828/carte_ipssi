<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeckRepository")
 */
class Deck
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\utilisateur", inversedBy="decks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DeckCarte", mappedBy="deck")
     */
    private $deckCartes;

    public function __construct()
    {
        $this->deckCartes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreateur(): ?utilisateur
    {
        return $this->createur;
    }

    public function setCreateur(?utilisateur $createur): self
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * @return Collection|DeckCarte[]
     */
    public function getDeckCartes(): Collection
    {
        return $this->deckCartes;
    }

    public function addDeckCarte(DeckCarte $deckCarte): self
    {
        if (!$this->deckCartes->contains($deckCarte)) {
            $this->deckCartes[] = $deckCarte;
            $deckCarte->setDeck($this);
        }

        return $this;
    }

    public function removeDeckCarte(DeckCarte $deckCarte): self
    {
        if ($this->deckCartes->contains($deckCarte)) {
            $this->deckCartes->removeElement($deckCarte);
            // set the owning side to null (unless already changed)
            if ($deckCarte->getDeck() === $this) {
                $deckCarte->setDeck(null);
            }
        }

        return $this;
    }
}
