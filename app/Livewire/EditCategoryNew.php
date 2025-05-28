<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Request;

class EditCategoryNew extends Component
{
    public $category_name;
    public $category_id;
    public $currentUrl;

    public function mount($id)
    {
        $this->category_id = $id;
        $category = Category::findOrFail($id);
        $this->category_name = $category->name;
        $this->currentUrl = Request::url();
    }

   public function updateCategory()
{
    $this->validate([
        'category_name' => 'required|string|max:255|unique:categories,name,' . $this->category_id,
    ], [
        'category_name.unique' => 'Nama kategori sudah digunakan.',
    ]);

    $category = Category::findOrFail($this->category_id);
    $category->name = $this->category_name;
    $category->save();

    session()->flash('message', 'Kategori berhasil diperbarui.');
    return $this->redirect('/manage/categories', navigate: true);
}
    public function render()
{
    // // Debug semua properti public instance ini
    // dd(array_keys(get_object_vars($this)));

    return view('livewire.edit-category', [
        'currentUrl' => url()->current(),
    ])->layout('admin-layout');
}
}
