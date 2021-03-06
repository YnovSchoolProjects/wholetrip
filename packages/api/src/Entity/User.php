<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * @Groups({"read"})
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"read", "write"})
     */
    private string $username;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Groups({"read", "write"})
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     * @Groups({"read", "write"})
     */
    private string $password;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $activationToken;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read"})
     */
    private bool $active = false;

    /**
     * @ORM\OneToMany(targetEntity=Voyage::class, mappedBy="user", orphanRemoval=true)
     * @Groups({"read", "write"})
     */
    private $voyages;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
    }

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
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

    public function getActivationToken(): string
    {
        return $this->activationToken;
    }

    public function setActivationToken(string $activationToken): void
    {
        $this->activationToken = $activationToken;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addVoyage(Voyage $voyage): self
    {
        if (!$this->voyages->contains($voyage)) {
            $this->voyages[] = $voyage;
            $voyage->setUser($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyages->removeElement($voyage)) {
            // set the owning side to null (unless already changed)
            if ($voyage->getUser() === $this) {
                $voyage->setUser(null);
            }
        }

        return $this;
    }

    public function getRoles()
    {
        return ["ROLE_USER"];
    }

    public function getSalt()
    {
        return "";
    }

    public function eraseCredentials() {}
}
