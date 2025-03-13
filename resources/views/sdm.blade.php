@extends('layouts.master')

@section('title', 'Page Title')



@section('content')
    <h3 class="text-lg font-semibold mb-3">PerdinKu</h3>

    <div class="bg-white w-full p-4 rounded-lg">
        <div class="w-full mx-auto">

            <div class="relative overflow-x-auto">
                <div class="flex justify-end">
                    <button
                        class="border cursor-pointer border-blue-500 hover:bg-blue-700 hover:text-white text-blue-500 font-bold py-3 px-4 rounded-lg mb-4">
                        + Tambah Perdin
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
@endsection
