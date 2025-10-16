<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class TicketFilterRequestData extends Data
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $status = null,
        public ?string $date = null,
    ) {}
}
