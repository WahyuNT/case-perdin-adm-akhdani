<div>
    <h3 class="text-lg font-semibold mb-3">Master Kota</h3>

    <div class="bg-white w-full p-4 rounded-lg">
        <div class="w-full mx-auto">
            @if ($mode == 'view')

                <div class="relative overflow-x-auto">
                    <div class="flex justify-end">
                        <button wire:click="$set('mode', 'add')"
                            class="border cursor-pointer border-blue-500 hover:bg-blue-700 hover:text-white text-blue-500 font-bold py-3 px-4 rounded-lg mb-4">
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
                                    Kota
                                </th>

                                <th scope="col" class="px-6 py-3 text-center">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Status
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
                                        {{ $item->departure_date }} {{ $item->return_date }}
                                    </td>
                                    <td class="px-6 py-4 align-top text-center ">
                                        {{ $item->return_date }}
                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        {{ $item->island }}
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
                                class="cursor-pointer text-blue-500 hover:bg-blue-700 border-2 hover:text-white border-blue-500 focus:ring-4 focus:outline-none hover:shadow-sm font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span class="sr-only">Icon description</span>
                            </button>
                        </div>
                        <h1 class="text-2xl font-bold text-center">Tambah Perjalanan</h1>
                        <div class=""></div>
                    </div>
                    <div class="flex">
                        <div class="w-1/2 pe-2">
                            <div class="mb-3 w-full mt-3">
                                <label for="departure_date" class="text-sm text-gray-500">Tanggal Keberangkatan</label>
                                <input id="departure_date" wire:model.defer="departure_date" type="date"
                                    class="bg-gray-100 w-full p-2 mt-1 rounded-lg focus:outline-gray-300">
                                @error('departure_date')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 w-full mt-3">
                                <label for="return_date" class="text-sm text-gray-500">Tanggal Kembali</label>
                                <input id="return_date" wire:model.defer="return_date" type="date"
                                    class="bg-gray-100 w-full p-2 mt-1 rounded-lg focus:outline-gray-300">
                                @error('return_date')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 w-full mt-3">
                                <label for="origin_city_id" class="text-sm text-gray-500">Kota Asal</label>
                                <input id="origin_city_id" wire:model.defer="origin_city_id" type="number"
                                    class="bg-gray-100 w-full p-2 mt-1 rounded-lg focus:outline-gray-300"
                                    placeholder="ID Kota Asal">
                                @error('origin_city_id')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 w-full mt-3">
                                <label for="destination_city_id" class="text-sm text-gray-500">Kota Tujuan</label>
                                <input id="destination_city_id" wire:model.defer="destination_city_id" type="number"
                                    class="bg-gray-100 w-full p-2 mt-1 rounded-lg focus:outline-gray-300"
                                    placeholder="ID Kota Tujuan">
                                @error('destination_city_id')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-1/2">
                            <div class="mb-3 w-full mt-3">
                                <label for="purpose_destination" class="text-sm text-gray-500">Tujuan Perjalanan</label>
                                <input id="purpose_destination" wire:model.defer="purpose_destination" type="text"
                                    class="bg-gray-100 w-full p-2 mt-1 rounded-lg focus:outline-gray-300"
                                    placeholder="Tujuan Perjalanan">
                                @error('purpose_destination')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 w-full mt-3">
                                <label for="trip_duration" class="text-sm text-gray-500">Durasi Perjalanan
                                    (hari)</label>
                                <input id="trip_duration" wire:model.defer="trip_duration" type="text" disabled
                                    class="bg-gray-200 w-full p-2 mt-1 rounded-lg focus:outline-gray-300">
                                @error('trip_duration')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-start">
                        @if ($mode == 'edit')
                            <button wire:click="storeEdit"
                                class="bg-blue-500 text-white px-4 py-2 cursor-pointer rounded-lg">Perbarui
                                Perjalanan</button>
                        @else
                            <button wire:click="storeCreate"
                                class="bg-blue-500 text-white px-4 py-2 cursor-pointer rounded-lg">Tambah
                                Perjalanan</button>
                        @endif
                    </div>
                </div>

            @endif


        </div>


    </div>


</div>
