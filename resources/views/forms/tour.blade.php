<div class="form-group row">
    {!! Form::label('name', trans('message.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'name', 'autofocus']) !!}
        @include('errors.input', ['input' => 'name'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('duration', trans('message.duration'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::number('duration', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'duration']) !!}
        @include('errors.input', ['input' => 'duration'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('itinerary', trans('message.itinerary'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('itinerary', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'itinerary']) !!}
        @include('errors.input', ['input' => 'itinerary'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('start_date', trans('message.start_date'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::date('start_date', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'start_date']) !!}
        @include('errors.input', ['input' => 'start_date'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('price', trans('message.price'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::number('price', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'price']) !!}
        @include('errors.input', ['input' => 'price'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('description', trans('message.description'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('description', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'description']) !!}
        @include('errors.input', ['input' => 'description'])
    </div>
</div>
<div class="form-group row">
    {!! Form::label('image', trans('message.image'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::file('image', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'image']) !!}
        @include('errors.input', ['input' => 'image'])
    </div>
</div>

