<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Enums\TicketStatusEnum;
use Illuminate\Validation\Rule;
use App\Services\DashboardTicketService;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TicketController extends Controller
{
    public function __construct(
        private DashboardTicketService $dashboardTicketService,
    ) {}

    public function index()
    {
        $tickets = $this->dashboardTicketService->tickets();

        return view('tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('dashboard.tickets.index');
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
