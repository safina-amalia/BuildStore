<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Daftar Pesanan Kamu</h2>

    @forelse ($orders as $order)
        <div class="border p-4 mb-4 rounded shadow">
            <div><strong>Kode Pesanan:</strong> {{ $order->order_code }}</div>
            <div><strong>Total:</strong> Rp{{ number_format($order->total) }}</div>
            <div><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
            <div><strong>Metode:</strong> {{ strtoupper($order->payment_method) }}</div>
        </div>
    @empty
        <p>Kamu belum memiliki pesanan.</p>
    @endforelse
</div>
