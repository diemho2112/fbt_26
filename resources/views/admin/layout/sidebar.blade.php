<div class="left">
    <h2><i class="fa fa-dashboard fa-fw"></i> @lang('message.dashboard')</h2>
    <div class="search-container">
        {!! Form::open(['url' => '#']) !!}
        {!! Form::text('search', null, ['class' => 'input-search', 'placeholder' => trans('message.search')]) !!}
        {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
    <div class="sidenav">
        <a class="dropdown-btn" href="#"><i class="fa fa-bar-chart"></i> @lang('message.category') <i class="fa fa-caret-down"></i></a>
        <div class="dropdown-container">
            <a href="#"><i class="fa fa-list"></i> @lang('message.list-category')</a>
            <a href="#"><i class="fa fa-plus-square"> @lang('message.add-category')</i></a>
        </div>
        <a href="{{ route('user.list') }}"><i class="fa fa-user"></i> @lang('message.user')</a>
        <a class="dropdown-btn"><i class="fa fa-suitcase"></i> @lang('message.tour') <i class="fa fa-caret-down"></i></a>
        <div class="dropdown-container">
            <a href="{{ route('tour.list') }}"><i class="fa fa-list"></i> @lang('message.list-tour')</a>
            <a href="{{ route('tour.create') }}"><i class="fa fa-plus-square"> @lang('message.add-tour')</i></a>
        </div>
        <a href="{{ route('booking.list') }}"><i class="fa fa-shopping-cart"></i> @lang('message.booking')</a>
        <a href="{{ route('revenue') }}"><i class="fa fa-money"></i> @lang('message.revenue')</a>
    </div>
</div>
