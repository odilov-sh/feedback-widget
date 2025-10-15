<?php

namespace App\Http\Controllers\Api;

use App\Services\TicketService;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;

class TicketController extends Controller
{
    public function __construct(
        private TicketService $ticketService,
    ) {}

    public function store(TicketRequest $request)
    {
        $this->ticketService->storeTicket($request->toData());

        return response()->json([
            'message' => 'Your feedback has been sent successfully.',
        ]);
    }
}
