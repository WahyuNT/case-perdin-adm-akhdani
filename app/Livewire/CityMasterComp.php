<?php

namespace App\Livewire;

use App\Models\City;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;

class CityMasterComp extends Component
{
    use WithPagination;
    public $confirmDelete = null;
    public $mode = 'view';
    public $editId;
    public $listMaps = [];
    public $listMapsError = null;
    public $city_name, $latitude, $longitude, $province, $island, $is_abroad, $country;

    protected array $rules = [
        'city_name' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'province' => 'required',
        'is_abroad' => 'required',
    ];

    protected array $messages = [
        'city_name.required' => 'Nama kota wajib diisi.',
        'latitude.required' => 'Latitude wajib diisi.',
        'longitude.required' => 'Longitude wajib diisi.',
        'province.required' => 'Provinsi wajib diisi.',

        'is_abroad.required' => 'Status luar negeri wajib diisi.',
        'country.required' => 'Negara wajib diisi jika kota berada di luar negeri.',
    ];

    public function render()
    {
        $data = City::orderby('created_at', 'desc')->paginate('10');
        return view('livewire.city-master-comp', compact('data'))->extends('layouts.master');
    }
    public function searchMaps()
    {
        $this->reset('listMaps', 'listMapsError');
        $responseApi = Http::withHeaders([
            'User-Agent' => 'case-perdin'
        ])->get('https://nominatim.openstreetmap.org/search', [
            'q' => $this->city_name,
            'format' => 'json',
            'accept-language' => 'id'
        ]);

        if ($responseApi->successful()) {
            $data = $responseApi->json();

            if (!empty($data)) {
                $this->listMaps = $data;
            } else {
                $this->listMapsError = 'Lokasi tidak ditemukan, silakan masukkan data secara manual.';
            }
        } else {
            $this->listMapsError = 'Terjadi kesalahan saat mengambil data lokasi.';
        }
    }

    public function selectMaps($latitude, $longitude)
    {

        $this->latitude = $latitude;
        $this->longitude = $longitude;

        $responseApi = Http::withHeaders([
            'User-Agent' => 'case-perdin'
        ])->get('https://nominatim.openstreetmap.org/reverse', [
            'lat' => $latitude,
            'lon' => $longitude,
            'format' => 'json',
            'accept-language' => 'id'
        ]);


        $this->city_name = $responseApi->json()['address']['city'] ?? $responseApi->json()['address']['county'] ?? null;
        $this->island = $responseApi->json()['address']['region'] ?? null;
        $this->country = $responseApi->json()['address']['country'] ?? null;
        $this->province = $responseApi->json()['address']['state'] ?? null;
        $this->is_abroad = ($responseApi->json()['address']['country'] ?? null) == 'Indonesia' ? 0 : 1;
        $this->reset('listMaps', 'listMapsError');

        $this->resetValidation();
    }

    public function storeCreate()
    {


        $this->validate($this->rules, $this->messages);




        $data = new City();
        $data->city_name = $this->city_name;
        $data->latitude = $this->latitude;
        $data->longitude = $this->longitude;
        $data->province = $this->province;
        $data->island = $this->island;
        $data->is_abroad = $this->is_abroad;
        $data->country = $this->country;

        if ($data->save()) {
            $this->alert('success', 'Data Kota berhasil dibuat!');
            $this->resetInput();
        } else {
            $this->alert('error', 'Data Kota gagal dibuat!');
        }
    }

    public function edit($id)
    {
        $data = City::where('id', $id)->first();
        $this->mode = 'edit';
        $this->editId = $id;

        $this->city_name = $data->city_name;
        $this->latitude = $data->latitude;
        $this->longitude = $data->longitude;
        $this->province = $data->province;
        $this->island = $data->island;
        $this->is_abroad = $data->is_abroad;
        $this->country = $data->country;
    }

    public function storeEdit()
    {
        $this->validate($this->rules, $this->messages);

        $data = City::where('id', $this->editId)->first();
        $data->city_name = $this->city_name;
        $data->latitude = $this->latitude;
        $data->longitude = $this->longitude;
        $data->province = $this->province;
        $data->island = $this->island;
        $data->is_abroad = $this->is_abroad;
        $data->country = $this->country;

        if ($data->save()) {
            $this->alert('success', 'Data Kota berhasil diubah!');
            $this->resetInput();
        } else {
            $this->alert('error', 'Data Kota gagal diubah!');
        }
    }

    public function delete($id)
    {
        $data = City::where('id', $id)->first();
        if ($data->delete()) {
            $this->alert('success', 'Data berhasil dihapus!');
        } else {
            $this->alert('error', 'Data gagal dihapus!');
        }
    }

    public function resetInput()
    {

        $this->mode = 'view';
        $this->city_name = '';
        $this->latitude = '';
        $this->longitude = '';
        $this->province = '';
        $this->island = '';
        $this->is_abroad = '';
        $this->country = '';
        $this->resetValidation();
    }

    private function alert($type, $message)
    {
        LivewireAlert::title($message)->$type()->show();
    }
}
