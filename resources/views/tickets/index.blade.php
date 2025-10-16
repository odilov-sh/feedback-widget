@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Dashboard</a>
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="mb-4 fw-semibold text-center">Tickets</h2>

        @include('tickets._filters')


        <div class="table-responsive shadow-sm bg-white">


            <table class="table table-striped table-bordered align-middle mb-0">
                <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->customer->name }}</td>
                        <td>{{ $ticket->customer->email }}</td>
                        <td>{{ $ticket->customer->phone }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>
                            @include('tickets._change-status', compact('ticket'))
                        </td>
                        <td>
                            {{ $ticket->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('dashboard.tickets.show', $ticket) }}"
                               class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                {!! $tickets->links() !!}
                </tfoot>
            </table>
        </div>
    </div>
@endsection
