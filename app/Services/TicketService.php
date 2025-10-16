<?php

namespace App\Services;

use DB;
use App\Models\Ticket;
use App\Data\TicketData;
use App\Models\Customer;
use App\Enums\TicketStatusEnum;
use Illuminate\Http\UploadedFile;
use App\Repositories\TicketRepository;
use App\Repositories\CustomerRepository;

class TicketService
{
    public function __construct(
        private TicketRepository $ticketRepository,
        private CustomerRepository $customerRepository,
    ) {}

    public function storeTicket(TicketData $data): Ticket
    {
        return DB::transaction(function () use ($data) {
            $customer = $this->findCustomer($data);

            $ticket = $this->ticketRepository->create([
                'customer_id' => $customer->id,
                'subject'     => $data->subject,
                'text'        => $data->text,
                'status'      => TicketStatusEnum::NEW,
            ]);

            if ($data->files) {
                $this->saveFiles($ticket, $data->files);
            }

            return $ticket;
        });
    }

    public function statistics(): array
    {
        return [
            'today' => Ticket::today()->count(),
            'week'  => Ticket::thisWeek()->count(),
            'month' => Ticket::thisMonth()->count(),
        ];
    }

    /**
     * @param  UploadedFile[]  $files
     */
    private function saveFiles(Ticket $ticket, array $files): void
    {
        foreach ($files as $file) {
            $ticket->addMedia($file)->toMediaCollection();
        }
    }

    private function findCustomer(TicketData $data): Customer
    {
        return $this->customerRepository->findOrCreate(
            [
                'email' => $data->email,
                'phone' => $data->phone,
            ],
            [
                'name' => $data->name,
            ],
        );
    }
}
