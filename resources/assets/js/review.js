$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('.like').click(function () {
            review_id = $(this).attr('data-id');
            like_count = parseInt($('#like-count'+review_id).html());
            $.ajax({
                url: '{{ route('like') }}',
                type: 'POST',
                data: {
                    review_id : review_id,
                    like_count : like_count
                },
                success: function success(data) {
                    $('#like-count'+review_id).html(like_count+data.like_count);
                },
                error: function error(err) {
                    alert(err);
                }
            });
            this.classList.toggle('fa-thumbs-down');
        });

        $('#guest-like').click(function () {
            alert('Please login to like this review!');
        });

        $('#review').submit(function (event) {
            event.preventDefault();
            title = $('#title').val();
            content = $('#content').val();
            tour_id = $('#review-submit').attr("data-id");
            $.ajax({
                url: route('review.store'),
                type: 'POST',
                data: {
                    title: title,
                    content: content,
                    tour_id: tour_id,
                },
                success: function (data) {
                    $('#new-title').html(data.title);
                    $('#new-content').html(data.content);
                    $('#username').html(data.username);
                    if (data.title) {
                        $('.new-review').show();
                    }
                    alert(data.message);
                },
                error: function error(err) {
                    alert(err);
                }
            });
        });

        $('.comment-a').click(function () {
            var id = $(this).attr("data-a");
            $('.comment-form' + id).toggle('active');
        });

        $('.reply-a').click(function () {
            var id = $(this).attr("data-a");
            $('.reply-form' + id).toggle('active');
        });
    });
});
