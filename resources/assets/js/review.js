$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function () {
    $('.like').click(function () {
        reviewId = $(this).attr('data-id');
        likeCount = parseInt($('#like-count' + reviewId).html());
        $.ajax({
            url: route('like'),
            type: 'POST',
            data: {
                reviewId: reviewId,
                likeCount: likeCount
            },
            success: function success(data) {
                alert(data.message);
                $('#like-count' + reviewId).html(likeCount + data.likeCount);
            },
            error: function(xhr){
                if (xhr.status == 401) {
                    alert('Please login to rate this review!');
                } else {
                    alert("Error: " + xhr.statusText);
                }
            },
        });
        this.classList.toggle('fa-thumbs-down');
    });

    $('#guest-like').click(function () {
        alert('Please login to like this review!');
    });

    $('#rate').submit(function (event) {
        event.preventDefault();
        rate = document.getElementsByName('star');
        for (var i = 0; i < rate.length; i++){
            if (rate[i].checked === true){
                rate = rate[i].value;
            }
        }
        tourId = $('#rate-submit').attr("data-id");
        $.ajax({
            url: route('tour.rate'),
            type: 'POST',
            data: {
                rate: rate,
                tourId : tourId
            },
            success: function success(data) {
                alert(data.message);
            },
            error: function(xhr){
                if (xhr.status == 401) {
                    alert('Please login to rate this review!');
                } else {
                    alert("Error: " + xhr.statusText);
                }
            }
        });
        return false;
    });

    $('.comment-a').click(function () {
        var id = $(this).attr("data-a");
        $('.comment-form' + id).toggle('active');
        $('#commentable_id').val(id);
    });

    $('.reply-a').click(function () {
        var id = $(this).attr("data-a");
        $('.reply-form' + id).toggle('active');
        $('#commentable_id').val(id);
    });

    $('#review').submit(function (event) {
        event.preventDefault();
        title = $('#title').val();
        content = $('#content').val();
        tourId = $('#review-submit').attr("data-id");
        $.ajax({
            url: route('review.store'),
            type: 'POST',
            data: {
                title: title,
                content: content,
                tourId: tourId
            },
            success: function success(data) {
                $('#new-title').html(data.title);
                $('#new-content').html(data.content);
                $('#username').html(data.reviewer);
                $('#new-time').html(data.time);
                if (data.title) {
                    $('.new-review').show();
                }
                alert(data.message);
            },
            error: function(xhr){
                if (xhr.status == 401) {
                    alert('Please login to rate this review!');
                } else {
                    alert("Error: " + xhr.statusText);
                }
            }
        });
        return false;
    });


    $('#comment').submit(function (event) {
        event.preventDefault();
        commentableId = $('#commentable_id').val();
        content = $('#comment-content').val();
        $.ajax({
            url: route('comment'),
            type: 'POST',
            data: {
                content: content,
                commentable_type : 'reviews',
                commentable_id : commentableId,
            },
            success: function success(data) {
                alert(data.content);
            },
            error: function(xhr){
                if (xhr.status == 401) {
                    alert('Please login to rate this review!');
                } else {
                    alert("Error: " + xhr.statusText);
                }
        });
        return false;
    });

    $('#reply').submit(function (event) {
        // event.preventDefault();
        commentableId = $('#commentable_id').val();
        content = $('#reply-content').val();
        $.ajax({
            url: route('comment'),
            type: 'POST',
            data: {
                content: content,
                commentable_type : 'comments',
                commentable_id : commentableId,
            },
            success: function success(data) {
                alert(data.content);
            },
            error: function(xhr){
                if (xhr.status == 401) {
                    alert('Please login to rate this review!');
                } else {
                    alert("Error: " + xhr.statusText);
                }
        });
        return false;
    });

    $('.view-comments').click(function () {
        var id = $(this).attr("data-a");
        $('.all-comment'+id).slideToggle('active');
    });
});
