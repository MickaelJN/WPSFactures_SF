<?php

namespace App\Entity\AccountingDocument\Enum;

enum QuoteStatus: string
{
    case Draft = 'draft';
    case Sent = 'sent';
    case Accepted = 'accepted';
    case Refused = 'refused';
    case PartialInvoiced = 'partial_invoiced';
    case Invoiced = 'invoiced';
    case Expired = 'expired';
    case Canceled = 'canceled';

    // Vous pouvez ajouter de la logique ici
    public function getLabel(): string
    {
        return match ($this) {
            self::Draft => 'Brouillon',
            self::Sent => 'Envoyé',
            self::Accepted => 'Accepté',
            self::Refused => 'Refusé',
            self::PartialInvoiced => 'Partiellement facturé',
            self::Invoiced => 'Facturé',
            self::Expired => 'Expiré',
            self::Canceled => 'Annulé',
        };
    }
}