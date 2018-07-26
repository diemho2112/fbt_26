@extends('admin.layout.app')

@section('content')
    <div class="row content">
        <div class="col-sm-3">
            @include('admin.layout.sidebar')
        </div>
        <div class="col-sm-9">
            <div class="row justify-content-center">
                <h2>@lang('message.list-of-reviews')</h2>
            </div>
            <table class="table text-center">
                <thead class="thead-dark">
                <tr>
                    <th>@lang('message.user')</th>
                    {{--                    <th>@lang('message.tour')</th>--}}
                    <th>@lang('message.title')</th>
                    <th>@lang('message.content')</th>
                    <th>@lang('message.delete')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td>
                        {{--                        <td>{{ $booking->tour->name }}</td>--}}
                        <td>{{ $review->number_of_passengers }}</td>
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