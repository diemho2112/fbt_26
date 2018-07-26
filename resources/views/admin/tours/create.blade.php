@extends('admin.layout.app')

@section('content')
    <div class="row content">
        <div class="col-sm-3">
            @include('admin.layout.sidebar')
        </div>
        <div class="col-sm-9">
            <div class="card card-tour">
                <div class="card-header text-center">@lang('message.create-tour')</div>
                <div class="card-body">
                    {!! Form::open(['route' => ['tour.store'], 'files' => true]) !!}
                        @include('forms.tour')
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit(trans('message.add-tour'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-success">
                                {{ session('error') }}
                            </div>
                         @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
