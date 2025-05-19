<div class="p-4 max-w-xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Tambah Kurir Baru</h2>

    @if (session()->has('message'))
        <div class="p-2 bg-green-200 text-green-800 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label for="name">Nama</label>
            <input type="text" wire:model="name" class="w-full border p-2 rounded" />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" wire:model="email" class="w-full border p-2 rounded" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" wire:model="password" class="w-full border p-2 rounded" />
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Kurir</button>
    </form>
</div>
