<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $receiver_name;
    public $phone_number;
    public $address;
    public $metodePembayaran = 'cod';

    protected $rules = [
        'receiver_name' => 'required',
        'phone_number' => 'required',
        'address' => 'required',
        'metodePembayaran' => 'required',
    ];

    public function mount()
    {
        if (!Auth::check()) {
            abort(403, 'Kamu harus login.');
        }

        $this->receiver_name = Auth::user()->name;
    }

    public function checkout()
    {
        if (!Auth::check()) {
            $this->addError('auth', 'Harus login terlebih dahulu.');
            return;
        }

        $this->validate();

        $order = Order::create([
            'user_id' => Auth::id(),
            'receiver_name' => $this->receiver_name,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'payment_method' => $this->metodePembayaran,
            'status' => 'pending',
            'subtotal' => 10000,
            'order_code' => 'ORDER-' . Str::random(10),
        ]);

        if ($this->metodePembayaran === 'midtrans') {
            $serverKey = config('services.midtrans.server_key');

            $response = Http::withBasicAuth($serverKey, '')
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
                    "transaction_details" => [
                        "order_id" => $order->order_code,
                        "gross_amount" => $order->subtotal
                    ],
                    "customer_details" => [
                        "first_name" => $this->receiver_name,
                        "email" => Auth::user()->email ?? 'guest@example.com',
                        "phone" => $this->phone_number,
                    ]
                ]);

            $snap = $response->json();

            if (isset($snap['redirect_url'])) {
                $this->dispatchBrowserEvent('redirect-to-midtrans', ['url' => $snap['redirect_url']]);
            } else {
                $this->addError('midtrans', 'Gagal mendapatkan URL Midtrans.');
            }
        } else {
            $this->dispatchBrowserEvent('order-success');
        }
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
