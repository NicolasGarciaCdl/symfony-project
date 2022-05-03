<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: BookRepository::class)]
/**
 * @Vich\Uploadable
 */
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $isbn;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $resume;


    #[ORM\Column(type: 'date')]
    private $year;

    #[ORM\ManyToOne(targetEntity:Author::class, inversedBy: "books")]
    private Author $author;


    #[ORM\ManyToMany(targetEntity: Kind::class, inversedBy: 'books')]
    private $kinds;

    #[ORM\Column(type: 'string')]
    private ?string $coverImageName = null;

    /**
     * @Vich\UploadableField(mapping="book_cover", fileNameProperty="coverImageName")
     *
     */
    private $coverImageFile;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;




    #[Pure] public function __construct()
    {
        $this->kinds = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle( $title)
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Author $author
     */
    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }



    public function getIsbn()
    {
        return $this->isbn;
    }

    public function setIsbn( $isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getKinds()
    {
        return $this->kinds;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume): void
    {
        $this->resume = $resume;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    public function addKind(Kind $kind)
    {
        if(!$this->kinds->contains($kind)){
            $this->kinds->add($kind);
        }
    }

    public function removeKind(Kind $kind)
    {
        if ($this->kinds->contains($kind)) {
            $this->kinds->remove($kind);
        }
    }

    public function setKinds($kinds)
    {
        $this->kinds = $kinds;
    }

    public function setCoverImageFile(?File $coverImageFile = null): void
    {
        $this->coverImageFile = $coverImageFile;

        if (null !== $coverImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getCoverImageFile(): ?File
    {
        return $this->coverImageFile;
    }

    public function setCoverImageName(?string $CoverImageName): void
    {
        $this->coverImageName = $CoverImageName;
    }

    public function getCoverImageName(): ?string
    {
        return $this->coverImageName;
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
