<div class="w-full flex justify-center mt-28">
    <div class="w-full max-w-md space-y-6 px-4">

        {{-- Informasi Penerima --}}
        <div class="border p-4 rounded shadow bg-white">
            <h2 class="font-semibold text-lg mb-2">Informasi Penerima</h2>
            <div class="mb-2">
                <label class="block font-medium">Nama Penerima</label>
                <input type="text" class="w-full border rounded p-2 bg-gray-100" wire:model.defer="receiver_name" readonly>
            </div>
            <div>
                <label class="block font-medium">Nomor Telepon</label>
                <input type="text" class="w-full border rounded p-2" wire:model.defer="phone_number">
            </div>
        </div>

        {{-- Alamat Pengiriman --}}
        <div class="border p-4 rounded shadow bg-white">
            <h2 class="font-semibold text-lg mb-2">Alamat Pengiriman</h2>
            <textarea class="w-full border rounded p-2" wire:model.defer="address" rows="4"></textarea>
            @error('address') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Metode Pembayaran --}}
        <div class="border p-4 rounded shadow bg-white">
            <h2 class="font-semibold text-lg mb-2">Metode Pembayaran</h2>
            <select wire:model="metodePembayaran" class="w-full border rounded p-2">
                <option value="cod">Bayar di Tempat (COD)</option>
                <option value="transfer">Transfer Bank</option>
                <option value="midtrans">Bayar Online (Midtrans)</option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="pt-4 text-center">
            @if ($metodePembayaran === 'midtrans')
                <p class="text-sm text-gray-500 mb-2">
                    Setelah klik "Buat Pesanan", kamu akan diarahkan ke halaman pembayaran Midtrans.
                </p>
            @endif

            <button wire:click="checkout"
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Buat Pesanan
            </button>

        </div>

        {{-- JS --}}
        <script>
    window.addEventListener('redirect-to-midtrans', event => {
        alert("Pesanan berhasil dibuat! Kamu akan diarahkan ke Midtrans.");
        window.location.href = event.detail.url;
    });

    window.addEventListener('order-success', event => {
        alert("Pesanan berhasil dibuat!");
    });
</script>


    window.addEventListener('order-success', event => {
        alert("Pesanan berhasil dibuat!");
    });
</script>


    </div>
</div>
