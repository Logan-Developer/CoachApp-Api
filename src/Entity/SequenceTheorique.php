<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SequenceTheorique
 *
 * @ORM\Table(name="sequencetheorique")
 * @ORM\Entity
 * @ApiResource
 */
class SequenceTheorique
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
     * @ORM\Column(name="titre", type="text", length=65535, nullable=false)
     */
    private $titre;

    /**
     * @var int
     *
     * @ORM\Column(name="niveau", type="integer", nullable=false)
     */
    private $niveau;

    /**
     * @ORM\OneToMany(targetEntity=ActiviteSequenceTheorique::class, mappedBy="idsequencetheorique", orphanRemoval=true)
     */
    private $activitesequencetheoriques;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieSequence::class, inversedBy="SequenceTheorique")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idcategoriesequence;

    public function __construct()
    {
        $this->activitesequencetheoriques = new ArrayCollection();
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

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection|ActiviteSequenceTheorique[]
     */
    public function getActivitesequencetheoriques(): Collection
    {
        return $this->activitesequencetheoriques;
    }

    public function addActivitesequencetheorique(ActiviteSequenceTheorique $activitesequencetheorique): self
    {
        if (!$this->activitesequencetheoriques->contains($activitesequencetheorique)) {
            $this->activitesequencetheoriques[] = $activitesequencetheorique;
            $activitesequencetheorique->setIdsequencetheorique($this);
        }

        return $this;
    }

    public function removeActivitesequencetheorique(ActiviteSequenceTheorique $activitesequencetheorique): self
    {
        if ($this->activitesequencetheoriques->removeElement($activitesequencetheorique)) {
            // set the owning side to null (unless already changed)
            if ($activitesequencetheorique->getIdsequencetheorique() === $this) {
                $activitesequencetheorique->setIdsequencetheorique(null);
            }
        }

        return $this;
    }

    public function getIdcategoriesequence(): ?CategorieSequence
    {
        return $this->idcategoriesequence;
    }

    public function setIdcategoriesequence(?CategorieSequence $idcategoriesequence): self
    {
        $this->idcategoriesequence = $idcategoriesequence;

        return $this;
    }


}
