<div class="form-group row">
    {!! Form::label('name', trans('message.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'name', 'autofocus']) !!}
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('duration', trans('message.duration'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::number('duration', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'duration']) !!}
        @if ($errors->has('duration'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('duration') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('itinerary', trans('message.itinerary'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('itinerary', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'itinerary']) !!}
        @if ($errors->has('itinerary'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('itinerary') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('start_date', trans('message.start_date'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::date('start_date', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'start_date']) !!}
        @if ($errors->has('start_date'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('start_date') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('price', trans('message.price'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::number('price', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'price']) !!}
        @if ($errors->has('price'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('description', trans('message.description'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('description', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'description']) !!}
        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('image', trans('message.image'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::file('image', null, ['class' => ['form-control'], 'required' => 'required', 'id' => 'image']) !!}
        @if ($errors->has('image'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
        @endif
    </div>
</div>

