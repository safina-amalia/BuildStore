<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Customer;

class EditProfile extends Component
{
    public $nama, $email, $password, $alamat, $no_tlp;
    public $user_id;

    public function mount()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $this->user_id = $user->id;

        // Ambil data user dan customer
        $this->nama = $user->name;    // ambil dari users.name
        $this->email = $user->email;

        $customer = Customer::where('user_id', $this->user_id)->first();
        $this->alamat = $customer?->alamat;
        $this->no_tlp = $customer?->no_tlp;
    }

    public function update()
    {
        $this->validate([
            'nama' => [
                'required', 'string', 'max:255',
                Rule::unique('users', 'name')->ignore($this->user_id),
            ],
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],
            'password' => 'nullable|string|min:6',
            'alamat' => 'nullable|string',
            'no_tlp' => 'nullable|string',
        ], [
            'nama.unique' => 'Nama sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        // Update users table (name dan email)
        $user = User::find($this->user_id);
        $user->name = $this->nama;   // update name di users dari input nama
        $user->email = $this->email;
        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        // Update atau buat data customer, juga update nama di customers.nama dari input nama yang sama
        Customer::updateOrCreate(
            ['user_id' => $this->user_id],
            [
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'no_tlp' => $this->no_tlp,
            ]
        );

        $this->password = '';

        session()->flash('success', 'Profil berhasil diperbarui!');
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
