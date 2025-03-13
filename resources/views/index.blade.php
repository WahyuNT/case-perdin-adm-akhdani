@extends('layouts.master')

@section('title', 'Page Title')



@section('content')
    <h3 class="text-lg font-semibold mb-3">Pengajuan Perdin</h3>

    <div class="bg-white w-full p-4 rounded-lg">
        <div class="w-full mx-auto">

            <div class=" border-gray-200  mb-4">
                <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 aria-selected:border-b-3  aria-selected:border-blue-500 aria-selected:text-blue-500 aria-selected:font-bold"
                            id="pengajuan_baru-tab" data-tabs-target="#pengajuan_baru" type="button" role="tab"
                            aria-controls="pengajuan_baru" aria-selected="true">
                            Pengajuan Baru
                        </button>

                    </li>
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 aria-selected:border-b-3  aria-selected:border-blue-500 aria-selected:text-blue-500 aria-selected:font-bold"
                            id="history_penjualan-tab" data-tabs-target="#history_penjualan" type="button" role="tab"
                            aria-controls="history_penjualan" aria-selected="false">History Pengajuan</button>
                    </li>

                </ul>
            </div>
            <div id="myTabContent">
                <div class="bg-gray-50 p-4 rounded-lg  hidden" id="pengajuan_baru" role="tabpanel"
                    aria-labelledby="profile-tab">
                    <div class="relative overflow-x-auto">
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
                                <tr class="bg-white border-b  border-gray-200  ">

                                    <td class="px-6 py-4 align-top">
                                        1
                                    </td>
                                    <td class="px-6 py-4 align-top ">
                                        Walter White
                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        Bandung <i class="fa-solid fa-arrow-right"></i> Surabaya
                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        28 Sep - 09 Oct 2022 <span class="text-gray-400 text-light">(12 Hari)</span>
                                    </td>
                                    <td class="px-6 py-4 align-top text-ellipsis max-w-80">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe ex ipsum voluptatum,
                                        asperiores deserunt quibusdam
                                    </td>
                                    <td class="px-6 py-4 align-top text-blue-400 text-center">
                                        <i class="fa-solid fa-eye"></i>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="bg-gray-50 p-4 rounded-lg " id="history_penjualan" role="tabpanel"
                    aria-labelledby="dashboard-tab">
                    <div class="relative overflow-x-auto">
                        <div class="flex justify-end">
                            <button
                                class="border cursor-pointer border-blue-500 hover:bg-blue-700 hover:text-white text-blue-500 font-bold py-2 px-4 rounded-lg mb-4">
                                Tambah Kota
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

                                    <th scope="col" class="px-6 py-3">
                                        Luar Negeri
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
                                <tr class="bg-white border-b  border-gray-200  ">

                                    <td class="px-6 py-4 align-top">
                                        1
                                    </td>
                                    <td class="px-6 py-4 align-top ">
                                        Bandung
                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        Jawa Barat
                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        Jawa
                                    </td>
                                    <td class="px-6 py-4 align-top text-ellipsis max-w-80">
                                        Tidak
                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        -6.917500
                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        107.619.100
                                    </td>

                                    <td class="px-6 py-4 align-top  text-center">
                                        <div class="flex  justify-center">
                                            <button
                                                class="text-blue-400 cursor-pointer hover:text-blue-500 hover:bg-gray-200 rounded-full p-1">
                                                <i class="fa-solid fa-pencil "></i>
                                            </button>
                                            <button
                                                class="text-red-400 cursor-pointer hover:text-red-500 hover:bg-gray-200 rounded-full p-1">
                                                <i class="fa-solid fa-trash "></i>
                                            </button>
                                        </div>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>


    </div>
@endsection
