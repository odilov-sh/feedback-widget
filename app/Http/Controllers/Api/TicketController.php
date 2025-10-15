<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;

class TicketController extends Controller
{
    public function store(TicketRequest $request)
    {
        return response()->json([
            'message' => 'Your feedback has been sent successfully.',
        ]);
    }
}
