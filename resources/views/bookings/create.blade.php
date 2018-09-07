<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">@lang('message.booking')</div>
                <div class="card-body">
                    @if(Session::has('status'))
                        <p class="alert alert-info">{{ Session::get('status') }}</p>
                    @endif
                    {!! Form::open(['route' => ['tour.booking.store', $tour->id], 'aria-lable' => trans('message.booking')]) !!}
                        @include('forms.booking')
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit(trans('message.booking'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
