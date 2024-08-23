@extends('layout.master')
@section('content')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm m-0 p-0">
        <div class="container">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('album') }}">{{ __('Alle') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('album', ['show' => 'my']) }}">{{ __('Mein Alben') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('album', ['show' => 'visited']) }}">{{ __('Besuchte Alben') }}</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container pt-4">
        <div class="row">
            <div class="col-md-4" >
                <a href="{{route('album.edit')}}" >
                    <div class="card" style="height: 250px">
                        <div class="card-body  d-flex justify-content-center align-items-center">
                            <h5 class="card-title text-center">+ Album erstellen</h5>
                        </div>
                    </div>
                </a>
            </div>

        @foreach($albums as $album)
            <div class="col-md-4">
                <div class="card" style="height: 250px;
                 background-image: linear-gradient(0deg, rgba(98,96,96,0.68), rgba(0,0,0,0.73)), url('{{$album->cover()}}'); background-size: cover;
                 background-repeat: no-repeat">

                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title text-white">{{ $album->title }}</h5>

                        <a href="{{ route('album.show', $album->uuid) }}" class="btn btn-primary">Anzeigen</a>
                    </div>
                </div>
            </div>
    @endforeach
@endsection
