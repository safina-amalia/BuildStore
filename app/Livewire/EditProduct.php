<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class EditProduct extends Component
{
    use WithFileUploads;

    public $product_name = '';
    public $photo; // Bisa string (path lama) atau temporaryUploadedFile
    public $product_description = '';
    public $product_price = '';
    public $product_stock = '';
    public $category_id;
    public $all_categories;
    public $product_details;

    public function mount($id)
    {
        $this->product_details = Product::findOrFail($id);

        $this->product_name = $this->product_details->name;
        $this->product_description = $this->product_details->description;
        $this->product_price = $this->product_details->price;
        $this->product_stock = $this->product_details->stock;
        $this->category_id = $this->product_details->category_id;
        $this->photo = $this->product_details->image; // string path

        $this->all_categories = Category::all();
    }

    public function update()
    {
        // Validation rules dengan pengecualian unik untuk produk yang sedang diedit
        $validatedData = $this->validate([
            'product_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($this->product_details->id),
            ],
            'product_description' => 'required|string',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|max:1024',
    ], [
        'product_name.unique' => 'Nama produk sudah digunakan.',
        ]);

        // Handle photo upload if new file uploaded
        if ($this->photo && !is_string($this->photo)) {
            // New photo uploaded, simpan ke storage
            $photoPath = $this->photo->store('photos', 'public');

            // Hapus foto lama jika ada dan berbeda
            if ($this->product_details->image && \Storage::disk('public')->exists($this->product_details->image)) {
                \Storage::disk('public')->delete($this->product_details->image);
            }
        } else {
            // Tidak upload baru, pakai yang lama
            $photoPath = $this->product_details->image;
        }

        // Update product
        $this->product_details->update([
            'name' => $this->product_name,
            'description' => $this->product_description,
            'price' => $this->product_price,
            'stock' => $this->product_stock,
            'category_id' => $this->category_id,
            'image' => $photoPath,
        ]);

        // Redirect ke halaman products setelah update sukses
        return redirect()->to('/products');
    }

    public function render()
    {
        return view('livewire.edit-product')->layout('admin-layout');
    }
}
