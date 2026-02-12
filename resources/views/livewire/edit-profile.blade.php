<div>
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="bg-slate-100 rounded-xl shadow p-4 sm:p-7">
            @if (session()->has('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                    class="fixed top-4 right-4 bg-green-600 text-white px-4 py-2 rounded shadow-lg z-50">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit.prevent="update">
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 border-t border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800">Edit Profil Customer</h2>
                    </div>

                    <!-- Nama (sinkron users.name & customers.nama) -->
                    <div class="sm:col-span-3">
                        <label for="nama" class="inline-block text-sm font-medium text-gray-500 mt-2.5">Nama</label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="text" wire:model.defer="nama" id="nama"
                            class="py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
                            autocomplete="off">
                        @error('nama')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-3">
                        <label for="email"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5">Email</label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="email" wire:model.defer="email" id="email"
                            class="py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
                            autocomplete="off">
                        @error('email')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password (opsional) -->
                    <div class="sm:col-span-3">
                        <label for="password" class="inline-block text-sm font-medium text-gray-500 mt-2.5">Password
                            (opsional)</label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="password" wire:model.defer="password" id="password"
                            class="py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Kosongkan jika tidak ingin mengubah password">
                        @error('password')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat (customers.alamat) -->
                    <div class="sm:col-span-3">
                        <label for="alamat"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5">Alamat</label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="text" wire:model.defer="alamat" id="alamat"
                            class="py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
                            autocomplete="off">
                        @error('alamat')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- No Telepon (customers.no_tlp) -->
                    <div class="sm:col-span-3">
                        <label for="no_tlp" class="inline-block text-sm font-medium text-gray-500 mt-2.5">No
                            Telepon</label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="text" wire:model.defer="no_tlp" id="no_tlp"
                            class="py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
                            autocomplete="off">
                        @error('no_tlp')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @if (session()->has('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow-sm text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="flex justify-end gap-3 mt-6">
                    <!-- Tombol Batal -->
                    <button type="button" onclick="window.location.href='{{ route('user.dashboard') }}'"
                        class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-2000 focus:outline-none focus:ring-2 focus:ring-red-500 disabled:opacity-50
                        disabled:pointer-events-none"
                        wire:loading.attr="disabled">
                        <div wire:loading
                            class="animate-spin inline-block w-4 h-4 border-3 border-current border-t-transparent rounded-full"
                            role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Batal
                    </button>

                    <!-- Tombol Simpan -->
                    <button type="submit"
                        class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                        wire:loading.attr="disabled">
                        <div wire:loading
                            class="animate-spin inline-block w-4 h-4 border-3 border-current border-t-transparent rounded-full"
                            role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
