@extends('admin.layout.app')

@section('content')
    <div class="row content">
        <div class="col-sm-3">
            @include('admin.layout.sidebar')
        </div>
        <div class="col-sm-9">
            <div class="row justify-content-center">
                <h2>@lang('message.list-of-users')</h2>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>@lang('message.name')</th>
                        <th>@lang('message.email')</th>
                        <th>@lang('message.gender')</th>
                        <th>@lang('message.date_of_birth')</th>
                        <th>@lang('message.address')</th>
                        <th>@lang('message.phone')</th>
                        <th>@lang('message.delete')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->date_of_birth }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            {!! Form::open(['route' => ['user.delete', $user->id], 'method' => 'delete']) !!}
                            {!! Form::submit(trans('message.delete'), ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
