<?php

namespace App\Entity\AccountingDocument;

use App\DTO\CustomerDTO;
use Doctrine\DBAL\Types\Types;
use App\Entity\Customer\Company;
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

    #[ORM\Column(length: 200, nullable: true)]
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

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $customerType = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $customerCompanyVatNumber = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $customerCompanyNumber = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $totalWithTax = "0.00";

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $totalExcludeTax = "0.00";

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $totalTax = "0.00";


    public function getDisplayCustomerData(): CustomerDTO
    {
        return new CustomerDTO(
            id: $this->getCustomer()->getId(),
            name: $this->getCustomerName(),
            address: $this->getCustomerAddress(),
            address2: $this->getCustomerAddress2(),
            zipCode: $this->getCustomerZipCode(),
            city: $this->getCustomerCity(),
            country: $this->getCustomerCountry(),
            type: $this->getCustomerType(),
            vatNumber: $this->getCustomerCompanyVatNumber(),
            number: $this->getCustomerCompanyNumber()
        );
    }

    public function getCustomerDataFromRelation(): CustomerDTO
    {
        $customer = $this->getCustomer();
        return new CustomerDTO(
            id: $customer->getId(),
            name: $customer->getDisplayName(),
            address: $customer->getAddress(),
            address2: $customer->getAddress2(),
            zipCode: $customer->getZipCode(),
            city: $customer->getCity(),
            country: $customer->getCountry(),
            type: $customer->getType(),
            vatNumber:  $customer instanceof Company ? $customer->getCompanyVatNumber() : null,
            number: $customer instanceof Company ? $customer->getCompanyNumber() : null
        );
    }


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

    public function setCustomerName(?string $customerName): static
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

    public function getCustomerCompanyVatNumber(): ?string
    {
        return $this->customerCompanyVatNumber;
    }

    public function setCustomerCompanyVatNumber(?string $customerCompanyVatNumber): static
    {
        $this->customerCompanyVatNumber = $customerCompanyVatNumber;

        return $this;
    }

    public function getCustomerCompanyNumber(): ?string
    {
        return $this->customerCompanyNumber;
    }

    public function setCustomerCompanyNumber(?string $customerCompanyNumber): static
    {
        $this->customerCompanyNumber = $customerCompanyNumber;

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
