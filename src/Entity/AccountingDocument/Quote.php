<?php

namespace App\Entity\AccountingDocument;

use App\DTO\CustomerDTO;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuoteRepository;
use App\Entity\AccountingDocument\Invoice;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\AccountingDocument\Enum\QuoteStatus;
use App\Entity\AccountingDocument\AccountingDocument;

#[ORM\Entity(repositoryClass: QuoteRepository::class)]
class Quote extends AccountingDocument
{
    #[ORM\Column(type: 'string', length: 30, enumType: QuoteStatus::class)]
    private QuoteStatus $status = QuoteStatus::Draft;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $expirationDate = null;

    /**
     * @var Collection<int, Invoice>
     */
    #[ORM\OneToMany(targetEntity: Invoice::class, mappedBy: 'quote')]
    private Collection $invoices;

    public function __construct()
    {
        $this->invoices = new ArrayCollection();
    }

    public function getStatus(): ?QuoteStatus
    {
        return $this->status;
    }

    public function setStatus(QuoteStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeImmutable
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(?\DateTimeImmutable $expirationDate): static
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * @return Collection<int, Invoice>
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): static
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices->add($invoice);
            $invoice->setQuote($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): static
    {
        if ($this->invoices->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getQuote() === $this) {
                $invoice->setQuote(null);
            }
        }

        return $this;
    }

    public function getDisplayCustomerData(): CustomerDTO
    {
        if ($this->getStatus() === QuoteStatus::Draft && $this->getCustomer()) {
            return $this->getCustomerDataFromRelation();
        }

        return parent::getDisplayCustomerData();
    }
}