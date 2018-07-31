@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="row content">
        @include('layouts.sidebar')
        <div class="col-sm-9">
            <div class="container booking">
                <h3 class="text-center font-weight-bold h3-review">@lang('message.myreview')</h3>
                <table class="table table-striped table-booking table-bordered table-responsive table-light ">
                    <thead>
                        <tr>
                            <th>@lang('message.review-title')</th>
                            <th>@lang('message.your-content')</th>
                            <th>@lang('message.delete')</th>
                            <th>@lang('message.edit')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->title }}</td>
                            <td>{{ $review->content }}</td>
                            <td>
                                {!! Form::open(['route' => ['review.destroy', $review->id], 'method' => 'delete']) !!}
                                {!! Form::submit(trans('message.delete'), ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>
                                {!! Form::open(['route' => ['review.edit', $review->id], 'method' => 'get']) !!}
                                {!! Form::submit(trans('message.edit'), ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
