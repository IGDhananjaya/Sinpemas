<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    @stack('style-alt')
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="font-bold text-white text-2xl">SIPENMAS</h1>
                    </div>
                    <!-- Navigation Links -->
                    <div class="hidden sm:-my-px sm:ml-6 sm:flex space-x-4">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-200 bg-blue-700 rounded hover:bg-blue-800">
                            Dashboard
                        </a>
                        <a href="{{ route('ormas.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-200 bg-blue-700 rounded hover:bg-blue-800">
                            Pendaftaran Ormas
                        </a>
                    </div>
                </div>
                <!-- User Info and Logout -->
                <div class="flex items-center">
                    <span class="text-white text-sm mr-4">Welcome, <strong>{{ Auth::user()->name }}</strong></span>
                    <a onclick="return document.getElementById('logout').submit();" href="#"
                        class="nav-link flex items-center text-red-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-in-left" viewBox="0 0 16 16" style="margin-right: 10px;">
                            <path fill-rule="evenodd"
                                d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                            <path fill-rule="evenodd"
                                d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                        </svg>
                        <p class="ml-2" style="margin-bottom: 0;">
                            Logout
                        </p>
                        <form id="logout" action="{{ route('logout') }}" method="post">
                            @csrf
                        </form>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-10 flex-grow">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <p class="mt-4 text-gray-600">@yield('content')</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4">
            <p>&copy; 2024 SIPENMAS. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    @yield('scripts')

</body>

</html>
