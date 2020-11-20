<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogRepository::class)
 */
class Blog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $dateAdded;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $dateChanged;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $privat;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="blogs")
     */
    private ?Categories $category;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="blogs")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
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

    public function getDateAdded(): ?DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }


    public function getDateChanged(): ?DateTimeInterface
    {
        return $this->dateChanged;
    }

    public function setDateChanged(DateTimeInterface $dateChanged): self
    {
        $this->dateChanged = $dateChanged;

        return $this;
    }

    public function getPrivat(): ?bool
    {
        return $this->privat;
    }

    public function setPrivat(bool $privat): self
    {
        $this->privat = $privat;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
