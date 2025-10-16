<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        Customer::each(function ($customer) {
            $count = fake()->numberBetween(1, 3);

            Ticket::factory($count)
                ->hasFile(fake()->boolean())
                ->create([
                    'customer_id' => $customer->id,
                ]);
        });
    }
}
