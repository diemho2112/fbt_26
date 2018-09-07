@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ trans('message.register') }}</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'register']) !!}
                            @include('forms.profile')
                            <div class="form-group row">
                                {!! Form::label('password', trans('message.password'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password', ['class' => ['form-control', $errors->has('password') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'password']) !!}
                                    @include('errors.input', ['input' => 'password'])
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('password-confirm', trans('message.confirm_password'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'id' => 'password-confirm']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {!! Form::submit(trans('message.register'), ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
