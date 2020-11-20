<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private ?string $fname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $lname;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $dateAdded;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $dateChanged;

    /**
     * @ORM\OneToMany(targetEntity=Blog::class, mappedBy="user")
     */
    private $blogs;

    public function __construct()
    {
        $this->blogs = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(string $fname): self
    {
        $this->fname = $fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->lname;
    }

    public function setLname(string $lname): self
    {
        $this->lname = $lname;

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

    /**
     * @return Collection|Blog[]
     */
    public function getBlogs(): Collection
    {
        return $this->blogs;
    }

    public function addBlog(Blog $blog): self
    {
        if (!$this->blogs->contains($blog)) {
            $this->blogs[] = $blog;
            $blog->setUser($this);
        }

        return $this;
    }

    public function removeBlog(Blog $blog): self
    {
        if ($this->blogs->removeElement($blog)) {
            // set the owning side to null (unless already changed)
            if ($blog->getUser() === $this) {
                $blog->setUser(null);
            }
        }

        return $this;
    }


}
