<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
/**
 * @Vich\Uploadable
 */
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lastname;

    #[ORM\Column(type: 'date', nullable: true)]
    private DateTimeInterface $birthdate;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: "authors")]
    private $country;

    #[ORM\OneToMany(mappedBy: "author", targetEntity: Book::class)]
    private $books;

    #[ORM\Column(type: 'string')]
    private ?string $authorImageName = null;

    /**
     * @Vich\UploadableField(mapping="author_img", fileNameProperty="authorImageName")
     *
     */
    private $authorImageFile;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;


    #[Pure] public function __toString() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry( $country_id)
    {
        $this->country = $country_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @param mixed $books
     */
    public function setBooks($books): void
    {
        $this->books = $books;
    }


    public function setAuthorImageFile(?File $authorImageFile = null): void
    {
        $this->authorImageFile = $authorImageFile;

        if (null !== $authorImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getAuthorImageFile(): ?File
    {
        return $this->authorImageFile;
    }

    public function setAuthorImageName(?string $CoverImageName): void
    {
        $this->authorImageName = $CoverImageName;
    }

    public function getAuthorImageName(): ?string
    {
        return $this->authorImageName ;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
