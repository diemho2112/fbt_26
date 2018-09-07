<div class="form-group row">
    {!! Form::label('name', trans('message.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('name', old('name'), ['class' => ['form-control', $errors->has('name') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'name', 'autofocus']) !!}
        @include('errors.input', ['input' => 'name'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('email', trans('message.email'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::email('email', old('email'), ['class' => ['form-control', $errors->has('email') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'email']) !!}
        @include('errors.input', ['input' => 'email'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('address', trans('message.address'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('address', old('address'), ['class' => ['form-control', $errors->has('address') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'address']) !!}
        @include('errors.input', ['input' => 'address'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('phone', trans('message.phone'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('phone', old('phone'), ['class' => ['form-control', $errors->has('phone') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'phone']) !!}
        @include('errors.input', ['input' => 'phone'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('date_of_birth', trans('message.birthday'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::date('date_of_birth', old('date_of_birth'), ['class' => ['form-control', $errors->has('date_of_birth') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'date_of_birth']) !!}
        @include('errors.input', ['input' => 'date_of_birth'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('gender', trans('message.gender'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::radio('gender', 'male') !!} {!! trans('message.male') !!}
        {!! Form::radio('gender', 'female') !!} {!! trans('message.female') !!}
    </div>
</div>
