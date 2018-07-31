@extends('admin.layout.app')

@section('content')
    <div class="row content">
        <div class="col-sm-3">
            @include('admin.layout.sidebar')
        </div>
        <div class="col-sm-9">
            <div class="row justify-content-center">
                <h2>@lang('message.month-report')</h2>
            </div>
            <div class="row">
                {!! Form::open(['route' => 'revenue.month' ]) !!}
                {!! Form::selectMonth('month', $nowMonth) !!}
                {!! Form::selectYear('year', $nowYear, 2014, 2020) !!}
                {!! Form::submit(trans('message.select'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
            <table class="table table-striped table-report text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>@lang('message.tour')</th>
                        <th>@lang('message.income')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tours as $tour)
                    <tr>
                        <td>{{ $tour->name }}</td>
                        <td>{{ $tour->income }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="font-weight-bold text-center">@lang('message.total-revenue')</td>
                        <td class="font-weight-bold">{{ $tours->sum('income') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
