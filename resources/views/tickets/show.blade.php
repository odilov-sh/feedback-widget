@extends('layout')

@section('title', 'Ticket Details')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Ticket #{{ $ticket->id }}</h2>
            <a href="{{ route('dashboard.tickets.index') }}" class="btn btn-secondary btn-sm">
                ← Back to Tickets
            </a>
        </div>
        <div class="table-responsive shadow-sm bg-white">
            <table class="table table-striped table-bordered align-middle mb-0">
                <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $ticket->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $ticket->customer->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $ticket->customer->email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $ticket->customer->phone }}</td>
                </tr>
                <tr>
                    <th>Subject</th>
                    <td>{{ $ticket->subject }}</td>
                </tr>
                <tr>
                    <th>Text</th>
                    <td>{{ $ticket->text }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>@include('tickets._change-status',compact('ticket'))</td>
                </tr>
                <tr>
                    <th>Responded At</th>
                    <td>{{ $ticket->responded_at?->format('Y-m-d H:i') }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                <tr>
                    <th>Files</th>
                    <td>

                        @if ($ticket->media->isEmpty())
                            <i class="text-secondary">No files provided</i>
                        @else
                            <ul style="list-style: none" class="list-group">
                                @foreach ($ticket->media as $media)
                                    <li class="">
                                        {{ $media->name .'.'. $media->extension }}
                                        <a href="{{ route('dashboard.tickets.download-media', $media) }}" class="">Download</a>
                                    </li>
                                @endforeach
                            </ul>

                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
