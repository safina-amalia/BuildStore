<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Kurir;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddKurir extends Component
{
    public $nama;
    public $email;
    public $password;
    public $no_tlp;
    public $currentUrl;

    public function save()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:kurirs,email',
            'password' => 'required|string|min:6',
            'no_tlp' => 'required|string|max:20',
        ]);

        // Buat user terlebih dahulu
        $user = User::create([
            'name' => $this->nama,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 2, // Role untuk kurir
        ]);

        // Simpan ke tabel kurirs
        Kurir::create([
            'user_id' => $user->id,
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'no_tlp' => $this->no_tlp,
        ]);

        return $this->redirect('/manage/kurir', navigate: true);
    }

    public function render()
    {
        $current_url = url()->current();
        $explode_url = explode('/', $current_url);
        $this->currentUrl = $explode_url[3] . ' ' . ($explode_url[4] ?? '');

        return view('livewire.add-kurir')->layout('admin-layout');
    }
}
