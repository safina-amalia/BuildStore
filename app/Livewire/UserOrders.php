<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserOrders extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::where('user_id', Auth::id())->latest()->get();
    }

    public function render()
    {
        return view('livewire.user-orders');
    }
}
