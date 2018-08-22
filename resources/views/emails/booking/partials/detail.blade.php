<tr>
    <td class="w320">
        <table class="table-common">
            <tr>
                <td class="mini-container-left">
                    <table class="table-detail">
                        <tr>
                            <td class="mini-block-padding">
                                <table id="templateContainerMiddle">
                                    <tr>
                                        <td class="bodyContent td-detail">
                                            <h3><strong>@lang('email.tour.head')</strong></h3>
                                            <p>@lang('email.tour.name') <strong>{{ $tour->name }}</strong></p>
                                            <p>@lang('message.from'): <span class="price">{{ $tour->price }}</span></p>
                                            <p>@lang('message.number_of_days') <strong>{{ $tour->duration }}</strong></p>
                                            <p>@lang('message.itinerary') <strong>{{ $tour->itinerary }}</strong></p>
                                            <p>@lang('email.tour.number-of-seats') <strong>{{ $tour->number_of_seats }}</strong></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="mini-block-padding td-border">
                                <table id="templateContainerMiddle" >
                                    <tr>
                                        <td class="bodyContent td-detail">
                                            <h3><strong>@lang('email.booking.head')</strong></h3>
                                            <p>@lang('email.booking.passenger') <strong>{{ $booking->user->name }}</strong></p>
                                            <p>@lang('message.capacity'): <strong>{{ $booking->number_of_passengers }}</strong></p>
                                            <p>@lang('message.date-booking'): <strong>{{ $booking->booking_date }}</strong></p>
                                            <p>@lang('message.total'): {{ $booking->grand_total }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
