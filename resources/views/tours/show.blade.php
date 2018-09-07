@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="row content">
        @include('layouts.sidebar')
        <div class="col-sm-9">
            <div class="content tour-detail">
                {!! Html::image(asset($tour->image), trans('message.image'), ['class' => 'responsive', 'height' => '500px']) !!}
                <div class="panel-heading panel-tour">
                    <h1>{{ $tour->name }}</h1>
                    <p>@lang('message.from') <span class="price">{{ $tour->price }} @lang('message.per-person')</span></p>
                    <p>@lang('message.number_of_days') {{ $tour->duration }}</p>
                    <p>@lang('message.itinerary') {{ $tour->itinerary }}</p>
                    <div class="rate">
                        {{ $tour->showRate($averageRating) }}
                        <p>{{ $totalReviews }} @lang('message.review')</p>
                    </div>
                </div>
                <div class="tab">
                    <button class="tablinks defaultOpen" id="blocka" onclick="openBlock(event, 'description')">@lang('message.description')</button>
                    <button class="tablinks" id="blockb" onclick="openBlock(event, 'booking')">@lang('message.booking')</button>
                    <button class="tablinks" id="blockc" onclick="openBlock(event, 'review')">@lang('message.review')</button>
                </div>

                <div id="description" class="tabcontent">
                    <div class="panel panel-primary ">
                        <div class="panel-body">
                            <h2>@lang('message.description')</h2>
                            <p>{{ $tour->description }}</p>
                            <h3>@lang('message.activity')</h3>
                            @foreach($activities as $activity)
                                <h4><strong>{{ $activity->name }}</strong></h4>
                                <p>{{ $activity->description }}</p>
                            @endforeach
                            <h3>@lang('message.package')</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>@lang('message.name')</th>
                                        <th>@lang('message.description')</th>
                                        <th>@lang('message.discount')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($packages as $package)
                                    <tr>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->desciption }}</td>
                                        <td>{{ $package->discount }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="booking" class="tabcontent">
                    @include('bookings.create')
                </div>

                <div id="review" class="tabcontent">
                    @include('reviews.index')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
