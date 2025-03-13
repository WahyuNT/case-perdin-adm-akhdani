<div>
    <h3 class="text-lg font-semibold mb-3">Pengajuan Perdin</h3>

    <div class="bg-white w-full p-4 rounded-lg">
        <div class="w-full mx-auto">

            <div class=" border-gray-200  mb-4">
                <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button wire:click="$set('mode', 'new')"
                            class="inline-block rounded-t-lg py-4 hover:text-blue-500 hover:border-b-3 px-4 text-sm text-center @if ($mode === 'new') text-blue-500 font-bold border-b-3 border-b-blue-500 @else text-gray-500 font-medium @endif">
                            Pengajuan Baru
                            @if ($pendinCount > 0)
                                <span
                                    class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-white bg-blue-500 rounded-full">
                                    {{ $pendinCount }}
                                </span>
                            @endif
                        </button>

                    </li>
                    <li class="mr-2" role="presentation">
                        <button wire:click="$set('mode', 'history')"
                            class="inline-block rounded-t-lg py-4 hover:text-blue-500 hover:border-b-3 px-4 text-sm text-center @if ($mode === 'history') text-blue-500 font-bold border-b-3 border-b-blue-500 @else text-gray-500 font-medium @endif">History
                            Pengajuan</button>
                    </li>

                </ul>
            </div>


            <div class="div">
                @if ($mode === 'new')
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
                            @forelse ($pending as $item)
                                <tr class="bg-white border-b  border-gray-200  ">

                                    <td class="px-6 py-4 align-top">
                                        {{ $loop->iteration }}
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
                                        <button wire:click="$set('showId', {{ $item->id }})"
                                            data-modal-target="static-modal" data-modal-toggle="static-modal"
                                            class="cursor-pointer hover:text-blue-500 hover:scale-110 rounded-full ">

                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>

                                </tr>

                            @empty
                            @endforelse

                        </tbody>
                    </table>
                @else
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
                            @forelse ($history as $item)
                                <tr class="bg-white border-b  border-gray-200  ">

                                    <td class="px-6 py-4 align-top">
                                        {{ $loop->iteration }}
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
                                        <button wire:click="$set('showId', {{ $item->id }})"
                                            data-modal-target="static-modal" data-modal-toggle="static-modal"
                                            class="cursor-pointer hover:text-blue-500 hover:scale-110 rounded-full ">

                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>

                                </tr>

                            @empty
                            @endforelse

                        </tbody>
                    </table>
                @endif

            </div>
        </div>


    </div>

    <div wire:ignore.self id="static-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm ">
                <div
                    class="flex items-center justify-between px-4 py-2 border-b rounded-t bg-blue-200  border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-600 ">
                        Approval Pengajuan Perdin
                    </h3>
                    <button type="button"
                        class="text-gray-600 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
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
                        <label for="origin_city_id" class="text-md text-gray-700 mb-1">Nama</label>
                        <div class="flex items-center">

                            <div class="w-full">
                                <div class="bg-gray-100 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm">
                                    {{ $detail->user->username ?? '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 w-full mt-3">
                        <label for="origin_city_id" class="text-md text-gray-700 mb-1">Kota</label>
                        <div class="flex items-center">

                            <div class="w-full">
                                <div class="bg-gray-100 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm">
                                    {{ $detail->originCity->city_name ?? '' }}
                                </div>
                            </div>
                            <div class=" h-full py-3 flex justify-center items-center">
                                <i class="fa-solid fa-arrow-right px-2"></i>
                            </div>
                            <div class="w-full">
                                <div class="bg-gray-100 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm">
                                    {{ $detail->destinationCity->city_name ?? '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 w-full mt-3">
                        <label for="origin_city_id" class="text-md text-gray-700 mb-1">Tanggal</label>
                        <div class="flex items-center">

                            <div class="w-full">
                                <div class="bg-gray-100 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm">
                                    {{ $detail->departure_date ?? '' }}
                                </div>
                            </div>
                            <div class=" h-full py-3 flex justify-center items-center">
                                <i class="fa-solid fa-arrow-right px-2"></i>
                            </div>
                            <div class="w-full">
                                <div class="bg-gray-100 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm">
                                    {{ $detail->return_date ?? '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 w-full mt-3">
                        <label for="origin_city_id" class="text-md text-gray-700 mb-1">Keterangan</label>
                        <div class="flex items-center">

                            <div class="w-full">
                                <div class="bg-gray-100 w-full p-2  rounded-lg border-1 border-gray-200 shadow-sm">
                                    {{ $detail->purpose_destination ?? '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 w-full mt-3">

                        <div class="bg-blue-200  p-2 flex items-center w-full rounded-t-lg border-1 border-gray-200 ">
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
                        <div class="bg-gray-200  p-2 flex items-top w-full rounded-b-lg  border-1 border-gray-200 ">
                            <div class="w-1/3 text-center">
                                <p class="text-blue-500"> {{ $detail->trip_duration ?? '' }} Hari</p>
                            </div>
                            <div class="w-1/3 text-center">
                                <div class="flex flex-col">
                                    <p class="text-blue-500">{{ $detail->distance ?? '' }} KM</p>
                                    <p class="text-sm text-gray-500"> Rp.
                                        {{ number_format($dailyAllowance ?? 0, 0, ',', '.') }} ,-</p>
                                    <p class="text-xs font-light text-gray-500"> ({{ $dailyAllowanceDesc ?? '' }})</p>

                                </div>
                            </div>
                            <div class="w-1/3 text-center">
                                <p class="text-blue-500"> Rp.
                                    {{ number_format($detail->total_allowance ?? 0, 0, ',', '.') }},-</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="flex justify-center items-center p-4 md:p-5 border-t border-gray-200 rounded-b ">

                    @if ($detail != null && $detail->status == 'rejected')
                        <div class="bg-red-100 px-4 py-3 rounded-lg">
                            <p class="text-red-500">Status : {{ $detail->status }}</p>
                        </div>
                    @elseif($detail != null && $detail->status == 'approved')
                        <div class="bg-blue-100 px-4 py-3 rounded-lg">
                            <p class="text-blue-500">Status : {{ $detail->status }}</p>
                        </div>
                    @else
                        <button wire:click="reject({{ $showId }})" type="button"
                            class="text-white cursor-pointer bg-red-700 ms-3  hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Reject
                        </button>
                        <button wire:click="approve({{ $showId }})" type="button"
                            class="text-white cursor-pointer bg-blue-700 ms-3  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Approve
                        </button>
                    @endif


                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('closeModal', () => {
                const modalEl = document.getElementById('static-modal');

                const closeEvent = new MouseEvent('click', {
                    bubbles: true,
                    cancelable: true,
                    view: window
                });

                const closeButton = document.querySelector('[data-modal-hide="static-modal"]');
                if (closeButton) {
                    closeButton.dispatchEvent(closeEvent);
                } else {
                    if (typeof Modal !== 'undefined') {
                        const modal = new Modal(modalEl);
                        modal.hide();
                    }
                }
            });
        });
    </script>
</div>
