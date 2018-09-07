@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="row content">
        @include('layouts.sidebar')
        <div class="col-sm-9">
            <div class="row content" id="list-tours">
                @foreach ($tours as $tour)
                    <div class="col-sm-5 tour" >
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                {!! $tour->name !!}
                            </div>
                            <div class="panel-body">
                                {!! Html::image(asset($tour->image), trans('message.image'), ['class' => 'responsive']) !!}
                            </div>
                            <div class="panel-footer">
                                <p>@lang('message.from') <span class="price">{{ $tour->price }}</span></p>
                                <p>@lang('message.number_of_days'): {{ $tour->duration }}</p>
                                <p>@lang('message.itinerary'): {{ $tour->itinerary }}</p>
                                {{ $tour->showRate($tour->ratings->avg('value')) }}
                                <p>{{ $tour->reviews->count('id') }} @lang('message.review')</p>
                                {!! Form::open(['route' => ['tour.show', $tour->id], 'method' => 'get', 'class' => 'detail']) !!}
                                    {!! Form::submit(trans('message.view_detail'), ['class' => 'btn btn-primary btn-detail']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            <div class="row justify-content-center">
                {{ $tours->links() }}
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
