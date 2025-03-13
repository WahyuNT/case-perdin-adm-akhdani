<?php

namespace App\Livewire;

use App\Models\BusinessTrip;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;


class PengajuanPerdinComp extends Component
{
    public $showId;
    public $detail = null;
    public $mode = 'new';
    public $dailyAllowance;
    public $dailyAllowanceDesc;
    public function render()
    {
        $pending = BusinessTrip::where('status', 'pending')->orderby('created_at', 'desc')->get();
        $history = BusinessTrip::where('status', '!=', 'pending')->orderby('created_at', 'desc')->get();
        $pendinCount = $pending->count();
        $this->detail = BusinessTrip::find($this->showId);
        if ($this->detail) {
            $this->calculateAlowance();
        }


        return view('livewire.pengajuan-perdin-comp', compact('pending', 'history', 'pendinCount'))->extends('layouts.master');
    }



    public function approve($id)
    {
        $data = BusinessTrip::find($id);
        $data->status = 'approved';
        if ($data->save()) {
            $this->dispatch('closeModal');
            LivewireAlert::title('Pengajuan Perjalanan Dinas berhasil diterima!')->success()->show();
        } else {
            LivewireAlert::title('Pengajuan Perjalanan Dinas gagal diterima!')->error()->show();
        }
    }

    public function reject($id)
    {
        $data = BusinessTrip::find($id);
        $data->status = 'rejected';
        if ($data->save()) {
            $this->dispatch('closeModal');
            LivewireAlert::title('Pengajuan Perjalanan Dinas berhasil ditolak!')->success()->show();
        } else {
            LivewireAlert::title('Pengajuan Perjalanan Dinas gagal ditolak!')->error()->show();
        }
    }

    public function calculateAlowance()
    {

        if ($this->detail->originCity->is_abroad == 1 || $this->detail->destinationCity->is_abroad == 1) {
            $this->dailyAllowance = 50;
        } else {
            if ($this->detail->distance <= 60) {
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
        }
    }
}
