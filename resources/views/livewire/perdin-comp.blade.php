<div>
    <h3 class="text-lg font-semibold mb-3">PerdinKu</h3>

    <div class="bg-white w-full p-4 rounded-lg">
        <div class="w-full mx-auto">
            <div class="flex justify-end">
                <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                    class="border cursor-pointer border-blue-500 hover:bg-blue-700 hover:text-white text-blue-500 font-bold py-3 px-4 rounded-lg mb-4">
                    + Tambah Perdin
                </button>
            </div>

            <div class="relative overflow-x-auto">

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
                            <th scope="col" class="px-6 py-3 text-start">
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
                                    {{ $item->originCity->city_name }} <i class="fa-solid fa-arrow-right"></i>
                                    {{ $item->destinationCity->city_name }}
                                </td>
                                <td class="px-6 py-4 align-top text-center ">
                                    {{ \Carbon\Carbon::parse($item->departure_date)->format('d M') }} -
                                    {{ \Carbon\Carbon::parse($item->return_date)->format('d M Y') }}
                                    <span class="text-gray-400 text-light"> ({{ $item->trip_duration }}
                                        Hari)</span>

                                </td>
                                <td class="px-6 py-4 align-top text-start text-ellipsis max-w-80">
                                    {{ $item->purpose_destination }}
                                </td>
                                <td class="px-6 py-4 align-top text-center flex justify-center">
                                    @if ($item->status == 'pending')
                                        <div class="bg-orange-200 rounded-full px-3 py-1 text-sm text-orange-600">
                                            Pending
                                        </div>
                                    @elseif($item->status == 'approved')
                                        <div class="bg-blue-200 rounded-full px-3 py-1 text-sm text-blue-600">
                                            Approved
                                        </div>
                                    @else
                                        <div class="bg-red-200 rounded-full px-3 py-1 text-sm text-red-600">
                                            Rejected
                                        </div>
                                    @endif
                                </td>


                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>

            </div>
            <div class="mt-3 ">

                {{ $data->links('vendor.livewire.tailwind') }}
            </div>



        </div>


    </div>

    <div wire:ignore.self id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden rounded-lg fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm ">
                <div
                    class="flex items-center justify-between px-4 py-2 border-b rounded-t bg-blue-200  border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-600 ">
                        Tambah Perdin
                    </h3>
                    <button type="button"
                        class="text-gray-600 cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center  active:scale-110 transition duration-150 ease-in-out"
                        data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <div class="mb-3 w-full mt-3">
                        <label for="origin_city_id" class="text-md text-gray-700 mb-1">Kota</label>
                        <div class="flex items-center">

                            <div class="w-full">
                                <select id="origin_city_id" wire:model.change="origin_city_id"
                                    class="bg-gray-50 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm">
                                    <option value="">Pilih kota Asal</option>
                                    @forelse ($city as $item)
                                        <option value="{{ $item->id }}">{{ $item->city_name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('origin_city_id')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class=" h-full py-3 flex justify-center items-center">
                                <i class="fa-solid fa-arrow-right px-2"></i>
                            </div>
                            <div class="w-full">
                                <select id="destination_city_id" wire:model.change="destination_city_id"
                                    class="bg-gray-50 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm">
                                    <option value="">Pilih kota Asal</option>
                                    @forelse ($city as $item)
                                        <option value="{{ $item->id }}">{{ $item->city_name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('destination_city_id')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 w-full mt-3">
                        <label for="departure_date" class="text-md text-gray-700 mb-1">Tanggal</label>
                        <div class="flex items-start">

                            <div class="w-full">
                                <input type="date" id="departure_date" wire:model.change="departure_date"
                                    class="bg-gray-50 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm">
                                @error('departure_date')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class=" h-full py-3 flex justify-center items-center">
                                <i class="fa-solid fa-arrow-right px-2"></i>
                            </div>
                            <div class="w-full ">
                                <input type="date" id="return_date" wire:model.change="return_date"
                                    class="bg-gray-50 w-full p-2  rounded-sm border-1 border-gray-200 shadow-sm">
                                @error('return_date')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 w-full mt-3">
                        <div class="flex flex-col">

                            <label for="purpose_destination" class="text-md text-gray-700 mb-1">Keterangan</label>
                            <textarea name="purpose_destination" wire:model.defer="purpose_destination"
                                class="bg-gray-50 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm " id="purpose_destination"
                                cols="3" rows="3"></textarea>
                        </div>
                        @error('purpose_destination')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 w-full mt-3 flex justify-center">
                        <div class="md:w-1/2 3/4 p-5 bg-gray-100 rounded-md">
                            <p class="text-center text-gray-600">Total Perjalanan Dinas</p>
                            <p class="text-center text-lg text-blue-600 font-bold">{{ $trip_duration }} Hari</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b ">

                    <button data-modal-hide="static-modal" type="button"
                        class="py-2.5 px-5 text-sm font-medium cursor-pointer text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Kembali</button>
                    <button wire:click="store" type="button"
                        class="text-white bg-blue-700 ms-3 cursor-pointer hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Tambah
                    </button>


                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('closeModal', () => {

                const $modalElement = document.getElementById('static-modal');
                const modal = new Modal($modalElement);
                modal.hide();
            });
        });
    </script>
</div>
