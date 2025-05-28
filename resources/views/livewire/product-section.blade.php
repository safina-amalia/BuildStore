{{-- <div class='px-10 md:px-20 sm:px-30 py-3'>
         <!-- Brand New  -->
        @include('components.navigation.view-all',[
            'Category' => 'SEMEN'
        ])
        <livewire:product-listing :category_id="1" :current_product_id="0"/>

        <!-- Smartphones & laptops  -->
        @include('components.navigation.view-all',[
            'Category' => 'BATU'
        ])
        <livewire:product-listing :category_id="2" :current_product_id="0"/>

        <!-- Outfits  -->
        @include('components.navigation.view-all',[
            'Category' => 'PASIR'
        ])
        <livewire:product-listing :category_id="3" :current_product_id="0"/>

    </div> --}}
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
