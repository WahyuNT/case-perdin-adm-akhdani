<div>
    @section('title', 'Login')
    <div class="flex h-screen justify-center items-center bg-gray-50">

        <div
            class="border w-[80%] sm:w-[60%] md:w-[35%] lg:w-[25%]  px-4 py-10 rounded-xl shadow-sm border-gray-300 border-1 bg-white ">
            <div class=" p-5 pb-0 flex justify-center">
                <img class="w-[80%]" src="{{ asset('images/Logo_ars.png') }}" alt="">
            </div>
            <div class="flex justify-center p-5 pb-0">

                @if (session('error'))
                    <div class="bg-red-100 p-3 py-2 text-red-600 rounded-lg text-sm" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class=" flex-col p-5 flex justify-center pt-0">
                <div class="mb-3 w-full">
                    <input @keyup.enter="$wire.login()" wire:model.defer="username" type="text"
                        class=" bg-gray-100 w-full p-2 mt-2 rounded-lg focus:outline-gray-300" placeholder="Username">
                    @error('username')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">

                    <div class="relative items-center flex ">
                        <input @keyup.enter="$wire.login()" wire:model.defer="password" type="password"
                            id="passwordInput" class=" bg-gray-100 p-2 rounded-lg focus:outline-gray-300 w-full pr-10"
                            placeholder="Password">
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <button wire:loading.attr="disabled" type="button" wire:click="login"
                    class="bg-blue-500 text-white p-2 py-3 cursor-pointer rounded-lg disabled:bg-gray-300">Login</button>
                <small wire:click="forgot" class="text-center cursor-pointer text-gray-500 mt-2">
                    <div class="text-blue-500">Lupa
                        password?</div>
                </small>
            </div>
        </div>
    </div>
</div>
