<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PembayaranForm extends Component
{
    public $receiver_name;
    public $phone_number;
    public $address;
    public $metodePembayaran = 'cod';
    public $keranjang = [];

    public function mount()
{
    $this->keranjang = session()->get('cart', []);
    $this->receiver_name = Auth::user()->name;
    $this->address = Auth::user()->address; // otomatis isi alamat dari profil
}


    public function hitungTotal()
    {
        $total = 0;
        foreach ($this->keranjang as $item) {
            $total += $item['qty'] * $item['price'];
        }
        return $total;
    }

    public function checkout()
    {
        if (empty($this->address)) {
            $this->addError('address', 'Alamat harus diisi');
            return;
        }

        if (empty($this->keranjang)) {
            session()->flash('error', 'Keranjang kamu kosong.');
            return;
        }

        $total = $this->hitungTotal();
        $orderCode = 'ORD-' . strtoupper(Str::random(10));

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => $orderCode,
            'receiver_name' => $this->receiver_name,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'payment_method' => $this->metodePembayaran,
            'status' => 'pending',
            'total' => $total,
        ]);

        foreach ($this->keranjang as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        if ($this->metodePembayaran === 'midtrans') {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderCode,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];

            $snapUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            $this->dispatchBrowserEvent('redirect-to-midtrans', ['url' => $snapUrl]);
            return;
        }

        session()->flash('success', 'Pesanan berhasil dibuat!');
        return redirect()->route('user.orders');
    }

    public function render()
    {
        return view('livewire.pembayaran-form');
    }
}
