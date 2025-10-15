<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        /** @var TicketStatusEnum $status */
        $status = $this->faker->randomElement(TicketStatusEnum::cases());

        return [
            'subject'      => $this->faker->word(),
            'text'         => $this->faker->text(),
            'status'       => $status,
            'responded_at' => $status->isDone() ? now() : null,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),

            'customer_id' => Customer::factory(),
        ];
    }
}
