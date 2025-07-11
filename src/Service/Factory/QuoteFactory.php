<?php

namespace App\Service\Factory;

use App\Entity\AccountingDocument\Enum\QuoteStatus;
use App\Entity\Customer\Customer;
use App\Entity\AccountingDocument\Quote;

class QuoteFactory
{
    // On importe la logique de gestion du client
    use AccountingDocumentLogicTrait;

    /**
     * Crée un nouveau devis vierge pour un client donné.
     */
    public function createWithDefaultParams(): Quote
    {
        $quote = new Quote();
        //supprimer la ligne suivante car doublon avec le workflow
        $quote->setStatus(QuoteStatus::Draft);
        //Ici mettre les params par defaut du devis qui peuvent être dans les params généraux ou propres au client ex: exemption TVA, currency

        return $quote;
    }

    /**
     * Crée un nouveau devis en dupliquant un devis existant.
     */
    public function createFromQuote(Quote $originalQuote): Quote
    {
        $newQuote = new Quote();

        // On initialise le client à partir du devis original
        $newQuote->setCustomer($originalQuote->getCustomer());
        $newQuote->setStatus(QuoteStatus::Draft);

        //faire ceci qu'une fois le devis n'est plus en brouillon
        //$this->setCustomerData($newQuote, $originalQuote->getCustomer());

        /*
        // On duplique les lignes du devis
        foreach ($originalQuote->getLignes() as $ligneOriginale) {
            $nouvelleLigne = new LigneQuote();
            $nouvelleLigne->setDescription($ligneOriginale->getDescription());
            $nouvelleLigne->setQuantite($ligneOriginale->getQuantite());
            $nouvelleLigne->setPrixUnitaire($ligneOriginale->getPrixUnitaire());
            $nouvelleLigne->setTauxTVA($ligneOriginale->getTauxTVA());

            // Assurez-vous d'avoir une méthode addLigne dans votre entité Quote
            $nouveauQuote->addLigne($nouvelleLigne);
        }

        Ici ajouter un calcul sur les champs total ou les recopier ?
        */

        return $newQuote;
    }
}
