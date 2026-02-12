<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class EditAdminProfile extends Component
{
    public $user_id, $name, $email, $password;

    public function mount()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $user = User::find($this->user_id);

        if (!$user) {
            abort(404, 'User not found');
        }

        $this->validate([
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('users', 'name')->ignore($user->id),
            ],
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6',
        ], [
            'name.unique' => 'Nama sudah digunakan oleh admin lain.',
            'email.unique' => 'Email sudah digunakan oleh admin lain.',
        ]);

        $user->name = $this->name;
        $user->email = $this->email;

        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        session()->flash('success', 'Profil berhasil diperbarui!');
        return redirect()->route('admin.dashboard');
    }


    public function render()
{
    return view('livewire.edit-admin-profile')
        ->layout('admin-layout', ['title' => 'Edit Profil Admin']);
}

}
