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

    /**
     * @param  UploadedFile[]|null  $files
     */
    private function saveFiles(Ticket $ticket, array $files): void
    {
        foreach ($files as $file) {
            $path = $file->store('ticket-files');

            $ticket->addMediaFromDisk($path)->toMediaCollection('ticket-files');
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
