<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'K UI') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"/>

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <!--FLOWBITE-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- delete modal functionality -->
    <script type="text/javascript" src="{{ asset('js/delete_modal_functionality.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/loadingInsert.js') }}"></script>
</head>


<body class="font-sans antialiased">

<div
    x-data="mainState"
    :class="{ dark: isDarkMode }"
    x-on:resize.window="handleWindowResize"
    x-cloak
>
    <div class="min-h-screen text-gray-900 bg-gray-200 dark:bg-dark-eval-0 dark:text-gray-200">
        <!-- Sidebar -->
        <x-sidebar.sidebar/>

        <!-- Page Wrapper -->
        <div
            class="flex flex-col min-h-screen"
            :class="{
                    'lg:ml-64': isSidebarOpen,
                    'md:ml-16': !isSidebarOpen
                }"
            style="transition-property: margin; transition-duration: 150ms;"
        >

            <!-- Navbar -->
            <x-navbar/>

            <!-- Page Heading -->
            <header>
                <div class="p-3 sm:p-3">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="px-4 sm:px-6 flex-1">
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <x-footer/>
        </div>
    </div>
</div>

<!--FLOWBITE-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

</body>
</html>
