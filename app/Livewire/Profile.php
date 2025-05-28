<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Profile extends Component
{
    public $name;
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $delete_password;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfileInformation()
    {
        $user = Auth::user();

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        // Check if email changed, then clear email_verified_at
        if ($this->email !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        session()->flash('message', 'Profile updated successfully.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }

        $user->password = Hash::make($this->password);
        $user->save();

        // Reset form fields
        $this->reset(['current_password', 'password', 'password_confirmation']);

        session()->flash('message_password', 'Password updated successfully.');
    }

    public function deleteUser()
    {
        $this->validate([
            'delete_password' => ['required'],
        ]);

        $user = Auth::user();

        if (!Hash::check($this->delete_password, $user->password)) {
            $this->addError('delete_password', 'The password is incorrect.');
            return;
        }

        Auth::logout();

        $user->delete();

        return redirect('/');
    }

    public function render()
    {
        $user = Auth::user();

        return view('livewire.profile', [
            'userRole' => $user->role,  // Asumsi kamu punya kolom role di users table
        ]);
    }
}
