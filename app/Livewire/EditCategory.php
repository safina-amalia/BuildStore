<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class EditCategory extends Component
{
    public $name;         // Public property for category name
    public $category_id;  // Public property for category ID
    public $currentUrl;   // Public property for current URL

    public function mount($id)
    {
        $this->category_id = $id;  // Set category ID from the route or parameter
        $category = Category::findOrFail($id);  // Retrieve the category
        $this->name = $category->name;  // Populate the name property
        $this->currentUrl = 'manage/categories/edit/' . $id;  // Set the current URL
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($this->category_id);
        $category->name = $this->name;
        $category->save();

        session()->flash('message', 'Category updated successfully!');
        return $this->redirect('/manage/categories', navigate: true);
    }

    public function render()
    {
           $current_url = url()->current();

        $explode_url = explode('/',$current_url);
        // dd($explode_url);
        $this->currentUrl = $explode_url[3].' '.$explode_url[5];
        return view('livewire.edit-category')->layout('admin-layout');
    }
}
