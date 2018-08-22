@extends('emails.booking.layouts.master')

@section('content')
    <tr>
        <td class="content-padding table-body">
            <center>
                <table class="table-content">
                    <tr>
                        <td class="header-lg">
                            @lang('email.request.header')
                        </td>
                    </tr>
                    <tr>
                        <td class="free-text">
                            @lang('email.request.content')
                        </td>
                    </tr>
                    <tr>
                        <td class="button td-accept">
                            <div>
                                <a href="{{ route('booking.accept', $booking->id) }}" class="a-confirm">@lang('email.request.accept')</a></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="button">
                            <div>
                                <a href="{{ route('booking.reject', $booking->id) }}" class="a-confirm a-reject">@lang('email.request.reject')</a>
                            </div>
                        </td>
                    </tr>
                    @include('emails.booking.partials.detail')
                </table>
            </center>
        </td>
    </tr>
    @include('emails.booking.layouts.footer')
@endsection
