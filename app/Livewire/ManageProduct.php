<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;


class ManageProduct extends Component
{
    public function render()
    {

        return view('livewire.manage-product')
        ->layout('admin-layout');
    }
}
