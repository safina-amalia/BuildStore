<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    // Properti bind ke form
    public $name, $email, $password, $password_confirmation;
    public $alamat, $no_tlp;

    /* ───  action: register  ─── */
    public function register()
    {
        /* 1. Validasi */
        $this->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed|min:8',
            'alamat'                => 'required|string',
            'no_tlp'                => 'required|string',
        ]);

        /* 2. Simpan ke tabel users */
        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role'     => 0,               
        ]);

        /* 3. Simpan profil customer */
        Customer::create([
            'user_id' => $user->id,              
            'nama'    => $this->name,
            'alamat'  => $this->alamat,
            'no_tlp'  => $this->no_tlp,
        ]);

        /* 4. Login & redirect */
        auth()->login($user);
        return redirect()->route('dashboard');
        auth()->login($user);
        dd(auth()->user()); // cek apakah sudah login

        // auth()->register($user);
        // return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.pages.auth.register')
            ->layout('layouts.guest'); 
    }
}
