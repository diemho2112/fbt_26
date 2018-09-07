<?php

return [
    'request' => [
        'header' => 'You have received a new booking request!',
        'content' => 'PLease review carefully and confirm this request:',
        'accept' => 'Accept',
        'reject' => 'Reject'
    ],
    'accept' => [
        'header' => 'Thank you for your booking!',
        'content' => 'The requirement for booking is accepted. We make sure that you are satisfied with our service!
            We hope you enjoy your time with us.',
    ],
    'reject' => [
        'header' => 'We missed you!',
        'content' => 'We regret to inform you that the requirement for booking is rejected because of some problems. 
            Thank you for booking with the tour! We hope to meet you as soon as possible.',
    ],
    'cancel' => [
        'header' => 'We missed you!',
        'content' => 'We regret to inform you that the tour that have already booked is not existing or cancelled. 
            Thank you for booking with the tour! We hope to meet you as soon as possible.',
    ],
    'tour' => [
        'head' => 'Tour Detail',
        'name' => 'Tour Name:',
        'number-of-seats' => 'Number of seats:'
    ],
    'booking' => [
        'head' => 'Booking Detail',
        'passenger' => 'Booking Passenger:',
        'number-of-seats' => 'Number of seats:'
    ],
    'company' => 'ADP Inc',
    'address' => '16 Ly Thuong Kiet Street',
    'no-notification' => 'Notifications',
    'after-user-booking' => 'Your booking is being processed. Please wait for our response',
    'seats-is-over' => 'Sorry! The number of seats in this tour is over.',
    'after-accept-successful' => 'This booking has been accepted',
    'after-accepted-already' => 'This booking has already been accepted by another administrator.',
    'after-reject-successful' => 'This booking has been rejected',
    'after-rejected-already' => 'This booking has already been rejected by you or another administrator.',
];
