@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">@lang('message.login')</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'login', 'aria-lable' => trans('message.login')]) !!}
                            <div class="form-group row">
                                {!! Form::label('email', trans('message.email'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-6">
                                    {!! Form::email('email', old('email'), ['class' => ['form-control', $errors->has('email') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'email']) !!}
                                    @include('errors.input', ['input' => 'email'])
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('password', trans('message.password'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password', ['class' => ['form-control', $errors->has('password') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'password']) !!}
                                    @include('errors.input', ['input' => 'password'])
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        {!! Form::checkbox('remember', old('remember') ? 'checked' : ''); !!} @lang('message.remember-me')
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {!! Form::submit(trans('message.login'), ['class' => 'btn btn-primary']) !!}
                                    <a class="btn-link" href="{{ route('password.request') }}">
                                        @lang('message.forget-password')
                                    </a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="social text-center">
                            <div class="line"></div>
                            <div class="line-center text-center">@lang('message.or')</div>
                            <div class="line"></div>
                        </div>
                        <div class="login-social">
                            {!! Form::open(['route' => ['social-login', 'facebook'], 'method' => 'get']) !!}
                            {!! Form::button('<i class="fa fa-facebook"></i>  '.trans('message.login-with').' Facebook', ['type' => 'submit', 'class' => 'btn btn-social facebook']) !!}
                            {!! Form::close() !!}
                            {!! Form::open(['route' => ['social-login', 'twitter'], 'method' => 'get']) !!}
                            {!! Form::button('<i class="fa fa-twitter"></i>  '.trans('message.login-with').' Twitter', ['type' => 'submit', 'class' => 'btn btn-social google']) !!}
                            {!! Form::close() !!}
                            {!! Form::open(['route' => ['social-login', 'google'], 'method' => 'get']) !!}
                            {!! Form::button('<i class="fa fa-google"></i>  '.trans('message.login-with').' Google', ['type' => 'submit', 'class' => 'btn btn-social twitter']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
