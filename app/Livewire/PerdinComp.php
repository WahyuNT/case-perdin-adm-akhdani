<?php

namespace App\Livewire;

use App\Models\BusinessTrip;
use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithPagination;

class PerdinComp extends Component
{
    use WithPagination;
    public $confirmDelete = null;
    public $departure_date = null;
    public $return_date = null;
    public $origin_city_id = null;
    public $destination_city_id = null;
    public $purpose_destination = null;
    public $trip_duration = null;
    public $distance = null;
    public $total_allowance = null;

    public function render()
    {
        $user = User::where('username', session('username'))->first();
        $city = City::all();
        $data = BusinessTrip::where('user_id', $user->id)->orderby('created_at', 'asc')->paginate(10);

        return view('livewire.perdin-comp', compact('data', 'city'))->extends('layouts.master');
    }



    public function updatedDepartureDate()
    {
        if ($this->departure_date && $this->return_date) {
            if (Carbon::parse($this->return_date)->lt(Carbon::parse($this->departure_date))) {
                $this->addError('departure_date', 'Tanggal berangkat tidak boleh setlah tanggal kepulangan.');
                $this->departure_date = null;
                $this->trip_duration = null;

            } else {
                $this->trip_duration = Carbon::parse($this->departure_date)->diffInDays(Carbon::parse($this->return_date)) + 1;
                $this->resetValidation('departure_date');
            }
        }
    }
    public function updatedReturnDate()
    {
        if ($this->departure_date && $this->return_date) {
            if (Carbon::parse($this->return_date)->lt(Carbon::parse($this->departure_date))) {
                $this->addError('return_date', 'Tanggal kembali tidak boleh sebelum tanggal keberangkatan.');
                $this->return_date = null;
                $this->trip_duration = null;
            } else {
                $this->trip_duration = Carbon::parse($this->departure_date)->diffInDays(Carbon::parse($this->return_date)) + 1;
                $this->resetValidation('return_date');
            }
        }
    }
    public function updatedOriginCityId()
    {
        if ($this->origin_city_id && $this->destination_city_id) {
            $departure = City::where('id', $this->origin_city_id)->first();
            $return = City::where('id', $this->destination_city_id)->first();

            $departure_lat = (float) $departure->latitude;
            $departure_lon = (float) $departure->longitude;
            $return_lat = (float) $return->latitude;
            $return_lon = (float) $return->longitude;

            $this->distance = $this->calculateDistance($departure_lat, $departure_lon, $return_lat, $return_lon);
            $this->calculateAlowance();
        }
    }
    public function updatedDestinationCityId()
    {
        if ($this->origin_city_id && $this->destination_city_id) {
            $departure = City::where('id', $this->origin_city_id)->first();
            $return = City::where('id', $this->destination_city_id)->first();

            $departure_lat = (float) $departure->latitude;
            $departure_lon = (float) $departure->longitude;
            $return_lat = (float) $return->latitude;
            $return_lon = (float) $return->longitude;

            $this->distance = $this->calculateDistance($departure_lat, $departure_lon, $return_lat, $return_lon);
            $this->calculateAlowance();
        }
    }

    public function calculateDistance($departure_lat, $departure_lon, $return_lat, $return_lon)
    {
        $earthRadius = 6371;

        $departure_lat = deg2rad($departure_lat);
        $departure_lon = deg2rad($departure_lon);
        $return_lat = deg2rad($return_lat);
        $return_lon = deg2rad($return_lon);

        $dLat = $return_lat - $departure_lat;
        $dLon = $return_lon - $departure_lon;

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos($departure_lat) * cos($return_lat) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return (int) round($earthRadius * $c);
    }

    public function calculateAlowance()
    {
        $departure = City::where('id', $this->origin_city_id)->first();
        $return = City::where('id', $this->destination_city_id)->first();
        if ($departure->is_abroad == 1 || $return->is_abroad == 1) {
            $this->total_allowance = 50;
        } else {
            if ($this->distance <= 60) {
                $this->total_allowance = 0;
            } elseif (strtolower($departure->province) == strtolower($return->province)) {
                $this->total_allowance = 200000;
            } elseif (strtolower($departure->island) == strtolower($return->island)) {
                $this->total_allowance = 250000;
            } else {
                $this->total_allowance = 300000;
            }
        }
    }



    public function store()
    {

        $rules = [
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'origin_city_id' => 'required|integer',
            'destination_city_id' => 'required|integer',
            'purpose_destination' => 'required|string',
        ];
        $messages = [
            'departure_date.required' => 'Tanggal keberangkatan wajib diisi.',
            'departure_date.date' => 'Format tanggal keberangkatan tidak valid.',

            'return_date.required' => 'Tanggal kembali wajib diisi.',
            'return_date.date' => 'Format tanggal kembali tidak valid.',
            'return_date.after_or_equal' => 'Tanggal kembali harus setelah atau sama dengan tanggal keberangkatan.',

            'origin_city_id.required' => 'Kota asal wajib dipilih.',
            'origin_city_id.integer' => 'Kota asal tidak valid.',

            'destination_city_id.required' => 'Kota tujuan wajib dipilih.',
            'destination_city_id.integer' => 'Kota tujuan tidak valid.',

            'purpose_destination.required' => 'Keterangan wajib diisi.',
            'purpose_destination.string' => 'Keterangan harus berupa teks.',
        ];

        $this->validate($rules, $messages);


        $data = new BusinessTrip();
        $data->departure_date = $this->departure_date;
        $data->return_date = $this->return_date;
        $data->origin_city_id = $this->origin_city_id;
        $data->destination_city_id = $this->destination_city_id;
        $data->purpose_destination = $this->purpose_destination;
        $data->trip_duration = $this->trip_duration;
        $data->user_id = User::where('username', session('username'))->first()->id;
        $data->status = 'pending';
        $data->distance = $this->distance;
        $data->total_allowance = $this->total_allowance;




        if ($data->save()) {
            $this->dispatch('closeModal');
            LivewireAlert::title('Perjalanan Dinas berhasil dibuat!')->success()->show();

            $this->resetInput();
        } else {
            LivewireAlert::title('Perjalanan Dinas gagal dibuat!')->error()->show();
        }
    }



    public function resetInput()
    {

        $this->departure_date = '';
        $this->return_date = '';
        $this->origin_city_id = '';
        $this->destination_city_id = '';
        $this->purpose_destination = '';
        $this->trip_duration = '';
        $this->resetValidation();
    }
}
