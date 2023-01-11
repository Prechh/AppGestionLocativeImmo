<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[UniqueEntity('title')]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'Votre titre est trop court. Il doit contenir au minimum 5 caractères',
        maxMessage: 'Votre titre est trop long. Il doit contenir au maximum 255 caractères',
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 10,
        max: 400,
        notInRangeMessage: 'Cette valeur doit être comprise entre 10cm² et 400cm²',
    )]
    private ?int $surface = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Range(
        min: 2,
        notInRangeMessage: 'Cette valeur doit être au moins égale à 2',
    )]
    private ?int $rooms = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?int $bedrooms = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?int $floor = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $heat = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull()]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'La valeur de ce champ est trop court. Il doit contenir au minimum 5 caractères',
        maxMessage: 'La valeur de ce champ est trop long. Il doit contenir au maximum 255 caractères',
    )]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull()]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'La valeur de ce champ est trop court. Il doit contenir au minimum 5 caractères',
        maxMessage: 'La valeur de ce champ est trop long. Il doit contenir au maximum 255 caractères',
    )]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex('/^[0-9]{5}$/')]
    private ?string $postal_code = null;

    #[ORM\Column]
    private ?bool $sold = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->created_at = new DateTimeImmutable();
    }

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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function isSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
