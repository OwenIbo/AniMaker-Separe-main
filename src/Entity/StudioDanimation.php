<?php

namespace App\Entity;

use App\Repository\StudioDanimationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudioDanimationRepository::class)]
class StudioDanimation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomStudio = null;

    #[ORM\ManyToMany(targetEntity: Anime::class, inversedBy: 'studioDanimations')]
    private Collection $Anime;

    public function __construct()
    {
        $this->Anime = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStudio(): ?string
    {
        return $this->nomStudio;
    }

    public function setNomStudio(string $nomStudio): static
    {
        $this->nomStudio = $nomStudio;

        return $this;
    }

    /**
     * @return Collection<int, Anime>
     */
    public function getAnime(): Collection
    {
        return $this->Anime;
    }

    public function addAnime(Anime $anime): static
    {
        if (!$this->Anime->contains($anime)) {
            $this->Anime->add($anime);
        }

        return $this;
    }

    public function removeAnime(Anime $anime): static
    {
        $this->Anime->removeElement($anime);

        return $this;
    }
}
