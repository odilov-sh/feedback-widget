<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ticket;
use App\Models\Customer;
use App\Enums\TicketStatusEnum;

class TicketApiTest extends TestCase
{
    public function test_store_ticket()
    {
        $data = [
            'name'    => $this->faker()->name(),
            'email'   => $this->faker()->email(),
            'phone'   => $this->faker()->e164PhoneNumber(),
            'subject' => $this->faker()->sentence(),
            'text'    => $this->faker()->text(),
        ];

        $this->postJson('/api/tickets', $data)
            ->assertOk();

        $this->assertDatabaseHas(Customer::class, [
            'name'  => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        $this->assertDatabaseHas(Ticket::class, [
            'subject' => $data['subject'],
            'text'    => $data['text'],
            'status'  => TicketStatusEnum::NEW,
        ]);
    }

    public function test_get_ticket_statistics()
    {
        $customer = Customer::factory()->create();

        Ticket::factory()
            ->hasFile(false)
            ->count(10)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $this->getJson('/api/tickets/statistics')
            ->assertOk()
            ->assertJson([
                'today' => Ticket::today()->count(),
                'week'  => Ticket::thisWeek()->count(),
                'month' => Ticket::thisMonth()->count(),
            ]);
    }
}
