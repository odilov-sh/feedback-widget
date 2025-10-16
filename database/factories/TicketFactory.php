<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public static bool $hasFile = false;

    protected $model = Ticket::class;

    public function definition(): array
    {
        /** @var TicketStatusEnum $status */
        $status = $this->faker->randomElement(TicketStatusEnum::cases());

        $date = Carbon::parse($this->faker->dateTimeBetween('-1 month', 'now'));

        return [
            'subject'      => $this->faker->sentence(),
            'text'         => $this->faker->text(),
            'status'       => $status,
            'responded_at' => $status->isDone() ? $date->copy()->addDay() : null,
            'created_at'   => $date,
            'updated_at'   => $date,

            'customer_id' => Customer::factory(),
        ];
    }

    public function hasFile(bool $value = true): self
    {
        self::$hasFile = $value;

        return $this;
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (self::$hasFile) {
                $image = 'https://placehold.co/400x400/png?text=' . $this->faker->word();

                $ticket->addMediaFromUrl($image)->toMediaCollection();
            }
        });
    }
}
