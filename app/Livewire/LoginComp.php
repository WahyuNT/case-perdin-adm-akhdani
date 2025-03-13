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
            if (session('role') == 'admin') {
                return redirect()->route('manajemen-user');
            } elseif (session('role') == 'pegawai') {
                return redirect()->route('perdinku');
            } elseif (session('role') == 'sdm') {
                return redirect()->route('sdm');
            }
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
            session(['username' => $user->username, 'role' => $user->role]);
            session()->flash('success', 'Login Berhasil!');
            if ($user->role == 'admin') {
                return redirect()->route('manajemen-user');
            } elseif ($user->role == 'pegawai') {
                return redirect()->route('perdinku');
            } elseif ($user->role == 'sdm') {
                return redirect()->route('sdm');
            }
        }

        session()->flash('error', 'Username atau password salah!');
    }
}
