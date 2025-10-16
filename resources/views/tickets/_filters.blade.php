@php use App\Enums\TicketStatusEnum; @endphp

<div class="mt-2 mb-2">
    <form action="" id="ticket-filter-form" class="">
        <table class="table">
            <tr>
                <td>
                    <label class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" value="{{ request('name') }}"
                           placeholder="Search by name">
                </td>
                <td>
                    <label class="form-label">Email</label>

                    <input class="form-control" type="text" name="email" value="{{ request('email') }}"
                           placeholder="Search by email">
                </td>
                <td>
                    <label class="form-label">Phone</label>
                    <input class="form-control" type="text" name="phone" value="{{ request('phone') }}"
                           placeholder="Search by phone">
                </td>
                <td>
                    <label class="form-label">Status</label>

                    <select class="form-select" name="status">
                        <option value="">Select status</option>
                        @foreach(TicketStatusEnum::cases() as $case)
                            <option value="{{ $case->value }}" @selected(request('status') == $case->value)>{{ $case->title() }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <label class="form-label">Date</label>
                    <input class="form-control" type="date" name="date" value="{{ request('date') }}"
                           placeholder="Search by date">
                </td>
                <td>
                    <div class="justify-content-end" style="margin-top: 30px;">
                        <button class="btn btn-primary mr-2" type="submit">Search</button>
                        <a href="{{ route('dashboard.tickets.index') }}" class="btn btn-danger">Reset</a>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>