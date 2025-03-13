<?php

namespace App\Livewire;

use App\Models\BusinessTrip;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class PerdinComp extends Component
{
    public $confirmDelete = null;
    public $mode = 'view';
    public $editId;
    public $departure_date, $return_date, $origin_city_id, $destination_city_id, $purpose_destination, $trip_duration;

    public function render()
    {
        $user = User::where('username', session('username'))->first();

        $data = BusinessTrip::where('user_id', $user->id)->get();
        return view('livewire.perdin-comp', compact('data'))->extends('layouts.master');
    }

    public function storeCreate()
    {
        $rules = [
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'origin_city_id' => 'required|integer',
            'destination_city_id' => 'required|integer',
            'purpose_destination' => 'required|string',
        ];

        $this->validate($rules);

        $this->trip_duration = Carbon::parse($this->departure_date)->diffInDays(Carbon::parse($this->return_date));

        $data = new BusinessTrip();
        $data->departure_date = $this->departure_date;
        $data->return_date = $this->return_date;
        $data->origin_city_id = $this->origin_city_id;
        $data->destination_city_id = $this->destination_city_id;
        $data->purpose_destination = $this->purpose_destination;
        $data->trip_duration = $this->trip_duration;

        if ($data->save()) {
            $this->alert('success', 'BusinessTrip berhasil dibuat!');
            $this->resetInput();
        } else {
            $this->alert('error', 'BusinessTrip gagal dibuat!');
        }
    }

    public function edit($id)
    {
        $data = BusinessTrip::findOrFail($id);
        $this->mode = 'edit';
        $this->editId = $id;

        $this->departure_date = $data->departure_date;
        $this->return_date = $data->return_date;
        $this->origin_city_id = $data->origin_city_id;
        $this->destination_city_id = $data->destination_city_id;
        $this->purpose_destination = $data->purpose_destination;
        $this->trip_duration = $data->trip_duration;
    }

    public function storeEdit()
    {
        $rules = [
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'origin_city_id' => 'required|integer',
            'destination_city_id' => 'required|integer',
            'purpose_destination' => 'required|string',
        ];

        $this->validate($rules);

        $this->trip_duration = Carbon::parse($this->departure_date)->diffInDays(Carbon::parse($this->return_date));

        $data = BusinessTrip::findOrFail($this->editId);
        $data->departure_date = $this->departure_date;
        $data->return_date = $this->return_date;
        $data->origin_city_id = $this->origin_city_id;
        $data->destination_city_id = $this->destination_city_id;
        $data->purpose_destination = $this->purpose_destination;
        $data->trip_duration = $this->trip_duration;

        if ($data->save()) {
            $this->alert('success', 'BusinessTrip berhasil diperbarui!');
            $this->resetInput();
        } else {
            $this->alert('error', 'BusinessTrip gagal diperbarui!');
        }
    }

    public function delete($id)
    {
        $data = BusinessTrip::findOrFail($id);
        if ($data->delete()) {
            $this->alert('success', 'BusinessTrip berhasil dihapus!');
        } else {
            $this->alert('error', 'BusinessTrip gagal dihapus!');
        }
    }

    public function resetInput()
    {
        $this->mode = 'view';
        $this->departure_date = '';
        $this->return_date = '';
        $this->origin_city_id = '';
        $this->destination_city_id = '';
        $this->purpose_destination = '';
        $this->trip_duration = '';
        $this->resetValidation();
    }

    private function alert($type, $message)
    {
        LivewireAlert::title($message)->$type()->show();
    }
}
