@extends('admin.layout.app')

@section('content')
<div class="row content">
    <div class="col-sm-3">
        @include('admin.layout.sidebar')
    </div>
    <div class="col-sm-9">
        <div class="row justify-content-center">
            <h2>@lang('message.list-of-tours')</h2>
        </div>
        <div class="row">
            <div class="col-md-8 bottom">
                {!! Form::open(['route' => ['tour.create'], 'method' => 'get']) !!}
                {!! Form::submit(trans('message.add-tour'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
            <div class="col-md-4 bottom">
                {!! Form::open(['route' => ['tour.search.name']]) !!}
                {!! Form::text('name', null, ['id' => 'name', 'placeholder' => trans('message.name')]) !!}
                {!! Form::submit(trans('message.search_tour'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>

        </div>
        <table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>@lang('message.name')</th>
                    <th>@lang('message.itinerary')</th>
                    <th>@lang('message.start_date')</th>
                    <th>@lang('message.price')</th>
                    <th>@lang('message.description')</th>
                    <th>@lang('message.image')</th>
                    <th>@lang('message.delete')</th>
                    <th>@lang('message.edit')</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tours as $tour)
                <tr>
                    <td>{{ $tour->name }}</td>
                    <td>{{ $tour->itinerary }}</td>
                    <td>{{ $tour->start_date }}</td>
                    <td>{{ $tour->price }}</td>
                    <td>{{ $tour->description }}</td>
                    <td>
                        {!! Html::image(asset('upload/'. $tour->image), trans('message.image')) !!}
                    </td>
                    <td>
                        {!! Form::open(['route' => ['tour.destroy', $tour->id], 'method' => 'delete']) !!}
                        {!! Form::submit(trans('message.delete'), ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['route' => ['tour.edit', $tour->id], 'method' => 'get']) !!}
                        {!! Form::submit(trans('message.edit'), ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row justify-content-center">
            {{ $tours->links() }}
        </div>
    </div>
</div>
@endsection