@extends('layout.siteResourceheader')

@section('body')

    <div class="wrapper">
        <x-header />
        <div class="content">
            @yield('content')
        </div>
    </div>

@endsection
