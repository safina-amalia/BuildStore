<div>
    @if (session()->has('message'))
        <div class="p-3 mb-3 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <livewire:bread-crumb :url="$currentUrl" />

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">
                                    Kurir
                                </h2>
                                <p class="text-sm text-gray-600">
                                    Tambah, ubah, dan hapus data kurir.
                                </p>
                            </div>

                            <div class="inline-flex gap-x-2">
                                <div class="max-w-md space-y-3">
                                    <input type="search" wire:model.live.debounce.300="search"
                                        class="peer py-3 px-4 block w-full bg-gray-100 border-blue-500 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                        placeholder="Search kurir">
                                </div>

                                <a href="{{ route('add.kurir') }}"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Tambah Kurir
                                </a>
                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 px-5">
                                <tr>
                                    @include('livewire.theaders.th', [
                                        'name' => 'nama',
                                        'columnName' => 'Nama Kurir',
                                    ])
                                    @include('livewire.theaders.th', [
                                        'name' => 'email',
                                        'columnName' => 'Email',
                                    ])
                                    @include('livewire.theaders.th', [
                                        'name' => 'no_tlp',
                                        'columnName' => 'No Telepon',
                                    ])
                                    @include('livewire.theaders.th', [
                                        'name' => 'created_at',
                                        'columnName' => 'Tanggal Dibuat',
                                    ])
                                    <th class="px-6 py-3 text-end"></th>
                                    <th class="px-6 py-3 text-end"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse ($kurirs as $kurir)
                                    <tr wire:key="{{ $kurir->id }}">
                                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">
                                            {{ $kurir->nama }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $kurir->email ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $kurir->no_tlp ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $kurir->created_at->format('D, d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 text-end">
                                            <a href="{{ route('edit.kurir', ['id' => $kurir->id]) }}"
                                                class="text-sm text-blue-600 hover:underline">Edit</a>
                                        </td>
                                        <td class="px-6 py-4 text-end">
                                            <a href="javascript:void(0)" wire:click="deleteKurir({{ $kurir->id }})"
                                                onclick="confirm('Yakin ingin menghapus data kurir ini?') || event.stopImmediatePropagation()"
                                                class="text-sm text-red-600 hover:underline">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <span class="text-sm text-gray-500">Tidak ada data kurir ditemukan.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
                            <div class="flex gap-2">
                                <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                                <select wire:model.live='perPage'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="5">5</option>
                                    <option value="7">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                            <div>
                                {{ $kurirs->links() }}
                            </div>
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
