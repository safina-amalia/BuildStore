<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class UserDashboard extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::latest()->paginate(12); // sesuaikan dengan kebutuhan kamu

        return view('livewire.user-dashboard', compact('products'));
    }
}

