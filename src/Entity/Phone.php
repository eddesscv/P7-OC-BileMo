<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhoneRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"phone:read"}},
 *     denormalizationContext={"groups"={"phone:write"}}
 * )
 * @ORM\Entity(repositoryClass=PhoneRepository::class)
 * 
 * @UniqueEntity("title")
 */
class Phone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups("phone:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"phone:read", "phone:write"})
     * @Assert\NotBlank(message="Le titre est obligatoire")
     * @Assert\Length(
     *     min = 3,
     *     max = 255
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups({"phone:read", "phone:write"})
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 3
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"phone:read", "phone:write"})
     * @Assert\NotBlank
     * @Assert\Length(
     *     max = 65
     * )
     * @Assert\Regex(
     *     pattern="/^[0-9]+(\.[0-9]{1,2})?$/",
     *     match="true"
     * )
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"phone:read", "phone:write"})
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 3,
     *     max = 25
     * )
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"phone:read", "phone:write"})   
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"phone:read", "phone:write"})
     */
    private $weight;


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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }
}
