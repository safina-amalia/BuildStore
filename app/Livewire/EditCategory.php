<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class EditCategory extends Component
{
    public $name;
    public $currentUrl;

    public function mount($id)
    {
        $this->category_id = $id;
        $category = Category::findOrFail($id);
        $this->name = $category->name;

        $this->currentUrl = 'manage/categories/edit/' . $id;
    }
    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($this->category_id);
        $category->name = $this->name;
        $category->save();

        // session()->flash('message', 'Category updated successfully!');
        // return redirect()->route('kategori.index');
        return $this->redirect('/manage/categories', navigate: true);
    }

    public function render()
    {
       return view('livewire.edit-category')->layout('admin-layout');
    }
}
