<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Data\TicketFilterRequestData;
use Illuminate\Pagination\LengthAwarePaginator;

class TicketRepository
{
    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }

    public function getTickets(TicketFilterRequestData $data): LengthAwarePaginator
    {
        return Ticket::query()
            ->select('tickets.*')
            ->join('customers', 'customers.id', '=', 'tickets.customer_id')
            ->when($data->name, fn ($query) => $query->whereLike('customers.name', '%' . $data->name . '%'))
            ->when($data->email, fn ($query) => $query->whereLike('customers.email', '%' . $data->email . '%'))
            ->when($data->phone, fn ($query) => $query->whereLike('customers.phone', '%' . $data->phone . '%'))
            ->when($data->status, fn ($query) => $query->where('tickets.status', $data->status))
            ->when($data->date, fn ($query) => $query->whereDate('tickets.created_at', $data->date))
            ->with('customer')
            ->latest()
            ->paginate()
            ->withQueryString();
    }
}
