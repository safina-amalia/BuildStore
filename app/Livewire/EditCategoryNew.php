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

<<<<<<< HEAD
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
=======
    public function updateCategory()
    {
        $this->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($this->category_id);
        $category->name = $this->category_name;
        $category->save();

        session()->flash('message', 'Kategori berhasil diperbarui.');
        return $this->redirect('/manage/categories', navigate: true);
    }

>>>>>>> 423fe2a09e74310352221c0c481cb2111a1b057f
    public function render()
{
    // // Debug semua properti public instance ini
    // dd(array_keys(get_object_vars($this)));

    return view('livewire.edit-category', [
        'currentUrl' => url()->current(),
    ])->layout('admin-layout');
}
}
