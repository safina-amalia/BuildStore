<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <form wire:submit.prevent="register">
        <!-- Nama -->
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama</label>
            <input wire:model="nama" id="nama" type="text" required autofocus
                class="w-full px-3 py-2 border rounded @error('nama') border-red-500 @enderror" />
            @error('nama') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
            <input wire:model="email" id="email" type="email" required
                class="w-full px-3 py-2 border rounded @error('email') border-red-500 @enderror" />
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
            <input wire:model="password" id="password" type="password" required autocomplete="new-password"
                class="w-full px-3 py-2 border rounded @error('password') border-red-500 @enderror" />
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password Confirmation -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Konfirmasi Password</label>
            <input wire:model="password_confirmation" id="password_confirmation" type="password" required autocomplete="new-password"
                class="w-full px-3 py-2 border rounded @error('password_confirmation') border-red-500 @enderror" />
            @error('password_confirmation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label for="alamat" class="block text-gray-700 font-semibold mb-1">Alamat</label>
            <input wire:model="alamat" id="alamat" type="text" required
                class="w-full px-3 py-2 border rounded @error('alamat') border-red-500 @enderror" />
            @error('alamat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- No Telepon -->
        <div class="mb-6">
            <label for="no_tlp" class="block text-gray-700 font-semibold mb-1">No Telepon</label>
            <input wire:model="no_tlp" id="no_tlp" type="text" required
                class="w-full px-3 py-2 border rounded @error('no_tlp') border-red-500 @enderror" />
            @error('no_tlp') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded">
            Register
        </button>
    </form>
</div>
