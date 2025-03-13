<div>
    <h3 class="text-lg font-semibold mb-3">Manajemen User</h3>

    <div class="bg-white w-full p-4 rounded-lg">
        <div class="w-full mx-auto">
            @if ($mode == 'view')

                <div class="relative overflow-x-auto">
                    <div class="flex justify-end">
                        <button wire:click="$set('mode', 'add')"
                            class="border cursor-pointer border-blue-500 hover:bg-blue-700 hover:text-white text-blue-500 font-bold py-3 px-4 rounded-lg mb-4">
                            + Tambah User
                        </button>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Username
                                </th>

                                <th scope="col" class="px-6 py-3 text-center">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Aksi
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr class="bg-white border-b  border-gray-200  ">

                                    <td class="px-6 py-4 align-top">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 align-top ">
                                        {{ $item->username }}
                                    </td>
                                    <td class="px-6 py-4 align-top text-center ">
                                        {{ $item->role }}
                                    </td>


                                    <td class="px-6 py-4 align-top  text-center">
                                        <div class="flex  justify-center">
                                            @if ($confirmDelete != null && $confirmDelete == $item->id)
                                                <div class="flex flex-col">

                                                    <small class="text-[13px]">Apa anda yakin?</small>
                                                    <div class="div">
                                                        <button wire:click="$set('confirmDelete', null)"
                                                            class=" px-2 text-[10px] text-white  cursor-pointer bg-blue-500 hover:text-white-500 hover:bg-blue-600 rounded-full p-1">
                                                            Batal
                                                        </button>
                                                        <button wire:click="delete({{ $item->id }})"
                                                            class=" px-2 text-[10px] text-white cursor-pointer bg-red-500 hover:text-white-500 hover:bg-red-600 rounded-full p-1">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                <button wire:click="edit({{ $item->id }})"
                                                    class="text-blue-400 cursor-pointer hover:text-blue-500 hover:bg-gray-200 rounded-full p-1 hover:scale-110 ">
                                                    <i class="fa-solid fa-pencil "></i>
                                                </button>
                                                <button type="button"
                                                    wire:click="$set('confirmDelete', {{ $item->id }})"
                                                    class="text-red-400 cursor-pointer hover:text-red-500 hover:bg-gray-200 rounded-full  hover:scale-110 p-1">
                                                    <i class="fa-solid fa-trash "></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div>
            @else
                <div class="div">
                    <div class="flex justify-between items-center">
                        <div class="div">
                            <button type="button" wire:click="resetInput"
                                class=" cursor-pointer text-blue-500 hover:bg-blue-700 border-2 hover:text-white border-blue-500 focus:ring-4 focus:outline-none hover:shadow-sm font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 ">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span class="sr-only">Icon description</span>
                            </button>
                        </div>
                        <h1 class="text-2xl font-bold text-center">Buat Akun</h1>
                        <div class="">

                        </div>
                    </div>
                    <div class="mb-3 w-full mt-3">
                        <label for="username" class="text-sm text-gray-500">Username</label>
                        <input id="username" wire:model.defer="username" type="text"
                            class=" bg-gray-100 w-full p-2 mt-1 rounded-lg focus:outline-gray-300"
                            placeholder="Username">
                        @error('username')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 w-full">
                        <label for="password" class="text-sm text-gray-500">Password</label>
                        <div class="relative items-center flex mt-1">
                            <input wire:model.defer="password" type="{{ $passwordShow }}" id="passwordInput"
                                class=" bg-gray-100 p-2 rounded-lg focus:outline-gray-300 w-full pr-10"
                                placeholder="Password">
                            @if ($passwordShow == 'password')
                                <button type="button" wire:click="$set('passwordShow', 'text')" id="togglePassword"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-500 cursor-pointer">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            @else
                                <button type="button" wire:click="$set('passwordShow', 'password')" id="togglePassword"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-500 cursor-pointer">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </button>
                            @endif
                        </div>
                        @error('password')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 w-full">

                        <label for="role" class="text-sm text-gray-500">Role</label>
                        <select wire:model.change="role" id="role"
                            class="bg-gray-100 text-sm w-full p-2 mt-1 rounded-lg focus:outline-gray-300">
                            <option selected>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="sdm">SDM</option>
                            <option value="pegawai">Pegawai</option>
                        </select>
                        @error('role')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-start">
                        @if ($mode == 'edit')
                            <button wire:click="storeEdit"
                                class="bg-blue-500 text-white px-4 py-2 cursor-pointer rounded-lg">Perbarui
                                Akun</button>
                        @else
                            <button wire:click="storeCreate"
                                class="bg-blue-500 text-white px-4 py-2 cursor-pointer rounded-lg">Tambah Akun</button>
                        @endif
                    </div>
                </div>
            @endif


        </div>


    </div>


</div>
