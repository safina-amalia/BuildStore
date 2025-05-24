<?php

// namespace App\Livewire;

// use Livewire\Component;
// use App\Models\Product;


// class ManageProduct extends Component
// {
//     public function deleteProduct($id)
//     {
//         $product = Product::findOrFail($id);
//         $product->delete();

//         // Reset ke halaman pertama setelah delete
//         $this->resetPage();

//         // session()->flash('message', 'Product deleted successfully.');
//     }


//     public function render()
//     {

//         return view('livewire.manage-product')
//         ->layout('admin-layout');
//     }
// }

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ManageProduct extends Component
{
    use WithPagination;

    // Properti untuk search dan pagination
    public $search = '';
    public $perPage = 10;

    // Agar Livewire tahu bahwa query string berubah, reset halaman saat search/perPage berubah
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    // Fungsi untuk menghapus product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        $this->resetPage();
        session()->flash('message', 'Product deleted successfully.');
    }

    // public function render()
    // {
    //     // Query data product dengan search dan pagination
    //     $products = Product::where('name', 'like', '%' . $this->search . '%')
    //         ->orWhere('description', 'like', '%' . $this->search . '%')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate($this->perPage);

    //     return view('livewire.manage-product', [
    //         'products' => $products,
    //     ])->layout('admin-layout');

    public function render()
    {

        return view('livewire.manage-product')
        ->layout('admin-layout');
    }
}
