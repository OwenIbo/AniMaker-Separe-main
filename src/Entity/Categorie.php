<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Anime::class, inversedBy: 'categories')]
    private Collection $anime;

    public function __construct()
    {
        $this->anime = new ArrayCollection();
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

    /**
     * @return Collection<int, Anime>
     */
    public function getAnime(): Collection
    {
        return $this->anime;
    }

    public function addAnime(Anime $anime): static
    {
        if (!$this->anime->contains($anime)) {
            $this->anime->add($anime);
        }

        return $this;
    }

    public function removeAnime(Anime $anime): static
    {
        $this->anime->removeElement($anime);

        return $this;
    }
}
