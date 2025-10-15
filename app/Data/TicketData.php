<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Illuminate\Http\UploadedFile;

class TicketData extends Data
{
    /**
     * @param  UploadedFile[]|null  $files
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $subject,
        public string $text,
        public ?array $files = null,
    ) {}

    public function toCustomerData(): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
