<?php

namespace App\Rules;

use Closure;
use App\Models\Ticket;
use Illuminate\Contracts\Validation\ValidationRule;

class LimitTicketsByEmailRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exist = Ticket::join('customers', 'customers.id', '=', 'tickets.customer_id')
            ->where('customers.email', $value)
            ->today()
            ->exists();

        if ($exist) {
            $fail('You have already created a ticket for this email today.');
        }
    }
}
