<?php

namespace App\Livewire;

use App\Models\BusinessTrip;
use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class PerdinComp extends Component
{
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
        $data = BusinessTrip::where('user_id', $user->id)->orderby('created_at', 'asc')->get();


        return view('livewire.perdin-comp', compact('data', 'city'))->extends('layouts.master');
    }



    public function updatedDepartureDate()
    {
        if ($this->departure_date && $this->return_date) {
            if (Carbon::parse($this->return_date)->lt(Carbon::parse($this->departure_date))) {
                $this->addError('return_date', 'The return date cannot be before the departure date.');
                $this->return_date = null;
            } else {
                $this->trip_duration = Carbon::parse($this->departure_date)->diffInDays(Carbon::parse($this->return_date)) + 1;
            }
        }
    }
    public function updatedReturnDate()
    {
        if ($this->departure_date && $this->return_date) {
            if (Carbon::parse($this->return_date)->lt(Carbon::parse($this->departure_date))) {
                $this->addError('return_date', 'The return date cannot be before the departure date.');
                $this->return_date = null;
            } else {
                $this->trip_duration = Carbon::parse($this->departure_date)->diffInDays(Carbon::parse($this->return_date)) + 1;
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
            } elseif ($departure->province == $return->province) {
                $this->total_allowance = 200000;
            } elseif ($departure->island == $return->island) {
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

        $this->validate($rules);


        $data = new BusinessTrip();
        $data->departure_date = $this->departure_date;
        $data->return_date = $this->return_date;
        $data->origin_city_id = $this->origin_city_id;
        $data->destination_city_id = $this->destination_city_id;
        $data->purpose_destination = $this->purpose_destination;
        $data->trip_duration = $this->trip_duration;
        $data->user_id = User::where('username', session('username'))->first()->id;
        $data->status = 'pending';
        $data->total_allowance = $this->total_allowance;




        if ($data->save()) {
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
