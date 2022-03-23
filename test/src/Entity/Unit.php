<?php

namespace App\Entity;

use App\Repository\UnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnitRepository::class)
 */
class Unit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=MaterialV2::class, mappedBy="unit")
     */
    private $material;

    public function __construct()
    {
        $this->materialV2s = new ArrayCollection();
        $this->material = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    /**
     * @return Collection<int, MaterialV2>
     */
    public function getMaterial(): Collection
    {
        return $this->material;
    }

    public function addMaterial(MaterialV2 $material): self
    {
        if (!$this->material->contains($material)) {
            $this->material[] = $material;
            $material->setUnit($this);
        }

        return $this;
    }

    public function removeMaterial(MaterialV2 $material): self
    {
        if ($this->material->removeElement($material)) {
            // set the owning side to null (unless already changed)
            if ($material->getUnit() === $this) {
                $material->setUnit(null);
            }
        }

        return $this;
    }
}
