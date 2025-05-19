<?php

use App\Models\Customer; // Assuming you have a Customer model
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $nama = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $alamat = '';
    public string $no_tlp = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:customers'], // Change here to match customers
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'alamat' => ['required', 'string', 'max:255'],
            'no_tlp' => ['required', 'string', 'max:15'], // You can adjust the rules based on your needs
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Create the customer record in the database
        $customer = Customer::create($validated);

        // Fire the Registered event
        event(new Registered($customer));

        Auth::login($customer); // Assuming the login method can also handle Customer

        // Redirect based on the user role or other criteria as necessary
        if (auth()->user()->role == 1) {
            $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
        } else {
            $this->redirectIntended(route('/', absolute: false), navigate: true);
        }
    }
}; ?>

<div>
    <form wire:submit.prevent="register">
        <!-- Name -->
        <div>
            <x-input-label for="nama" :value="__('Name')" />
            <x-text-input wire:model="nama" id="nama" class="block mt-1 w-full" type="text" name="nama" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Address')" />
            <x-text-input wire:model="alamat" id="alamat" class="block mt-1 w-full" type="text" name="alamat" required />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <!-- No. Tlp -->
        <div class="mt-4">
            <x-input-label for="no_tlp" :value="__('Phone Number')" />
            <x-text-input wire:model="no_tlp" id="no_tlp" class="block mt-1 w-full" type="text" name="no_tlp" required />
            <x-input-error :messages="$errors->get('no_tlp')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>