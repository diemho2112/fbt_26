@extends('admin.layout.app')

@section('content')
    <div class="row content">
        <div class="col-sm-3">
            @include('admin.layout.sidebar')
        </div>
        <div class="col-sm-9">
            <div class="card card-tour">
                <div class="card-header text-center">@lang('message.edit-tour')</div>
                <div class="card-body">
                    {!! Form::model($tour, ['route' => ['tour.update', $tour->id], 'method' => 'put']) !!}
                        @include('forms.tour')
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit(trans('message.edit'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
