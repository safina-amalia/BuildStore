<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Kurir;

class EditKurirProfile extends Component
{
    public $user_id, $kurir_id;
    public $nama, $email, $password, $no_tlp;

    public function mount()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 2) {
            abort(403, 'Unauthorized');
        }

        $this->user_id = $user->id;

        $kurir = Kurir::where('user_id', $this->user_id)->firstOrFail();
        $this->kurir_id = $kurir->id;
        $this->nama = $kurir->nama;
        $this->email = $kurir->email;
        $this->no_tlp = $kurir->no_tlp;
    }

    public function update()
    {
        $user = User::find($this->user_id);
        $kurir = Kurir::find($this->kurir_id);

        if (!$user || !$kurir) {
            abort(404, 'Data tidak ditemukan');
        }

        $this->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('kurirs', 'email')->ignore($this->kurir_id)],
            'no_tlp' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:6'],
        ], [
            'email.unique' => 'Email sudah digunakan oleh kurir lain.',
        ]);

        // Update tabel `kurirs`
        $kurir->nama = $this->nama;
        $kurir->email = $this->email;
        $kurir->no_tlp = $this->no_tlp;
        if (!empty($this->password)) {
            $kurir->password = Hash::make($this->password);
        }
        $kurir->save();

        // Update tabel `users`
        $user->name = $this->nama;
        $user->email = $this->email;
        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        session()->flash('success', 'Profil berhasil diperbarui!');
        return redirect()->route('kurir.dashboard');
    }

    public function render()
    {
        return view('livewire.edit-kurir-profile')
            ->layout('kurir-layout', ['title' => 'Edit Profil Kurir']);
    }
}
