<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Menangani permintaan autentikasi pengguna.
     */
    public function login(): void
    {
        $this->validate(); // Validasi form LoginForm.php

        $this->form->authenticate(); // Jalankan proses autentikasi dari form

        Session::regenerate(); // Hindari session fixation

        $user = auth()->user(); // Ambil user yang berhasil login

        // Jika user tidak memiliki role, logout dan kembalikan ke halaman utama
        if (!$user || !$user->role) {
            auth()->logout();
            Session::invalidate();
            Session::regenerateToken();
            $this->redirect(route('welcome'));
            return;
        }

        // Arahkan user ke dashboard sesuai rolenya
        switch ($user->role) {
            case 1:
                $this->redirectIntended(route('admin.dashboard'));
                break;
            case 2:
                $this->redirectIntended(route('kurir.dashboard'));
                break;
            case 3:
                $this->redirectIntended(route('user.dashboard'));
                break;
            default:
                auth()->logout();
                Session::invalidate();
                Session::regenerateToken();
                $this->redirect(route('welcome'));
                break;
        }
    }
};

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
