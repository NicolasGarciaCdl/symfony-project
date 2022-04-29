<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(name: 'code_country', type: 'string', length: 2)]
    private $codeCountry;

    #[ORM\Column(name: 'country_name', type: 'string', length: 50)]
    private $countryName;


    #[ORM\OneToMany(mappedBy: "country", targetEntity: Author::class)]
    private $authors;

    #[Pure] public function __toString() {
        return $this->getCountryName();
    }

    /**
     * @return mixed
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param mixed $author
     */
    public function setAuthors($authors): void
    {
        $this->authors = $authors;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): self
    {
        $this->countryName = $countryName;

        return $this;
    }

    public function getCodeCountry(): ?string
    {
        return $this->code_country;
    }

    public function setCodeCountry(string $code_country): self
    {
        $this->code_country = $code_country;

        return $this;
    }
}
