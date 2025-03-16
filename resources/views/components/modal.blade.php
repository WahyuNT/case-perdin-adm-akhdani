<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm ">
            <!-- Modal header -->
            <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t  border-gray-200">
                <img src="{{ asset('images/Logo_ars.png') }}" alt="">
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <nav class="flex-1  py-4 ">
                    @if (session('role') == 'sdm' || session('role') == 'admin')
                        <small class="ps-5 text-gray-500">SDM</small>
                        <a href="{{ route('pengajuan-perdin') }}" class="mb-3">
                            <a href="{{ route('pengajuan-perdin') }}"
                                class="flex items-center ps-5 px-4 py-2 rounded-md   
                            {{ request()->routeIs('pengajuan-perdin') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">

                                <i class='bx bx-layer'></i>
                                <span class="ms-2">Pengajuan Perdin</span>
                            </a>
                        </a>
                        <a href="{{ route('master-kota') }}" class="mb-3">
                            <a href="{{ route('master-kota') }}"
                                class="flex items-center ps-5 px-4 py-2 rounded-md   
                            {{ request()->routeIs('master-kota') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">

                                <i class='bx bx-layer'></i>
                                <span class="ms-2">Master Kota</span>
                            </a>
                        </a>
                    @endif

                    @if (session('role') == 'pegawai' || session('role') == 'admin')
                        <div class="mb-3 mt-3">

                            <small class="ps-5 text-gray-500">USER</small>

                            <a href="{{ route('perdinku') }}" class="mb-3">

                                <a href="{{ route('perdinku') }}"
                                    class="flex items-center ps-5 px-4 py-2 rounded-md   
                                {{ request()->routeIs('perdinku') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                                hover:bg-blue-200">

                                    <i class='bx bx-layer'></i>
                                    <span class="ms-2">PerdinKu</span>
                                </a>
                            </a>
                        </div>
                    @endif
                    @if (session('role') == 'admin')
                        <div class="mb-3 mt-3">

                            <small class="ps-5 text-gray-500">ADMIN</small>
                            <a href="{{ route('manajemen-user') }}" class="mb-3">

                                <a href="{{ route('manajemen-user') }}"
                                    class="flex items-center ps-5 px-4 py-2 rounded-md   
                                {{ request()->routeIs('manajemen-user') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                                hover:bg-blue-200">

                                    <i class='bx bx-layer'></i>
                                    <span class="ms-2">Manajemen User</span>
                                </a>
                            </a>
                        </div>
                    @endif

                </nav>
            </div>
        </div>
    </div>
</div>
