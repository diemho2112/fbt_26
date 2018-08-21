<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @include('emails.booking.layouts.style')
</head>

<body>
    <table class="container-for-gmail-android table-common">
        <tr>
            <td>
                <table class="table-header">
                    <tr>
                        <td class="td-header">
                            <center>
                                <table class="table-content">
                                    <tr>
                                        <td class="pull-left mobile-header-padding-left">
                                            <h1>
                                                <a href="{{ route('home') }}">@lang('message.brand')</a>
                                            </h1>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        @yield('content')
    </table>
</body>
</html>
