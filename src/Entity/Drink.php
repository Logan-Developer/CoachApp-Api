<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DrinkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DrinkRepository::class)
 * @ApiResource
 */
class Drink
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups  ("drink:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("drink:read")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("drink:read")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("drink:read")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=DrinkComment::class, mappedBy="drink")
     * @Groups ("drink:read")
     */
    private $comments;

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

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }
}
