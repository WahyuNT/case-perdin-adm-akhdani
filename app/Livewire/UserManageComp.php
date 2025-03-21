<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class UserManageComp extends Component
{
    use WithPagination;
    public $confirmDelete = null;
    public $passwordShow = 'password';
    public $mode = 'view';
    public $username, $role, $password, $editId,$isYou = false;


    public function render()
    {
        $data = User::orderby('created_at', 'desc')->paginate(10);
        return view('livewire.user-manage-comp', compact('data'))->extends('layouts.master');
    }
    public function storeCreate()
    {
        $messages = [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',

            'role.required' => 'Role wajib dipilih.',

            'password.required' => 'Password wajib diisi.',
        ];
        $this->validate([
            'username' => 'required|unique:users,username,',
            'role' => 'required',
            'password' => 'required',
        ], $messages);

        $data = new User();
        $data->username = $this->username;
        $data->role = $this->role;
        $data->password = Hash::make($this->password);

        if ($data->save()) {
            LivewireAlert::title('User berhasil dibuat!')->success()->show();
            $this->resetInput();
        } else {
            LivewireAlert::title('User gagal dibuat!')->error()->show();
        }
    }
    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        $this->mode = 'edit';
        $this->username = $data->username;
        $this->role = $data->role;
        $this->editId = $id;
        if($data->username == session('username')){
            $this->isYou = true;
        }
    }
    public function storeEdit()
    {
        $messages = [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',

            'role.required' => 'Role wajib dipilih.',
        ];
        $this->validate([
            'username' => 'required|unique:users,username,' . $this->editId,
            'role' => 'required',
        ], $messages);


        $data = User::where('id', $this->editId)->first();
        $data->username = $this->username;
        $data->role = $this->role;
        if ($this->password) {
            $data->password = Hash::make($this->password);
        }
        if($this->isYou == 'true'){
            session(['username' => $this->username]);
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
        $data = User::where('id', $id)->first();
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
        $this->isYou = false;
        $this->mode = 'view';
    }
}
