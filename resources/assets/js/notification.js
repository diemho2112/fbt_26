var notifications = [];

var NOTIFICATION_TYPES = {
    newBooking: 'App\\Notifications\\NewBookingRequest',
    acceptBooking: 'App\\Notifications\\BookingAccepted',
    rejectBooking: 'App\\Notifications\\BookingRejected',
};

$(document).ready(function () {
    if (Laravel.userId) {
        $.get('/notifications', function (data) {
            addNotifications(data, "#notifications");
        });
    }
});

function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if (notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications');
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">' + Lang.get('notification.no-notification') + '</li>');
        $(target).removeClass('has-notifications');
    }
}

function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);

    return '<li class="dropdown li-notification"><a class="nav-item border-info a-notification" href="' + to + '">' + notificationText + '</a></li>';
}

function routeNotification(notification) {
    var to = '?read=' + notification.id;
    if (notification.type === NOTIFICATION_TYPES.newBooking) {
        to = route('booking.list') + to;
    } else if (notification.type === NOTIFICATION_TYPES.acceptBooking || notification.type === NOTIFICATION_TYPES.rejectBooking) {
        to = route('booking.index') + to;
    }

    return to;
}

function makeNotificationText(notification) {
    var text = '';
    var tour = notification.data.booking_tour;
    if (notification.type === NOTIFICATION_TYPES.newBooking) {
        var passenger = notification.data.booking_user;
        text += Lang.get('notification.receive-booking-request') + ' <strong>' + tour + '</strong> '+ Lang.get('notification.from') + ' <strong>' + passenger + '</strong>';
    }

    if (notification.type === NOTIFICATION_TYPES.acceptBooking) {
        text += Lang.get('notification.accept-booking-notification', { tour_name : tour });
    }

    if (notification.type === NOTIFICATION_TYPES.rejectBooking) {
        text += Lang.get('notification.reject-booking-notification', { tour_name : tour });
    }

    return text;
}
