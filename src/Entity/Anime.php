<?php

namespace App\Entity;

use App\Repository\AnimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimeRepository::class)]
class Anime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Auteur = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbEpisode = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbSaison = null;

    #[ORM\Column(nullable: true)]
    private ?int $dureeEp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videoURL = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'anime')]
    private Collection $categories;

    #[ORM\ManyToMany(targetEntity: StudioDanimation::class, mappedBy: 'Anime', cascade: ['persist'])]
    private Collection $studioDanimations;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->studioDanimations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(?string $Auteur): static
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    public function getNbEpisode(): ?int
    {
        return $this->nbEpisode;
    }

    public function setNbEpisode(?int $nbEpisode): static
    {
        $this->nbEpisode = $nbEpisode;

        return $this;
    }

    public function getNbSaison(): ?int
    {
        return $this->nbSaison;
    }

    public function setNbSaison(?int $nbSaison): static
    {
        $this->nbSaison = $nbSaison;

        return $this;
    }

    public function getDureeEp(): ?int
    {
        return $this->dureeEp;
    }

    public function setDureeEp(?int $dureeEp): static
    {
        $this->dureeEp = $dureeEp;

        return $this;
    }

    public function getVideoURL(): ?string
    {
        return $this->videoURL;
    }

    public function setVideoURL(?string $videoURL): static
    {
        $this->videoURL = $videoURL;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addAnime($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeAnime($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, StudioDanimation>
     */
    public function getStudioDanimations(): Collection
    {
        return $this->studioDanimations;
    }

    public function addStudioDanimation(StudioDanimation $studioDanimation): static
    {
        if (!$this->studioDanimations->contains($studioDanimation)) {
            $this->studioDanimations->add($studioDanimation);
            $studioDanimation->addAnime($this);
        }

        return $this;
    }

    public function removeStudioDanimation(StudioDanimation $studioDanimation): static
    {
        if ($this->studioDanimations->removeElement($studioDanimation)) {
            $studioDanimation->removeAnime($this);
        }

        return $this;
    }
}
