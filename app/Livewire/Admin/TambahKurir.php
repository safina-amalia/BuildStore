<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class TambahKurir extends Component
{
    public $name, $email, $password;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => '0', // pastikan ada kolom role di tabel users
        ]);

        session()->flash('message', 'Kurir berhasil ditambahkan.');
        $this->reset(); // clear input
    }

    public function render()
    {
        
        return view('livewire.admin.tambah-kurir');
    }
}
