<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class LoginComp extends Component
{
    public $username;
    public $password;

    public function mount()
    {
        if (session('username')) {
            return redirect()->route('manajemen-user');
        }
    }
    public function render()
    {

        return view('livewire.login-comp')->extends('layouts.master-auth');
    }
    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $this->username)->first();

        if ($user && Hash::check($this->password, $user->password)) {
            session()->put([
                'username' => $user->username,
                'role' => $user->role
            ]);

            session()->flash('success', 'Login Berhasil!');

            return match ($user->role) {
                'admin' => redirect()->route('manajemen-user'),
                'pegawai' => redirect()->route('perdinku'),
                'sdm' => redirect()->route('pengajuan-perdin'),
            };
        }

        session()->flash('error', 'Username atau password salah.');
        return back();
    }
    public function forgot()
    {
        session()->flash('error', 'Silahkan menghubungi Admin.');
    }
}
