@php
    use App\Models\Category;
    $categories = Category::all();
@endphp

<div class='px-10 md:px-20 sm:px-30 py-3'>
    @foreach ($categories as $category)
        <!-- Menampilkan judul kategori -->
        @include('components.navigation.view-all', [
            'Category' => $category->name,
        ])

        <!-- Menampilkan produk berdasarkan kategori -->
        <livewire:product-listing :category_id="$category->id" :current_product_id="0" />
    @endforeach
</div>
