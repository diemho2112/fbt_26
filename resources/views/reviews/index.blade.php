<div class="panel panel-primary review-box">
    <div class="row form-review">
        <div class="col-md-7 review">
            <h4 class="text-center">@lang('message.leave-review')</h4>
            {!! Form::open(['id' => 'review', 'role' => 'form']) !!}
            {!! Form::label('title', trans('message.review-title')) !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'title']) !!}
            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
            {!! Form::label('content', trans('message.your-review')) !!}
            {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5, 'required' => 'required', 'id' => 'content']) !!}
            @if ($errors->has('content'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
            {!! Form::submit(trans('message.post-review'), ['class' => 'btn btn-primary btn-review', 'id' => 'review-submit', 'data-id' => $tour->id]) !!}
            {!! Form::close() !!}
        </div>
        <div class="col-md-4">
            <h4 class="text-left">@lang('message.leave-rate')</h4>
            <div class="stars justify-content-center">
                {!! Form::open(['id' => 'rate', 'role' => 'form']) !!}
                {!! Form::radio('star', 5, false, ['class' => 'star star-5', 'id' => 'star-5']) !!}
                <label class="star star-5" for="star-5"></label>
                {!! Form::radio('star', 4, false, ['class' => 'star star-4', 'id' => 'star-4']) !!}
                <label class="star star-4" for="star-4"></label>
                {!! Form::radio('star', 3, false, ['class' => 'star star-3', 'id' => 'star-3']) !!}
                <label class="star star-3" for="star-3"></label>
                {!! Form::radio('star', 2, false, ['class' => 'star star-2', 'id' => 'star-2']) !!}
                <label class="star star-2" for="star-2"></label>
                {!! Form::radio('star', 1, false, ['class' => 'star star-1', 'id' => 'star-1']) !!}
                <label class="star star-1" for="star-1"></label>
                {!! Form::submit(trans('message.rate-tour'), ['class' => 'btn btn-primary', 'id' => 'rate-submit', 'data-id' => $tour->id]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="row display-review">
        <p class="header-review">
            <strong>@lang('message.passenger-review')</strong>
        </p>
        <div class="container row box-review new-review display-none">
            <p>@lang('message.review-by'): <span id="username" class="font-weight-bold"></span></p>
            <p id="new-title" class="font-weight-bold"></p>
            <p id="new-content"></p>
            <span id="new-time" class="time-right"></span>
        </div>
        <div id="list-comments">
            @foreach($reviews as $review)
                <div class="container row box-review">
                    <div class="col-md-1">
                        {{ Html::image(asset('img/214280-200.png'), trans('message.image'), ['class' => 'justify-content-center avartar']) }}
                        <span id="like-count{{ $review->id }}" data="{{ count($review->likes) }}">{{ count($review->likes) }} </span>
                        <i class="fa fa-thumbs-up"></i>
                        <span>{{ count($review->comments) }} <i class="fa fa-comment"></i></span>
                    </div>
                    <div class="col-md-11">
                        <p>@lang('message.review-by'): <strong>{{ $review->user->name }}</strong></p>
                        <p><strong>{{ $review->title }}</strong></p>
                        <p>{{ $review->content }}</p>
                        @guest
                            <i id="guest-like" class="fa fa-thumbs-down" data-id="{{ $review->id }}"></i>
                        @else
                            <i class="like fa {{ ($review->liked_by_auth_user) ? 'fa-thumbs-up' :  'fa-thumbs-down'}}" data-id="{{ $review->id }}"></i>
                        @endguest
                        <a class="comment-a" data-a="{{ $review->id }}"  href='javascript:void(0)'>@lang('message.comment')</a>
                        @if($review->reviewed_by_auth_user)
                            <a class="margin-a" href="{{ route('review.edit', $review->id) }}">@lang('message.edit')</a>
                            <a class="margin-a" href="{{ route('review.destroy', $review->id) }}">@lang('message.delete')</a>
                        @endif
                        <span class="time-right">{{ $review->created_at }}</span>
                    </div>
                </div>
                <div class="reply row">
                    {!! Form::open(['id' => 'comment', 'class ' => 'display-none comment-form'.$review->id]) !!}
                    {!! Form::hidden('commentable_id', null, ['id' => 'commentable_id']) !!}
                    <fieldset>
                        <legend class="legend-comment">@lang('message.your-comment')</legend>
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 4, 'required' => 'required', 'id' => 'comment-content']) !!}
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                        {!! Form::submit(trans('message.post'), ['class' => 'btn btn-primary btn-post']) !!}
                    </fieldset>
                    {!! Form::close() !!}
                    @if(count($review->comments))
                    <div class="container">
                        <a class="view-comments" href="javascript:void(0)" data-a="{{ $review->id }}">@lang('message.view-all-comment')</a>
                    </div>
                    @endif
                    <div class="all-comment{{ $review->id }} display-none container row">
                        <div class="row new-comment display-none">
                            <div class="container box-review">
                                <p>@lang('message.comment-by'): <span id="comment-user"></span></p>
                                <p id="comment-content"></p>
                                <a class="reply-a" href='javascript:void(0)'>@lang('message.reply')</a>
                                <span class="time-right" id="comment-time"></span>
                            </div>
                        </div>
                        @foreach($review->comments as $comment)
                            <div class="row">
                                <div class="container box-review">
                                    <p>@lang('message.comment-by'): {{ $comment->user->name }}</p>
                                    <p>{{ $comment->content }}</p>
                                    <a class="reply-a" data-a="{{ $comment->id }}"  href='javascript:void(0)'>@lang('message.reply')</a>
                                    <span class="time-right">{{ $comment->created_at }}</span>
                                </div>
                            </div>
                            {!! Form::open(['id' => 'reply', 'class ' => 'display-none reply-form'.$comment->id]) !!}
                            {!! Form::hidden('commentable_id', null, ['id' => 'commentable_id']) !!}
                            <fieldset>
                                <legend class="legend-comment">@lang('message.your-comment')</legend>
                                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 4, 'required' => 'required', 'id' => 'reply-content']) !!}
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                                {!! Form::submit(trans('message.post'), ['class' => 'btn btn-primary btn-post']) !!}
                            </fieldset>
                            {!! Form::close() !!}
                            @foreach($comment->comments as $comment)
                                <div class="row reply-detail">
                                    <div class="container box-review background-reply">
                                        <p>@lang('message.reply-by'): {{ $comment->user->name }}</p>
                                        <p>{{ $comment->content }}</p>
                                        <span class="time-right">{{ $comment->created_at }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
