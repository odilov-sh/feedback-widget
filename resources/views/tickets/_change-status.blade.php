@php use App\Enums\TicketStatusEnum; @endphp
<select class="form-select ticket-status-select" data-id="{{ $ticket->id }}" style="width: 200px">
    @foreach(TicketStatusEnum::cases() as $case)
        <option value="{{ $case->value }}" @selected($ticket->status === $case)>{{ $case->title() }}</option>
    @endforeach
</select>

@pushonce('scripts')
<script>
    $(function (){

        $('.ticket-status-select').change(function (){
            let ticketId = $(this).data('id');
            let status = $(this).val()

            $.ajax({
                url: '{{ route("dashboard.tickets.change-status", ":id") }}'.replace(':id', ticketId),
                type: 'PUT',
                data: { status },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                success: function (response) {
                    showSuccessToast('Status updated successfully!');
                },
                error: function (xhr) {
                    const errorMessage = xhr.responseJSON?.message || 'Error updating status!';
                    showErrorToast(errorMessage);
                }
            });
        })
    });
</script>
@endpushonce