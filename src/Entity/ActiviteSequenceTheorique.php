<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Activitesequencetype
 *
 * @ORM\Table(name="activitesequencetheorique")
 * @ORM\Entity
 * @ApiResource
 */
class ActiviteSequenceTheorique
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
     * @var float
     *
     * @ORM\Column(name="perfObjectif", type="float", precision=10, scale=0, nullable=false)
     */
    private $perfobjectif;

    /**
     * @var float
     *
     * @ORM\Column(name="intensiteObjectif", type="float", precision=10, scale=0, nullable=false)
     */
    private $intensiteobjectif;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre;

    /**
     * @ORM\ManyToOne(targetEntity=SequenceTheorique::class, inversedBy="ActiviteSequenceTheorique")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idsequencetheorique;

    /**
     * @ORM\ManyToOne(targetEntity=Atelier::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idatelier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerfobjectif(): ?float
    {
        return $this->perfobjectif;
    }

    public function setPerfobjectif(float $perfobjectif): self
    {
        $this->perfobjectif = $perfobjectif;

        return $this;
    }

    public function getIntensiteobjectif(): ?float
    {
        return $this->intensiteobjectif;
    }

    public function setIntensiteobjectif(float $intensiteObjectif): self
    {
        $this->intensiteobjectif = $intensiteObjectif;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getIdsequencetheorique(): ?SequenceTheorique
    {
        return $this->idsequencetheorique;
    }

    public function setIdsequencetheorique(?SequenceTheorique $idsequencetheorique): self
    {
        $this->idsequencetheorique = $idsequencetheorique;

        return $this;
    }

    public function getIdatelier(): ?Atelier
    {
        return $this->idatelier;
    }

    public function setIdatelier(?Atelier $idatelier): self
    {
        $this->idatelier = $idatelier;

        return $this;
    }


}
