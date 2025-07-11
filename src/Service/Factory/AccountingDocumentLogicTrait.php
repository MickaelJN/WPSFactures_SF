<?php

namespace App\Service\Factory;

use App\Entity\Client;
use App\Entity\Customer\Customer;
use App\Entity\AccountingDocument\AccountingDocument;

trait AccountingDocumentLogicTrait
{
    /**
     * Initialise un document avec un client et copie ses données pour les "geler".
     *
     * @param AccountingDocument $document Le devis ou la facture à initialiser.
     * @param Customer $customer Le client source.
     */
    private function setCustomerData(AccountingDocument $document, Customer $customer): void
    {
        // Définit la relation ManyToOne pour la logique interne
        $document->setCustomer($customer);

        // Copie des données pour l'affichage sur les documents (immutabilité)
        $document->setCustomerName($customer->getDisplayName());
        $document->setCustomerAddress($customer->getAddress());
        $document->setCustomerAddress2($customer->getAddress2());
        $document->setCustomerZipCode($customer->getZipCode());
        $document->setCustomerCity($customer->getCity());
        $document->setCustomerCountry($customer->getCountry());
        $document->setCustomerCity($customer->getCity());
    }
}