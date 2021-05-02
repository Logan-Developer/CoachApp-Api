<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\DrinkCommentRepository;

/**
 * @ORM\Entity(repositoryClass=DrinkCommentRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *          "get",
 *          "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 *     itemOperations={
 *          "get",
 *          "put"={"security"="is_granted('ROLE_USER') and object.getOwner() == user"},
 *          "delete"={"security"="object.getOwner() == user or is_granted('ROLE_ADMIN')"}
 *     }
 * )
 */
class DrinkComment
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     * @Groups ("drink:read")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups ("drink:read")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups ("drink:read")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups ("drink:read")
     * @ApiSubresource()
     */
    private $owner;

    /**
     * @ORM\Column(type="datetime")
     * @Groups ("drink:read")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Drink::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $drink;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDrink(): ?Drink
    {
        return $this->drink;
    }

    public function setDrink(?Drink $drink): self
    {
        $this->drink = $drink;

        return $this;
    }
}
