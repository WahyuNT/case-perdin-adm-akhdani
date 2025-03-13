<html>

<head>
    <title>App Name - @yield('title')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    @vite(['resource/css/app.css', 'resource/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="flex h-screen bg-gray-100">
        <x-sidebar />
        <div class="flex flex-col flex-1 overflow-y-auto">
            <x-navbar />
            <div class="p-4">
                @yield('content')
            </div>
        </div>

    </div>


    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
</body>

</html>
