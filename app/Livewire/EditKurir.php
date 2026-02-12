<?php

namespace App\Livewire;

use App\Models\Kurir;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class EditKurir extends Component
{
    public $kurir_id;
    public $nama;
    public $email;
    public $password; // optional update
    public $no_tlp;
    public $currentUrl;

    public function mount($id)
    {
        $this->kurir_id = $id;
        $kurir = Kurir::findOrFail($id);

        $this->nama = $kurir->nama;
        $this->email = $kurir->email;
        $this->no_tlp = $kurir->no_tlp;

        $this->currentUrl = Request::url();
    }

    public function updateKurir()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:kurirs,email,' . $this->kurir_id,
            'no_tlp' => 'required|string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        $kurir = Kurir::findOrFail($this->kurir_id);
        $user = User::findOrFail($kurir->user_id);

        // Update data kurir
        $kurir->nama = $this->nama;
        $kurir->email = $this->email;
        $kurir->no_tlp = $this->no_tlp;
        if (!empty($this->password)) {
            $kurir->password = Hash::make($this->password);
        }
        $kurir->save();

        // Update juga di tabel users
        $user->name = $this->nama;
        $user->email = $this->email;
        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        session()->flash('message', 'Data kurir berhasil diperbarui.');
        return $this->redirect('/manage/kurir', navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-kurir', [
            'currentUrl' => url()->current(),
        ])->layout('admin-layout');
    }
}
