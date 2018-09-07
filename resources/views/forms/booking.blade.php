<div class="form-group row">
    {!! Form::label('booking_date', trans('message.date-booking'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::date('booking_date', old('booking_date'), ['class' => ['form-control', $errors->has('booking_date') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'name']) !!}
        @include('errors.input', ['input' => 'booking_date'])
    </div>
</div>

<div class="form-group row">
    {!! Form::label('number_of_passengers', trans('message.passengers-booking'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::number('number_of_passengers', old('number_of_passengers'), ['class' => ['form-control', $errors->has('number_of_passengers') ? ' is-invalid' : ''], 'required' => 'required', 'id' => 'capacity']) !!}
        @include('errors.input', ['input' => 'number_of_passengers'])
    </div>
</div>

<div class="form-group row">
    {!! Form::label('package', trans('message.package-option'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::select('package', $packagesList, ['class' => 'form-control', 'id' => 'package']) !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('grand_total', trans('message.total'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::number('grand_total', $tour->price, ['id' => 'total', 'step' => 0.01]) !!}
    </div>
</div>
