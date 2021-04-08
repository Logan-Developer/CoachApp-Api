<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SequenceCategory
 *
 * @ORM\Table(name="sequencecategory")
 * @ORM\Entity
 * @ApiResource
 */
class SequenceCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=65535, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", length=65535, nullable=false)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=TheoreticalSequence::class, mappedBy="sequenceCategoryId", orphanRemoval=true)
     */
    private $theoreticalSequences;

    public function __construct()
    {
        $this->theoreticalSequences = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|TheoreticalSequence[]
     */
    public function getTheoreticalSequences(): Collection
    {
        return $this->theoreticalSequences;
    }

    public function addTheoreticalSequence(TheoreticalSequence $theoreticalSequence): self
    {
        if (!$this->theoreticalSequences->contains($theoreticalSequence)) {
            $this->theoreticalSequences[] = $theoreticalSequence;
            $theoreticalSequence->setSequenceCategoryId($this);
        }

        return $this;
    }

    public function removeTheoreticalSequence(TheoreticalSequence $theoreticalSequence): self
    {
        if ($this->theoreticalSequences->removeElement($theoreticalSequence)) {
            // set the owning side to null (unless already changed)
            if ($theoreticalSequence->getIdcategoriesequence() === $this) {
                $theoreticalSequence->setIdcategoriesequence(null);
            }
        }

        return $this;
    }


}
