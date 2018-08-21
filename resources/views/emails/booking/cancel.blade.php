@extends('emails.booking.layouts.master')

@section('content')
    <tr>
        <td class="content-padding table-body">
            <center>
                <table class="table-content">
                    <tr>
                        <td class="header-lg">
                            @lang('email.accept.header')
                        </td>
                    </tr>
                    <tr>
                        <td class="free-text accept-content">
                            @lang('email.accept.content')
                        </td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
    @include('emails.booking.layouts.footer')
@endsection
