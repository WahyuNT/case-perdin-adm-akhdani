<?php

namespace App\Livewire;

use App\Models\City;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\Hash;


class CityMasterComp extends Component
{
    public $confirmDelete = null;
    public $mode = 'view';
    public $editId;
    public $city_name, $latitude, $longitude, $province, $island, $is_abroad, $country;

    public function mount()
    {
        $role = session('role');
        if ($role == 'pegawai') {
            return redirect()->route('perdinku');
        }
    }
    public function render()
    {
        $data = City::all();
        return view('livewire.city-master-comp', compact('data'))->extends('layouts.master');
    }

    public function storeCreate()
    {
        $rules = [
            'city_name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'province' => 'required',
            'island' => 'required',
            'is_abroad' => 'required',
        ];

        if ($this->is_abroad == 1) {
            $rules['country'] = 'required';
        }

        $data = new City();
        $data->city_name = $this->city_name;
        $data->latitude = $this->latitude;
        $data->longitude = $this->longitude;
        $data->province = $this->province;
        $data->island = $this->island;
        $data->is_abroad = $this->is_abroad;
        $data->country = $this->country;

        if ($data->save()) {
            $this->alert('success', 'City berhasil dibuat!');
            $this->resetInput();
        } else {
            $this->alert('error', 'City gagal dibuat!');
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
        $rules = [
            'city_name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'province' => 'required',
            'island' => 'required',
            'is_abroad' => 'required',
        ];

        if ($this->is_abroad == 1) {
            $rules['country'] = 'required';
        }

        $this->validate($rules);

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
