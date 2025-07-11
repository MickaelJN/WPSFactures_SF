<?php

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Customer\Customer;
use App\Repository\CompanyRepository;
use App\Entity\AccountingDocument\AccountingDocument;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company extends Customer
{

    #[ORM\Column(length: 100)]
    private ?string $companyName = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $companyVatNumber = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $companyNumber = null;

    public function copyDataToDocument(AccountingDocument $document): void
    {
        parent::copyDataToDocument($document);
        $document->setCustomerCompanyVatNumber($this->getCompanyVatNumber());
        $document->setCustomerCompanyNumber($this->getCompanyNumber());
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): static
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getCompanyVatNumber(): ?string
    {
        return $this->companyVatNumber;
    }

    public function setCompanyVatNumber(?string $companyVatNumber): static
    {
        $this->companyVatNumber = $companyVatNumber;

        return $this;
    }

    public function getCompanyNumber(): ?string
    {
        return $this->companyNumber;
    }

    public function setCompanyNumber(?string $companyNumber): static
    {
        $this->companyNumber = $companyNumber;

        return $this;
    }

    public function getDisplayName(): string
    {
        return $this->companyName;
    }

    public function getType(): string
    {
        return "professionnel";
    }
}
