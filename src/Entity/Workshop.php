<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Workshop
 *
 * @ORM\Table(name="workshop")
 * @ORM\Entity
 * @ApiResource
 */
class Workshop
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups ("workshop:read")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=65535, nullable=false)
     * @Groups ("workshop:read")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", length=65535, nullable=false)
     * @Groups ("workshop:read")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="perfUnity", type="text", length=65535, nullable=false)
     * @Groups ("workshop:read")
     */
    private $perfUnity;

    /**
     * @var string
     *
     * @ORM\Column(name="intensityUnity", type="text", length=65535, nullable=false)
     * @Groups ("workshop:read")
     */
    private $intensityUnity;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     * @Groups ("workshop:read")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=WorkshopCommentary::class, mappedBy="workshop")
     * @Groups ("workshop:read")
     */
    private $commentaries;

    public function __construct()
    {
        $this->commentaries = new ArrayCollection();
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

    public function getPerfUnity(): ?string
    {
        return $this->perfUnity;
    }

    public function setPerfUnity(string $perfUnity): self
    {
        $this->perfUnity = $perfUnity;

        return $this;
    }

    public function getIntensityUnity(): ?string
    {
        return $this->intensityUnity;
    }

    public function setIntensityUnity(string $intensityUnity): self
    {
        $this->intensityUnity = $intensityUnity;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|WorkshopCommentary[]
     */
    public function getCommentaries(): Collection
    {
        return $this->commentaries;
    }

    public function addCommentary(WorkshopCommentary $commentary): self
    {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries[] = $commentary;
            $commentary->setAtelier($this);
        }

        return $this;
    }

    public function removeCommentary(WorkshopCommentary $commentary): self
    {
        if ($this->commentaries->removeElement($commentary)) {
            // set the owning side to null (unless already changed)
            if ($commentary->getAtelier() === $this) {
                $commentary->setAtelier(null);
            }
        }

        return $this;
    }


}
