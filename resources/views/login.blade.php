<html>

<head>
    <title>App Name - @yield('title')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    @vite(['resource/css/app.css', 'resource/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="flex h-screen justify-center items-center bg-gray-50">

        <div class="border w-1/4  px-4 py-10 rounded-lg shadow-sm border-gray-300 border-1 bg-white ">
            <div class=" p-5 pb-0 flex justify-center">
                <img class="w-[80%]" src="{{ asset('images/Logo_ars.png') }}" alt="">
            </div>
            <div class=" flex-col p-5 flex justify-center">
                <input type="text" class="mb-3 bg-gray-100 p-2 mt-2 rounded-lg focus:outline-gray-300"
                    placeholder="Username">
                <div class="relative items-center flex mb-5">
                    <input type="password" id="passwordInput"
                        class=" bg-gray-100 p-2 rounded-lg focus:outline-gray-300 w-full pr-10" placeholder="Password">
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <button class="bg-blue-500 text-white p-2 py-3 cursor-pointer rounded-lg">Login</button>
                <small class="text-center text-gray-500 mt-2"><div  class="text-blue-500">Lupa
                        password?</div></small>
            </div>


        </div>
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
