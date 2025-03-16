<div>
    @section('title', 'Pengajuan Perdin')
    <h3 class="text-lg font-semibold mb-3">Pengajuan Perdin</h3>

    <div class="bg-white w-full p-4 rounded-lg">
        <div class="w-full mx-auto">

            <div class=" border-gray-200 w-[100%] md:w-[80%] sm:[w-80%] lg:w-[50%] xl:w-[30%] mb-4">
                <div class="flex  justify-between md:justify-start md:gap-3" id="myTab"
                    data-tabs-toggle="#myTabContent" role="tablist">

                    <button wire:click="changeMode('new')"
                        class=" items-center w-full justify-center flex cursor-pointer rounded-t-lg py-4 hover:text-blue-500 hover:border-b-3 px-4 text-sm text-center @if ($mode === 'new') text-blue-500 font-semibold border-b-3 border-b-blue-500 @else text-gray-500 font-medium @endif">
                        <span>Pengajuan Baru</span>
                        @if ($pendingCount > 0)
                            <span
                                class="ms-2 flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-blue-500 rounded-full">
                                {{ $pendingCount }}
                            </span>
                        @endif
                    </button>




                    <button wire:click="changeMode('history')"
                        class=" w-full  cursor-pointer justify-center flex rounded-t-lg py-4 hover:text-blue-500 hover:border-b-3 px-4 text-sm text-center @if ($mode === 'history') text-blue-500 font-semibold border-b-3 border-b-blue-500 @else text-gray-500 font-medium @endif">History
                        Pengajuan</button>


                </div>
            </div>


            <div class="relative overflow-x-auto ">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Kota
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Tanggal
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Keterangan
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
                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 align-top ">
                                    {{ $item->user->username }}
                                </td>
                                <td class="px-6 py-4 align-top text-center">
                                    {{ $item->originCity->city_name }} <i class="fa-solid fa-arrow-right"></i>
                                    {{ $item->destinationCity->city_name }}
                                </td>
                                <td class="px-6 py-4 align-top text-center">
                                    {{ \Carbon\Carbon::parse($item->departure_date)->format('d M') }} -
                                    {{ \Carbon\Carbon::parse($item->return_date)->format('d M Y') }}
                                    <span class="text-gray-400 text-light"> ({{ $item->trip_duration }}
                                        Hari)</span>
                                </td>
                                <td class="px-6 py-4 align-top text-ellipsis max-w-80">
                                    {{ $item->purpose_destination }}
                                </td>
                                <td class="px-6 py-4 align-top text-blue-400 text-center">
                                    <button @click="$dispatch('open-modal')" type="button"
                                        wire:click="openModal({{ $item->id }})"
                                        class="cursor-pointer hover:text-blue-500 hover:scale-110 rounded-full">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>


                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3 ">

                    {{ $data->links('vendor.livewire.tailwind') }}
                </div>

            </div>
        </div>


    </div>

    <div x-data="{ open: false }" x-on:open-modal.window="open = true" x-on:close-modal.window="open = false"
        x-show="open" class="relative z-50" x-cloak>

        <div @click="open = false" x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-50"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-50"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black opacity-50">
        </div>


        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="relative p-4 w-full max-w-xl max-h-full mx-auto">
                <div class="relative bg-white rounded-lg shadow-sm">

                    <div
                        class="flex items-center justify-between px-4 py-2 border-b rounded-t bg-blue-200 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-600">
                            Approval Pengajuan Perdin
                        </h3>
                        <button type="button" @click="open = false"
                            class="text-gray-600 flex  cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto  justify-center items-center active:scale-110 transition duration-150 ease-in-out">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 md:p-5 space-y-4 " wire:loading.class="relative flex justify-center items-center">

                        <span wire:loading class="loader scale-150 my-5"></span>

                        <div wire:loading.class="hidden" class="block">

                            <div class="mb-3 w-full mt-3">
                                <label for="origin_city_id" class="text-md text-gray-700 mb-1">Nama</label>
                                <div class="flex items-center">
                                    <div class="w-full">
                                        <div class="bg-gray-100 w-full p-2 rounded-lg border-1 border-gray-200 ">
                                            {{ $detail->user->username ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 w-full mt-3">
                                <label for="origin_city_id" class="text-md text-gray-700 mb-1">Kota</label>
                                <div class="flex items-center">
                                    <div class="w-full">
                                        <div class="bg-gray-100 w-full p-2 rounded-lg border-1 border-gray-200 ">
                                            {{ $detail->originCity->city_name ?? '' }}
                                        </div>
                                    </div>
                                    <div class="h-full py-3 flex justify-center items-center">
                                        <i class="fa-solid fa-arrow-right px-2"></i>
                                    </div>
                                    <div class="w-full">
                                        <div class="bg-gray-100 w-full p-2 rounded-lg border-1 border-gray-200 ">
                                            {{ $detail->destinationCity->city_name ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 w-full mt-3">
                                <label for="origin_city_id" class="text-md text-gray-700 mb-1">Tanggal</label>
                                <div class="flex items-center">
                                    <div class="w-full">
                                        <div class="bg-gray-100 w-full p-2 rounded-lg border-1 border-gray-200 ">
                                            {{ $detail ? \Carbon\Carbon::parse($detail->departure_date)->translatedFormat('j F Y') : '' }}
                                        </div>
                                    </div>
                                    <div class="h-full py-3 flex justify-center items-center">
                                        <i class="fa-solid fa-arrow-right px-2"></i>
                                    </div>
                                    <div class="w-full">
                                        <div class="bg-gray-100 w-full p-2 rounded-lg border-1 border-gray-200 ">
                                            {{ $detail ? \Carbon\Carbon::parse($detail->return_date)->translatedFormat('j F Y') : '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 w-full mt-3">
                                <label for="origin_city_id" class="text-md text-gray-700 mb-1">Keterangan</label>
                                <div class="flex items-center">
                                    <div class="w-full">
                                        <div class="bg-gray-100 w-full p-2 rounded-lg border-1 border-gray-200 ">
                                            {{ $detail->purpose_destination ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 w-full mt-3">
                                <div
                                    class="bg-blue-200 p-2 flex items-center w-full rounded-t-lg border-1 border-gray-200">
                                    <div class="w-1/3 text-center">
                                        Total Hari
                                    </div>
                                    <div class="w-1/3 text-center">
                                        Jarak Tempuh
                                    </div>
                                    <div class="w-1/3 text-center">
                                        Total Uang Perdin
                                    </div>
                                </div>
                                <div
                                    class="bg-gray-200 p-2 flex items-top w-full rounded-b-lg border-1 border-gray-200">
                                    <div class="w-1/3 text-center">
                                        <p class="text-blue-500">{{ $detail->trip_duration ?? '' }} Hari</p>
                                    </div>
                                    <div class="w-1/3 text-center">
                                        <div class="flex flex-col">
                                            <p class="text-blue-500">{{ $detail->distance ?? '' }} KM</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $currency }}{{ number_format($dailyAllowance ?? 0, 0, ',', '.') }},-</p>
                                            <p class="text-xs font-light text-gray-500">
                                                ({{ $dailyAllowanceDesc ?? '' }})
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-1/3 text-center">
                                        <p class="text-blue-500">
                                            {{ $currency }}{{ number_format(($detail->allowance ?? 0) * ($detail->trip_duration ?? 1), 0, ',', '.') }},-
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center items-center pt-3 border-t border-gray-200 rounded-b">
                                @if ($detail != null && $detail->status == 'rejected')
                                    <div class="bg-red-100 px-4 py-3 rounded-lg">
                                        <p class="text-red-500">Status : Rejected</p>
                                    </div>
                                @elseif($detail != null && $detail->status == 'approved')
                                    <div class="bg-blue-100 px-4 py-3 rounded-lg">
                                        <p class="text-blue-500">Status : Approved</p>
                                    </div>
                                @else
                                    <button wire:click="reject({{ $showId }})"
                                        @click="$dispatch('close-modal')" type="button"
                                        class="text-white cursor-pointer bg-red-700 ms-3 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center active:scale-110 transition duration-150 ease-in-out">
                                        Reject
                                    </button>
                                    <button wire:click="approve({{ $showId }})"
                                        @click="$dispatch('close-modal')" type="button"
                                        class="text-white cursor-pointer bg-blue-700 ms-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center active:scale-110 transition duration-150 ease-in-out">
                                        Approve
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
