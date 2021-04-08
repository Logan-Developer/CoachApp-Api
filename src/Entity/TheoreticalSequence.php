<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TheoreticalSequence
 *
 * @ORM\Table(name="theoreticalSequence")
 * @ORM\Entity
 * @ApiResource
 */
class TheoreticalSequence
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
     * @var int
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity=TheoreticalSequenceActivity::class, mappedBy="theoreticalSequenceId", orphanRemoval=true)
     */
    private $theoreticalSequenceActivities;

    /**
     * @ORM\ManyToOne(targetEntity=SequenceCategory::class, inversedBy="TheoreticalSequence")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sequenceCategoryId;

    public function __construct()
    {
        $this->theoreticalSequenceActivities = new ArrayCollection();
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|TheoreticalSequenceActivity[]
     */
    public function getTheoreticalSequenceActivities(): Collection
    {
        return $this->theoreticalSequenceActivities;
    }

    public function addTheoreticalSequenceActivity(TheoreticalSequenceActivity $theoreticalSequenceActivity): self
    {
        if (!$this->theoreticalSequenceActivities->contains($theoreticalSequenceActivity)) {
            $this->theoreticalSequenceActivities[] = $theoreticalSequenceActivity;
            $theoreticalSequenceActivity->setIdsequencetheorique($this);
        }

        return $this;
    }

    public function removeTheoreticalSequenceActivity(TheoreticalSequenceActivity $theoreticalSequenceActivity): self
    {
        if ($this->theoreticalSequenceActivities->removeElement($theoreticalSequenceActivity)) {
            // set the owning side to null (unless already changed)
            if ($theoreticalSequenceActivity->getIdsequencetheorique() === $this) {
                $theoreticalSequenceActivity->setIdsequencetheorique(null);
            }
        }

        return $this;
    }

    public function getSequenceCategoryId(): ?SequenceCategory
    {
        return $this->sequenceCategoryId;
    }

    public function setSequenceCategoryId(?SequenceCategory $sequenceCategoryId): self
    {
        $this->sequenceCategoryId = $sequenceCategoryId;

        return $this;
    }
}
