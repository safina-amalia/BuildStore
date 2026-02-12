<div>
    <div class="max-w-4xl mx-auto p-4 bg-slate-100 rounded-xl shadow">
        @if (session()->has('success'))
            <div class="fixed top-4 right-4 bg-green-600 text-white px-4 py-2 rounded shadow-lg z-50">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="update">
            <div class="grid gap-4 py-8">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-500">Nama</label>
                    <input type="text" wire:model.defer="name" id="name"
                        class="mt-1 py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm"
                        autocomplete="off">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-500">Email</label>
                    <input type="email" wire:model.defer="email" id="email"
                        class="mt-1 py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm"
                        autocomplete="off">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-500">Password (Optional)</label>
                    <input type="password" wire:model.defer="password" id="password"
                        class="mt-1 py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="window.location.href='{{ route('admin.dashboard') }}'"
                    class="py-2 px-4 bg-red-600 text-white rounded-lg">Batal</button>
                <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
