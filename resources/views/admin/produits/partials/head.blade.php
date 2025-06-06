<!-- head.blade.php -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title') | Admin</title>

<!-- CSS du template -->
<link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

@stack('styles')  <!-- Pour les styles spécifiques aux pages -->