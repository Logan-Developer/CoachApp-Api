<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ApiResource(
 *     collectionOperations={
 *          "get",
 *          "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 *     itemOperations={
 *          "get",
 *          "put"={"security"="is_granted('ROLE_USER') "}
 *     }
 * )
 */
class User implements UserInterface
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $login;

    /**
     * @ORM\Column(type="string" )
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", unique=true )
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=WorkshopCommentary::class, mappedBy="owner", orphanRemoval=true)
     */
    private $workshopCommentaries;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->id = -1;
        $this->login = "";
        $this->lastname = "";
        $this->firstname = "";
        $this->email = "";
        $this->password = "";
        $this->roles = "";
        $this->workshopCommentaries = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }


    // Required method to answer the UserInterface heritage needs
    public function getUserName(): string
    {
        return $this->login;
    }



    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }

    /**
     * @return Collection|WorkshopCommentary[]
     */
    public function getWorkshopCommentaries(): Collection
    {
        return $this->workshopCommentaries;
    }

    public function addWorkshopCommentary(WorkshopCommentary $workshopCommentary): self
    {
        if (!$this->workshopCommentaries->contains($workshopCommentary)) {
            $this->workshopCommentaries[] = $workshopCommentary;
            $workshopCommentary->setOwner($this);
        }

        return $this;
    }

    public function removeWorkshopCommentary(WorkshopCommentary $workshopCommentary): self
    {
        if ($this->workshopCommentaries->removeElement($workshopCommentary)) {
            // set the owning side to null (unless already changed)
            if ($workshopCommentary->getOwner() === $this) {
                $workshopCommentary->setOwner(null);
            }
        }

        return $this;
    }
}