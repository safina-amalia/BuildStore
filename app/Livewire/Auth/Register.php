<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Register extends Component
{
    public string $nama = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $alamat = '';
    public string $no_tlp = '';

    public function register(): void
    {
        $validated = $this->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'alamat' => ['required', 'string', 'max:255'],
            'no_tlp' => ['required', 'string', 'max:15'],
        ]);

        // Simpan ke tabel users
        $user = User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 3,
        ]);

        // Simpan ke tabel customers
        Customer::create([
            'user_id' => $user->id,
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // <- ditambahkan ini
            'alamat' => $validated['alamat'],
            'no_tlp' => $validated['no_tlp'],
        ]);

        event(new Registered($user));
        Auth::login($user);

        $this->redirectIntended(route('/'));
    }

    public function render()
    {
        return view('livewire.pages.auth.register');
    }
}
