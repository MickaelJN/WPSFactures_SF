<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Customer\Customer;
use App\Repository\IndividualRepository;
use App\Entity\AccountingDocument\AccountingDocument;

#[ORM\Entity(repositoryClass: IndividualRepository::class)]
class Individual extends Customer
{

    #[ORM\Column(length: 100)]
    private ?string $lastname = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $firstname = null;

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getType(): string
    {
        return "particulier";
    }
}
