<!DOCTYPE html>
<html lang="de">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta name="robots" content="noindex,nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <title>{{ \App\Http\Controllers\LayoutController::getSiteTitle() }}</title>
    <link rel="shortcut icon" href="{{ \App\Http\Controllers\LayoutController::getFavicon() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css')
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
</head>
<body class="skin">
<script src="{{ secure_asset('js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ secure_asset('js/app.js') }}"></script>
<script src="{{ secure_asset('js/functions.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>


@yield('body')

@stack('scripts')



<script>
    window.Laravel = {!! json_encode(['user' => auth()->check() ? auth()->user()->id : null, ]) !!};
</script>
</body>
</html>
