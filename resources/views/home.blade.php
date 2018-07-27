@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="row content">
        @include('layouts.sidebar')
        <div class="col-sm-9">
            @if (session('no_tours')))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ session('no_tours') }}</strong>
                </span>
            @endif
            <div class="row content" id="list-tours">
                @foreach ($tours as $tour)
                    <div class="col-sm-5 tour" >
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                {!! $tour->name !!}
                            </div>
                            <div class="panel-body">
                                {!! Html::image(($tour->is_upload_image) ? asset('upload/' . $tour->image) : $tour->image, trans('message.image'), ['class' => 'responsive']) !!}
                            </div>
                            <div class="panel-footer">
                                <p>@lang('message.from') <span class="price">{{ $tour->price }}</span></p>
                                <p>@lang('message.number_of_days'): {{ $tour->duration }}</p>
                                <p>@lang('message.itinerary'): {{ $tour->itinerary }}</p>
                                {!! Form::open(['route' => ['tour.show', $tour->id], 'method' => 'get', 'class' => 'detail']) !!}
                                    {!! Form::submit(trans('message.view_detail'), ['class' => 'btn btn-primary btn-detail']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
