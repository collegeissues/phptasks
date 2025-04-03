<?php

namespace App\Entity;

use App\Repository\Productp33Repository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[ORM\Entity(repositoryClass: Productp33Repository::class)]
class Productp33
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Название не должно быть пустым.")]
    private string $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imagePath = null;

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): self
    {
        $this->imagePath = $imagePath;
        return $this;
    }

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $count = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\ManyToOne]
    private ?Category $category = null;




    public function create(ValidatorInterface $validator): Response
    {
        $product = new ProductP33();

        $errors = $validator->validate($product);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        return new Response('Okey');
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): static
    {
        $this->count = $count;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self {
        $this->title = $title ?? 'Untitled';
        return $this;
    }
}
