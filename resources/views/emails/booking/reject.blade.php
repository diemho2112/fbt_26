@extends('emails.booking.layouts.master')

@section('content')
    <tr>
        <td class="content-padding table-body">
            <center>
                <table class="table-content">
                    <tr>
                        <td class="header-lg">
                            @lang('email.reject.header')
                        </td>
                    </tr>
                    <tr>
                        <td class="free-text accept-content">
                            @lang('email.reject.content')
                        </td>
                    </tr>
                    @include('emails.booking.partials.detail')
                </table>
            </center>
        </td>
    </tr>
    @include('emails.booking.layouts.footer')
@endsection
