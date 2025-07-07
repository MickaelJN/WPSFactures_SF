<?php

namespace App\Entity\AccountingDocument;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Customer\Customer;
use App\Entity\Traits\TimestampableTrait;

#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
class AccountingDocument
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $reference = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(length: 200)]
    private ?string $customerName = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $customerAddress = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $customerAddress2 = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $customerZipCode = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $customerCity = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $customerCountry = null;

    #[ORM\Column(length: 20)]
    private ?string $customerType = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $totalWithTax = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $totalExcludeTax = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $totalTax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(string $customerName): static
    {
        $this->customerName = $customerName;

        return $this;
    }

    public function getCustomerAddress(): ?string
    {
        return $this->customerAddress;
    }

    public function setCustomerAddress(?string $customerAddress): static
    {
        $this->customerAddress = $customerAddress;

        return $this;
    }

    public function getCustomerAddress2(): ?string
    {
        return $this->customerAddress2;
    }

    public function setCustomerAddress2(?string $customerAddress2): static
    {
        $this->customerAddress2 = $customerAddress2;

        return $this;
    }

    public function getCustomerZipCode(): ?string
    {
        return $this->customerZipCode;
    }

    public function setCustomerZipCode(?string $customerZipCode): static
    {
        $this->customerZipCode = $customerZipCode;

        return $this;
    }

    public function getCustomerCity(): ?string
    {
        return $this->customerCity;
    }

    public function setCustomerCity(?string $customerCity): static
    {
        $this->customerCity = $customerCity;

        return $this;
    }

    public function getCustomerCountry(): ?string
    {
        return $this->customerCountry;
    }

    public function setCustomerCountry(?string $customerCountry): static
    {
        $this->customerCountry = $customerCountry;

        return $this;
    }

    public function getCustomerType(): ?string
    {
        return $this->customerType;
    }

    public function setCustomerType(string $customerType): static
    {
        $this->customerType = $customerType;

        return $this;
    }

    public function getTotalWithTax(): ?string
    {
        return $this->totalWithTax;
    }

    public function setTotalWithTax(string $totalWithTax): static
    {
        $this->totalWithTax = $totalWithTax;

        return $this;
    }

    public function getTotalExcludeTax(): ?string
    {
        return $this->totalExcludeTax;
    }

    public function setTotalExcludeTax(?string $totalExcludeTax): static
    {
        $this->totalExcludeTax = $totalExcludeTax;

        return $this;
    }

    public function getTotalTax(): ?string
    {
        return $this->totalTax;
    }

    public function setTotalTax(?string $totalTax): static
    {
        $this->totalTax = $totalTax;

        return $this;
    }
}
