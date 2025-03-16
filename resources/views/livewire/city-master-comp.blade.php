<div>
    <h3 class="text-lg font-semibold mb-3">Master Kota</h3>

    <div class="bg-white w-full p-4 rounded-lg">
        <div class="w-full mx-auto">
            @if ($mode == 'view')

                <div class="relative overflow-x-auto">
                    <div class="flex justify-end">
                        <button wire:click="$set('mode', 'add')"
                            class="border cursor-pointer border-blue-500 hover:bg-blue-700 hover:text-white text-blue-500 font-bold py-3 px-4 rounded-lg mb-4 active:scale-105 transition duration-150 ease-in-out">
                            + Tambah Kota
                        </button>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Kota
                                </th>

                                <th scope="col" class="px-6 py-3 text-center">
                                    Provinsi
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Pulau
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Luar Negri
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Latitude
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Longitude
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
                                        {{ $item->city_name }}
                                    </td>
                                    <td class="px-6 py-4 align-top text-center ">
                                        {{ $item->province }}
                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        {{ $item->island }}
                                    </td>
                                    <td class="px-6 py-4 align-top text-center ">
                                        @if ($item->is_abroad == 0)
                                            Tidak
                                        @else
                                            {{ $item->country }}
                                        @endif

                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        {{ $item->latitude }}
                                    </td>
                                    <td class="px-6 py-4 align-top text-center ">
                                        {{ $item->longitude }}
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
                                <tr>
                                    <td colspan="8" class="text-center py-4">Data tidak ditemukan</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            @else
                <div class="div">
                    <div class="flex justify-between items-center">
                        <div class="div">
                            <button type="button" wire:click="resetInput"
                                class=" cursor-pointer text-blue-500 hover:bg-blue-700 border-2 hover:text-white border-blue-500 focus:ring-4 focus:outline-none hover:shadow-sm font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 active:scale-110 transition duration-150 ease-in-out">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span class="sr-only">Icon description</span>
                            </button>
                        </div>
                        <h1 class="text-2xl font-bold text-center">
                            {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Kota {{ $city_name }}
                        </h1>
                        <div class="">

                        </div>
                    </div>

                    <div class="flex">

                        <div class="w-1/2 pe-2">

                            <div class="mb-3 w-full mt-3 flex-col flex ">
                                <label for="searchMaps" class="text-sm text-gray-500">Kota<span
                                    class="text-red-500 text-lg">*</span></label>
                                <div class="relative flex w-full items-start">

                                    <div class="w-full">

                                        <x-input symbol="*" typeWire="defer" inputId="city_name" label=""
                                            type="text" wireModel="city_name" placeholder="Masukkan Nama Kota" />
                                    </div>
                                    <div class="absolute right-1 mt-1">
                                        <button wire:click="searchMaps"
                                            class="bg-white border-1 rounded-lg mt-[3px]  cursor-pointer border-gray-300 text-black text-xs p-2 hover:bg-gray-100 active::bg-gray-500 active:scale-105  ">Cari</button>
                                    </div>
                                </div>
                            </div>
                            <div  class="">
                                <div wire:loading wire:target="selectMaps,searchMaps">
                                    <div class="">

                                        <span class="loader"></span>
                                    </div>
                                </div>
                                <div class="columns-2 gap-3 " wire:loading.remove>
                                    @forelse ($listMaps as $item)
                                        <div class="break-inside-avoid mb-3">
                                            <div
                                                class="flex items-center justify-between border rounded-lg space-x-1 p-2 border-gray-300">
                                                <div class="flex items-center space-x-1">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <span class="text-sm">{{ $item['display_name'] }}</span>
                                                </div>
                                                <button type="button"
                                                    wire:click="selectMaps({{ $item['lat'] }}, {{ $item['lon'] }})"
                                                    class="bg-white border border-gray-300 rounded-lg cursor-pointer text-black text-xs p-2 
                                                       hover:bg-gray-100 active:bg-gray-500 active:scale-105">
                                                    Pilih
                                                </button>


                                            </div>
                                        </div>
                                    @empty
                                        @if ($listMapsError != null)
                                            <span
                                                class="text-red-500 text-xs text-center italic">{{ $listMapsError }}</span>
                                        @endif
                                    @endforelse
                                </div>

                            </div>

                            <div class="mb-3 w-full mt-0">
                                <x-input symbol="*" typeWire="defer" inputId="province" label="Provinsi"
                                    type="text" wireModel="province" placeholder="Masukkan Nama Provinsi" />
                            </div>
                            <div class="mb-3 w-full mt-3">
                                <x-input symbol="" typeWire="defer" inputId="island" label="Pulau"
                                    type="text" wireModel="island" placeholder="Masukkan Nama Pulau" />
                            </div>
                        </div>
                        <div class="w-1/2">



                            <div class="mb-3 w-full mt-3">
                                <x-select symbol="*" selectId="is_abroad" label="Luar Negeri"
                                    wireModel="is_abroad" placeholder="Apakah Luar Negeri" :options="[
                                        '1' => 'Ya',
                                        '0' => 'Tidak',
                                    ]" />
                            </div>
                            @if ($is_abroad == 1)
                                <div class="mb-3 w-full mt-3">


                                    <x-input symbol="*" typeWire="defer" inputId="country" label="Negara"
                                        type="text" wireModel="country" placeholder="Masukkan Nama Negara" />
                                </div>
                            @endif
                            <div class="mb-3 w-full mt-3 flex">
                                <div class="mb-3 w-full  pe-3">


                                    <x-input symbol="*" typeWire="live" inputId="latitude" label="Latitude"
                                        type="text" wireModel="latitude" placeholder="Masukkan Latitude" />
                                </div>

                                <div class="mb-3 w-full ">
                                    <x-input symbol="*" typeWire="live" inputId="longitude" label="Longitude"
                                        type="text" wireModel="longitude" placeholder="Masukkan Longitude" />
                                </div>

                            </div>
                            @if ($latitude != null && $longitude != null)
                                <div class="mb-3 w-full mt-3">

                                    <iframe class="rounded-lg" width="600" height="300" frameborder="0"
                                        src="https://www.openstreetmap.org/export/embed.html?bbox={{ is_numeric($longitude) ? $longitude - 0.01 : 0 }},{{ is_numeric($latitude) ? $latitude - 0.01 : 0 }},
                                     {{ is_numeric($longitude) ? $longitude + 0.01 : 0 }},{{ is_numeric($latitude) ? $latitude + 0.01 : 0 }}&layer=mapnik&marker={{ is_numeric($latitude) ? $latitude : 0 }},{{ is_numeric($longitude) ? $longitude : 0 }}">
                                    </iframe>



                                </div>
                            @endif
                        </div>
                    </div>




                    <div class="flex justify-start">
                        <button wire:click="{{ $mode == 'edit' ? 'storeEdit' : 'storeCreate' }}"
                            class="bg-blue-500 text-white px-4 py-2 cursor-pointer rounded-lg active:scale-110 transition duration-150 ease-in-out">
                            {{ $mode == 'edit' ? 'Perbarui Akun' : 'Tambah Akun' }}
                        </button>
                    </div>
                </div>
            @endif


        </div>


    </div>


</div>
