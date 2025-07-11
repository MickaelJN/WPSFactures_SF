<?php

namespace App\DTO;

class CustomerDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $address,
        public readonly ?string $address2,
        public readonly ?string $zipCode,
        public readonly ?string $city,
        public readonly ?string $country,
        public readonly ?string $type,
        public readonly ?string $vatNumber,
        public readonly ?string $number,
    ) {
    }
}