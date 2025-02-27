<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $retypepassword = null; // Add this line

    #[ORM\Column(length: 255)]
    private ?string $moreInformation = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(nullable: true)]
    private ?int $casesNumber = null;
    

    // Getters and setters for all properties

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getRetypepassword(): ?string
    {
        return $this->retypepassword;
    }

    public function setRetypepassword(string $retypepassword): static
    {
        $this->retypepassword = $retypepassword;
        return $this;
    }

    public function getMoreInformation(): ?string
    {
        return $this->moreInformation;
    }

    public function setMoreInformation(string $moreInformation): static
    {
        $this->moreInformation = $moreInformation;
        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;
        return $this;
    }

    public function getCasesNumber(): ?int
    {
        return $this->casesNumber;
    }

    public function setCasesNumber(int $casesNumber): static
    {
        $this->casesNumber = $casesNumber;
        return $this;
    }
    // src/Entity/Client.php

 

}
