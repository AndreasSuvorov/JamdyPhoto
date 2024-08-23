@extends('layout.master')
@section('content')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm m-0 p-0">
        <div class="container">


                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('album') }}">{{ __('Medien verwalten') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('album.edit', ['id' => $album->id]) }}">{{ __('Album bearbeiten') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="#">Läuft ab in {{ round(now()->diffInDays($album->created_at->addDays(30)))  }}
                            Tagen</a>
                    </li>
                </ul>

                <ul class="navbar-nav flex-row justify-content-center w-100">
                    <li class="nav-item">
                        <a class="nav-link copy-url-btn" href="#">{{ __('Album teilen') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link upload-media-btn" href="#">{{ __('Medien hochladen') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('media.download', ['id' => $album->id]) }}">{{ __('Medien Herunterladen') }}</a>
                    </li>
                </ul>


        </div>
    </nav>



    <section

        class="hero-image"
        style="background-image: url('{{$album->cover()}}');"

    >
        <div class="container pt-3">
            <div class="row" style=" ">
                <div class="col-md-8 mx-auto">
                    <h1 class="text-center">{{ $album->title }}</h1>
                    <p class="text-center">{{$album->location}}</p>
                    <p class="text-center">{{$album->description}}</p>
                    <p class="text-center">Ein Album von {{$album->users->first()->name}}</p>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mx-auto justify-content-between">
                            <a href="#" class="btn border-white text-white copy-url-btn">Teilen</a>
                            <a href="#" class="btn border-white text-white upload-media-btn">Hochladen</a>
                            <a href="{{ route('media.download', ['id' => $album->id]) }}" class="btn border-white text-white">Herunterladen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container pt-4">
            <div class="row">
                @if($album->media->count() == 0)
                    <div class="col-md-12 mx-auto">
                        <h1 class="text-center">
                            Dieses Album enthält noch keine Medien.
                        </h1>
                    </div>
                @endif


                <div class="masonry">
                    @foreach($album->media as $media)
                        <div class="masonry-item">
                            <a href="{{$media->getUrl()}}" data-fancybox="gallery">
                                <img src="{{$media->getUrl()}}" style="width: 100%;"/>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.querySelectorAll('.upload-media-btn').forEach(button => {
                button.addEventListener('click', function () {
                    uploadImage({{$album->id}});
                });
            });
            Fancybox.bind('[data-fancybox="gallery"]', {
                // Your custom options for a specific gallery
            });


            document.querySelectorAll('.copy-url-btn').forEach(button => {
                button.addEventListener('click', function () {
                    let url = '{{route('album.show', $album->uuid)}}';

                    copyUrl(url);
                });
            });
        </script>
    @endpush

@endsection
