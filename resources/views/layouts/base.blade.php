<html>
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoicing | @yield('title', 'Get Paid')</title>
    <meta name="description" content="@yield('page-description')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <!-- Links -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,700&display=swap" rel="stylesheet">
    @yield('links')

    <!-- CSS -->
    @stack('css')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    @yield('css-after')

    <!-- Scripts -->
    @stack('scripts')

</head>
<body class="@yield('body-class')">
<div id="app">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('bottom-body')
</body>
</html>
