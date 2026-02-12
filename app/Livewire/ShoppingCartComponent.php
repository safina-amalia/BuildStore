<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartComponent extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $shippingCost = 0;
    public $total = 0;
    public $distance = 0;
    public $shippingRatePerKm = 5000;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = ShoppingCart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $this->calculateTotals();
    }

    public function updatedDistance()
    {
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->cartItems->sum(function ($item) {
            return $item->quantity * ($item->product->price ?? 0);
        });

        $this->shippingCost = $this->distance * $this->shippingRatePerKm;
        $this->total = $this->subtotal + $this->shippingCost;
    }

    public function updateQuantity($cartItemId, $quantity)
    {
        if ($quantity < 1) return;

        $cartItem = ShoppingCart::where('user_id', Auth::id())
            ->find($cartItemId);

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
            $this->loadCart();
        }
    }

    public function removeItem($cartItemId)
    {
        ShoppingCart::where('user_id', Auth::id())
            ->where('id', $cartItemId)
            ->delete();

        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.shopping-cart-component')->title('E-commerce | Shopping Cart');
    }
}
