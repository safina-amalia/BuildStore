<div>
    @if (session()->has('message'))
        <div class="p-3 mb-3 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <livewire:bread-crumb :url="url()->current()" />

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">Pesanan Saya</h2>
                                <p class="text-sm text-gray-600">Lihat dan kelola pesanan yang ditugaskan.</p>
                            </div>

                            <div class="inline-flex gap-x-2">
                                <div class="max-w-md space-y-3">
                                    <input type="search" wire:model.debounce.300ms="search"
                                        class="py-3 px-4 block w-full bg-gray-100 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Cari Customer...">
                                </div>
                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Kode Pesanan
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Customer</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Total Harga</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                                    <th class="px-6 py-3 text-right text-sm font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4">{{ $order->kode_pesanan }}</td>
                                        <td class="px-6 py-4">{{ $order->customer->name }}</td>
                                        <td class="px-6 py-4">Rp
                                            {{ number_format($order->detailPesanans->sum('subtotal'), 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 capitalize">{{ $order->status }}</td>
                                        <td class="px-6 py-4 text-right">
                                            @if ($order->status === 'sedang dikirim')
                                                <button wire:click="updateStatus({{ $order->id }})"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium bg-blue-600 text-white rounded hover:bg-blue-700">
                                                    Tandai Sudah Diterima
                                                </button>
                                            @else
                                                <span class="text-sm text-gray-500 italic">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada pesanan
                                            ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div class="px-6 py-4 flex justify-between items-center border-t border-gray-200">
                            <div class="flex gap-2 items-center">
                                <label class="text-sm font-medium text-gray-700">Per Page</label>
                                <select wire:model="perPage" class="text-sm border-gray-300 rounded px-2 py-1">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                </select>
                            </div>
                            <div>{{ $orders->links() }}</div>
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
