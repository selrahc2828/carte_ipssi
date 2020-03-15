<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarteRepository")
 */
class Carte
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="cartes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $PV;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $armure;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attaque;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="cartes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Faction", inversedBy="cartes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $faction;

    /**
     * @ORM\Column(type="integer")
     */
    private $cout;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DeckCarte", mappedBy="carte")
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreateur(): ?Utilisateur
    {
        return $this->createur;
    }

    public function setCreateur(?Utilisateur $createur): self
    {
        $this->createur = $createur;

        return $this;
    }

    public function getPV(): ?int
    {
        return $this->PV;
    }

    public function setPV(?int $PV): self
    {
        $this->PV = $PV;

        return $this;
    }

    public function getArmure(): ?int
    {
        return $this->armure;
    }

    public function setArmure(?int $armure): self
    {
        $this->armure = $armure;

        return $this;
    }

    public function getAttaque(): ?int
    {
        return $this->attaque;
    }

    public function setAttaque(?int $attaque): self
    {
        $this->attaque = $attaque;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFaction(): ?Faction
    {
        return $this->faction;
    }

    public function setFaction(?Faction $faction): self
    {
        $this->faction = $faction;

        return $this;
    }

    public function getCout(): ?int
    {
        return $this->cout;
    }

    public function setCout(int $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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
            $deckCarte->setCarte($this);
        }

        return $this;
    }

    public function removeDeckCarte(DeckCarte $deckCarte): self
    {
        if ($this->deckCartes->contains($deckCarte)) {
            $this->deckCartes->removeElement($deckCarte);
            // set the owning side to null (unless already changed)
            if ($deckCarte->getCarte() === $this) {
                $deckCarte->setCarte(null);
            }
        }

        return $this;
    }
}
