@extends('admin.layout.app')

@section('content')
    <div class="row content">
        <div class="col-sm-3">
            @include('admin.layout.sidebar')
        </div>
        <div class="col-sm-9">
            <div class="row justify-content-center">
                <h2>@lang('message.list-of-bookings')</h2>
            </div>
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>@lang('message.user')</th>
                        <th>@lang('message.tour')</th>
                        <th>@lang('message.number_of_passengers')</th>
                        <th>@lang('message.total')</th>
                        <th>@lang('message.date-booking')</th>
                        <th>@lang('message.is_canceled')</th>
                        <th>@lang('message.delete')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->tour->name }}</td>
                        <td>{{ $booking->number_of_passengers }}</td>
                        <td>{{ $booking->grand_total }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->is_canceled }}</td>
                        <td>
                            {!! Form::open(['route' => ['booking.delete', $booking->id], 'method' => 'delete']) !!}
                            {!! Form::submit(trans('message.delete'), ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
@endsection
