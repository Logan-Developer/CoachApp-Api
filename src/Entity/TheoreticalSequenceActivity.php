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
class TheoreticalSequenceActivity
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
     * @ORM\Column(name="perfGoal", type="float", precision=10, scale=0, nullable=false)
     */
    private $perfGoal;

    /**
     * @var float
     *
     * @ORM\Column(name="goalIntensity", type="float", precision=10, scale=0, nullable=false)
     */
    private $goalIntensity;

    /**
     * @ORM\Column(type="integer")
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity=TheoreticalSequence::class, inversedBy="TheoreticalSequenceActivity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theoreticalSequenceId;

    /**
     * @ORM\ManyToOne(targetEntity=Workshop::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $workshopId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerfGoal(): ?float
    {
        return $this->perfGoal;
    }

    public function setPerfGoal(float $perfGoal): self
    {
        $this->perfGoal = $perfGoal;

        return $this;
    }

    public function getGoalIntensity(): ?float
    {
        return $this->goalIntensity;
    }

    public function setGoalIntensity(float $goalIntensity): self
    {
        $this->goalIntensity = $goalIntensity;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(int $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getTheoreticalSequenceId(): ?TheoreticalSequence
    {
        return $this->theoreticalSequenceId;
    }

    public function setTheoreticalSequenceId(?TheoreticalSequence $theoreticalSequenceId): self
    {
        $this->theoreticalSequenceId = $theoreticalSequenceId;

        return $this;
    }

    public function getWorkshopId(): ?Workshop
    {
        return $this->workshopId;
    }

    public function setWorkshopId(?Workshop $workshopId): self
    {
        $this->workshopId = $workshopId;

        return $this;
    }
}
