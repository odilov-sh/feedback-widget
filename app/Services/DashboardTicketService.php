<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardTicketService
{
    public function tickets(): LengthAwarePaginator
    {
        return Ticket::latest()->paginate();
    }
}
