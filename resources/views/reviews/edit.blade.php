@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="row content">
        @include('layouts.sidebar')
        <div class="col-sm-9">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center">@lang('message.edit-myreview')</div>
                            <div class="card-body">
                                {!! Form::model($review, ['route' => ['review.update', $review->id], 'method' => 'put']) !!}
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
                                {!! Form::submit(trans('message.update'), ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
