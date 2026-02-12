<div>
    @if (session()->has('message'))
        <div class="p-3 mb-3 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <livewire:bread-crumb :url="$currentUrl" />

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">Orders</h2>
                                <p class="text-sm text-gray-600">Manage and track customer orders.</p>
                            </div>

                            <div class="inline-flex gap-x-2 items-center">
                                <div class="max-w-md space-y-3">
                                    <input type="search" wire:model.live.debounce.300="search"
                                        class="peer py-3 px-4 block w-full bg-gray-100 border-blue-500 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                        placeholder="Search orders...">
                                </div>

                                {{-- Optional: Status filter dropdown --}}
                                <div class="flex gap-2 items-center max-w-xs">
                                    <label for="statusFilter" class="w-32 text-sm font-medium text-gray-900"></label>
                                    <select id="statusFilter" wire:model.live="statusFilter"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                        focus:ring-blue-500 focus:border-blue-500 block w-full max-w-[100px] p-2.5">
                                        <option value="">All Statuses</option>
                                        <option value="pending">Pending</option>
                                        <option value="dikonfirmasi">Dikonfirmasi</option>
                                        <option value="ditolak">Ditolak</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 px-5">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-sm font-medium text-gray-500 uppercase">
                                        Kode
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-sm font-medium text-gray-500 uppercase">
                                        Customer
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-sm font-medium text-gray-500 uppercase">
                                        Total
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-sm font-medium text-gray-500 uppercase">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-end"></th>
                                    <th scope="col" class="px-6 py-3 text-end"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($orders as $order)
                                    <tr wire:key="order-{{ $order->id }}">
                                        <td class="px-6 py-3">
                                            <span class="text-sm font-semibold text-gray-800">
                                                {{ $order->kode }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3">
                                            <span class="text-sm text-gray-700">
                                                {{ $order->customer->nama ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3">
                                            <span class="text-sm text-gray-800 font-medium">
                                                Rp{{ number_format($order->detailPesanan->sum('subtotal'), 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3">
                                            <select wire:change="updateStatus({{ $order->id }}, $event.target.value)"
                                                class="border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="pending"
                                                    {{ $order->status === 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="dikonfirmasi"
                                                    {{ $order->status === 'dikonfirmasi' ? 'selected' : '' }}>
                                                    Dikonfirmasi</option>
                                                <option value="ditolak"
                                                    {{ $order->status === 'ditolak' ? 'selected' : '' }}>Ditolak
                                                </option>
                                                <option value="selesai"
                                                    {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai
                                                </option>
                                            </select>
                                        </td>
                                        <td class="px-6 py-3 text-end">
                                            <a href="{{ route('admin.orders.detail', ['id' => $order->id]) }}"
                                                class="inline-flex items-center gap-x-1 text-sm text-blue-600 hover:underline font-medium">
                                                Detail
                                            </a>
                                        </td>
                                        <td class="px-6 py-3 text-end">
                                            @if ($order->status === 'pending')
                                                <div class="flex gap-x-2 justify-end">
                                                    <button
                                                        wire:click="updateStatus({{ $order->id }}, 'dikonfirmasi')"
                                                        class="px-3 py-1.5 bg-green-500 text-white text-xs rounded hover:bg-green-600">
                                                        Konfirmasi
                                                    </button>
                                                    <button wire:click="updateStatus({{ $order->id }}, 'ditolak')"
                                                        class="px-3 py-1.5 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                                                        Tolak
                                                    </button>
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-3 text-center">
                                            <span class="py-1 px-2 text-sm bg-yellow-100 text-yellow-800 rounded-full">
                                                Tidak ada pesanan ditemukan.
                                            </span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
                            <div class="flex gap-2 items-center">
                                <label class="w-32 text-sm font-medium text-gray-900" for="perPage">Per Page</label>
                                <select id="perPage" wire:model.live="perPage"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full max-w-[100px] p-2.5">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
</div>
