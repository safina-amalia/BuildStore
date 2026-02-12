<?php

namespace App\Livewire;

use App\Models\Pesanan;
use App\Models\Kurir;
use Livewire\Component;

class ShowOrderDetail extends Component
{
    public $orderId;
    public $order;
    public $kurir_id;

    public function mount($id)
    {
        $this->orderId = $id;
        $this->order = Pesanan::with(['customer', 'detailPesanan.produk', 'kurir'])->findOrFail($id);
        $this->kurir_id = $this->order->kurir_id;
    }

    public function kirimPesanan()
    {
        $this->validate([
            'kurir_id' => 'required|exists:kurirs,id',
        ]);

        $this->order->kurir_id = $this->kurir_id;
        $this->order->status = 'dikirim';
        $this->order->save();

        session()->flash('message', 'Pesanan berhasil dikirim.');
    }

    public function render()
    {
        $kurirs = Kurir::all();
        return view('livewire.show-order-detail', [
            'kurirs' => $kurirs,
        ]);
    }
}
