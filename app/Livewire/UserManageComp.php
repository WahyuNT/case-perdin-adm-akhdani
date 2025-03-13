<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\Hash;

class UserManageComp extends Component
{
    public $confirmDelete = null;
    public $passwordShow = 'password';
    public $mode = 'view';
    public $username, $role, $password, $editId;

    public function render()
    {
        $data = User::all();
        return view('livewire.user-manage-comp', compact('data'))->extends('layouts.master');
    }
    public function storeCreate()
    {
        $this->validate([
            'username' => 'required|unique:users,username,',
            'role' => 'required',
            'password' => 'required',
        ]);

        $data = new User();
        $data->username = $this->username;
        $data->role = $this->role;
        $data->password = Hash::make($this->password);

        if ($data->save()) {
            LivewireAlert::title('User berhasil dibuat!')->success()->show();
        } else {
            LivewireAlert::title('User gagal dibuat!')->error()->show();
        }
    }
    public function edit($id)
    {
        $data = User::find($id)->first();
        $this->mode = 'edit';
        $this->username = $data->username;
        $this->role = $data->role;
        $this->editId = $id;
    }
    public function storeEdit()
    {
        $this->validate([
            'username' => 'required|unique:users,username,' . $this->editId,
            'role' => 'required',
        ]);

        $data = User::find($this->editId)->first();
        $data->username = $this->username;
        $data->role = $this->role;
        if ($this->password) {
            $data->password = Hash::make($this->password);
        }

        if ($data->save()) {
            LivewireAlert::title('User berhasil diubah!')->success()->show();
            $this->resetInput();
        } else {
            LivewireAlert::title('User gagal diubah!')->success()->show();
        }
    }

    public function delete($id)
    {
        $data = User::find($id)->first();
        if ($data->delete()) {
            LivewireAlert::title('Data berhasil dihapus!')->success()->show();
        } else {
            LivewireAlert::title('Data gagal dihapus!')->success()->show();
        }
    }
    public function resetInput()
    {
        $this->username = '';
        $this->role = '';
        $this->password = '';
        $this->mode = 'view';
    }
}
