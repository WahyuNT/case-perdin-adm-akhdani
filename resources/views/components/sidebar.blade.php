<div class="hidden md:flex flex-col w-64 bg-gray-50">
    <div class="flex items-center justify-center h-16 bg-gray-50">
        <img class="px-5 mb-4 mt-7 " src="{{ asset('images/Logo_ars.png') }}" alt="">
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">

        <nav class="flex-1  py-4 bg-gray-50">
            @if (session('role') == 'sdm' || session('role') == 'admin')
                <small class="ps-5 text-gray-500">SDM</small>
                <a href="{{ route('pengajuan-perdin') }}" class="mb-3">
                    <a href="{{ route('pengajuan-perdin') }}"
                        class="flex items-center ps-5 px-4 py-2  border-blue-500 
                    {{ request()->routeIs('pengajuan-perdin') ? 'bg-blue-100 text-blue-500 border-r-3' : 'bg-transparent text-gray-700 border-r-0' }}
                    hover:bg-blue-200">

                        <i class='bx bx-layer'></i>
                        <span class="ms-2">Pengajuan Perdin</span>
                    </a>
                </a>
                <a href="{{ route('master-kota') }}" class="mb-3">
                    <a href="{{ route('master-kota') }}"
                        class="flex items-center ps-5 px-4 py-2  border-blue-500 
                    {{ request()->routeIs('master-kota') ? 'bg-blue-100 text-blue-500 border-r-3' : 'bg-transparent text-gray-700 border-r-0' }}
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
                            class="flex items-center ps-5 px-4 py-2  border-blue-500 
                        {{ request()->routeIs('perdinku') ? 'bg-blue-100 text-blue-500 border-r-3' : 'bg-transparent text-gray-700 border-r-0' }}
                        hover:bg-blue-200">

                            <i class='bx bx-layer'></i>
                            <span class="ms-2">PerdinKu</span>
                        </a>
                    </a>
                </div>
            @endif
            @if ( session('role') == 'admin')
                <div class="mb-3 mt-3">

                    <small class="ps-5 text-gray-500">ADMIN</small>
                    <a href="{{ route('manajemen-user') }}" class="mb-3">

                        <a href="{{ route('manajemen-user') }}"
                            class="flex items-center ps-5 px-4 py-2  border-blue-500 
                        {{ request()->routeIs('manajemen-user') ? 'bg-blue-100 text-blue-500 border-r-3' : 'bg-transparent text-gray-700 border-r-0' }}
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
