<?php

namespace App\Livewire;

use App\Models\BusinessTrip;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithPagination;

class PengajuanPerdinComp extends Component
{
    use WithPagination;
    public $showId;
    public $detail = null;
    public $mode = 'new';
    public $dailyAllowance;
    public $dailyAllowanceDesc;
 
    public $currency = 'IDR';

    public function render()
    {
        if ($this->mode == 'new') {
            $data = BusinessTrip::where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $data = BusinessTrip::whereIn('status', ['approved', 'rejected'])
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        }

        $pendingCount = BusinessTrip::where('status', 'pending')->count();

        $this->detail = BusinessTrip::where('id', $this->showId)->first();
        if ($this->detail) {
            $this->calculateAlowance();
        }

        $this->dispatch('closeModal');
        return view('livewire.pengajuan-perdin-comp', compact('data', 'pendingCount'))->extends('layouts.master');
    }

    public function openModal($id)
    {
        $this->showId = $id;
    }


    public function approve($id)
    {
        $data = BusinessTrip::where('id', $id)->first();
        $data->status = 'approved';
        if ($data->save()) {

            LivewireAlert::title('Pengajuan Perjalanan Dinas Berhasil Diterima!')->success()->show();
        } else {
            LivewireAlert::title('Pengajuan Perjalanan Dinas Gagal Diterima!')->error()->show();
        }
        $this->dispatch('closeModal');
    }

    public function reject($id)
    {
        $data = BusinessTrip::where('id', $id)->first();
        $data->status = 'rejected';
        if ($data->save()) {

            LivewireAlert::title('Pengajuan Perjalanan Dinas Berhasil Ditolak!')->success()->show();
        } else {
            LivewireAlert::title('Pengajuan Perjalanan Dinas Gagal Ditolak!')->error()->show();
        }
        $this->dispatch('closeModal');
    }

    public function calculateAlowance()
    {

        if ($this->detail->originCity->is_abroad == 1 || $this->detail->destinationCity->is_abroad == 1) {
            $this->dailyAllowance = 50;
            $this->dailyAllowanceDesc = '> 60 km, beda negara';
            $this->currency = '$';
        } else {
            if ($this->detail->distance <= 60) {
                $this->dailyAllowance = 0;
                $this->dailyAllowanceDesc = '≤ 60 km';
            } elseif (strtolower($this->detail->originCity->province) == strtolower($this->detail->destinationCity->province)) {
                $this->dailyAllowance = 200000;
                $this->dailyAllowanceDesc = '> 60 km, satu provinsi';
            } elseif (strtolower($this->detail->originCity->island) == strtolower($this->detail->destinationCity->island)) {
                $this->dailyAllowance = 250000;
                $this->dailyAllowanceDesc = '> 60 km, satu pulau';
            } else {
                $this->dailyAllowance = 300000;
                $this->dailyAllowanceDesc = '> 60 km, beda pulau';
            }
            $this->currency = 'Rp ';
        }
    }
    public function changeMode($mode)
    {
        $this->mode = $mode;
        $this->resetPage();
    }
}
