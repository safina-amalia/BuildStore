<div class="max-w-5xl mx-auto py-10 px-4">
    @if (session()->has('message'))
        <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-4">Detail Pesanan - {{ $order->kode }}</h2>

    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div>
            <h3 class="font-semibold text-gray-700 mb-2">Customer</h3>
            <p><strong>Nama:</strong> {{ $order->customer->nama }}</p>
            <p><strong>No. Telp:</strong> {{ $order->customer->no_tlp }}</p>
        </div>
        <div>
            <h3 class="font-semibold text-gray-700 mb-2">Status</h3>
            <p class="mb-2">Status saat ini: <span class="font-semibold">{{ ucfirst($order->status) }}</span></p>
            <label for="kurir_id" class="block text-sm font-medium mb-1">Pilih Kurir</label>
            <select wire:model="kurir_id"
                class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="">-- Pilih Kurir --</option>
                @foreach ($kurirs as $kurir)
                    <option value="{{ $kurir->id }}">{{ $kurir->nama }}</option>
                @endforeach
            </select>
            <button wire:click="kirimPesanan"
                class="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                Kirim Pesanan
            </button>
        </div>
    </div>

    <h3 class="text-lg font-semibold mb-3">Produk Dipesan</h3>
    <table class="w-full border border-gray-200 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Produk</th>
                <th class="p-2 text-left">Harga</th>
                <th class="p-2 text-left">Qty</th>
                <th class="p-2 text-left">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->detailPesanan as $item)
                <tr class="border-t">
                    <td class="p-2">{{ $item->produk->nama }}</td>
                    <td class="p-2">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="p-2">{{ $item->jumlah }}</td>
                    <td class="p-2">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
