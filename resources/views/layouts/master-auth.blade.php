<html>

<head>
    <title>App Name - @yield('title')</title>
    {{-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script> --}}
    <script src="{{ asset('js/tailwind.js') }}"></script>
    @vite(['resource/css/app.css', 'resource/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>

<body>
    @yield('content')
    @livewireScripts
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            let input = document.getElementById("passwordInput");
            let icon = this.querySelector("i");
            let isHidden = input.type === "password";

            input.type = isHidden ? "text" : "password";
            icon.classList.toggle("fa-eye", !isHidden);
            icon.classList.toggle("fa-eye-slash", isHidden);
        });
    </script>

</body>

</html>
