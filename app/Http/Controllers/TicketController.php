<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Enums\TicketStatusEnum;
use Illuminate\Validation\Rule;
use App\Data\TicketFilterRequestData;
use App\Repositories\TicketRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TicketController extends Controller
{
    public function __construct(
        private TicketRepository $ticketRepository,
    ) {}

    public function index(TicketFilterRequestData $data)
    {
        $tickets = $this->ticketRepository->getTickets($data);

        return view('tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function changeStatus(Ticket $ticket, Request $request)
    {
        $request->validate([
            'status' => ['required', Rule::enum(TicketStatusEnum::class)],
        ]);

        $ticket->status = $request->status;

        if (!$ticket->responded_at) {
            $ticket->responded_at = now();
        }

        $ticket->save();

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        return back();
    }

    public function downloadMedia(Media $media)
    {
        return $media;
    }
}
