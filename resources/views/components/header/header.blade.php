<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm m-0">
    <div class="container">

        <x-header.logo/>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                    <li class="nav-item nav-underline">
                        <a @class(['nav-link', 'active' => Route::is('album')]) href="{{ route('album') }}">{{ __('Alben') }}</a>
                    </li>
                    <li class="nav-item nav-underline">
                        <a class="nav-link" href="{{ route('register') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item nav-underline">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Premium') }}</a>
                    </li>
                    <li class="nav-item nav-underline">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>



