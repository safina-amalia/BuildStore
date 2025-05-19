<div>
    @if (Request::is('all/products') || Request::is('livewire/update'))
        @include('components.search-component')
    @endif
    <div class="grid grid-cols-2 lg:grid-cols-4 sm:grid-cols-2 md:grid-cols-3 gap-3">
        @if (count($products)> 0)
            @foreach ($products as $product)
                <livewire:item-card lazy :product_details="$product" wire:key="{{$product->id}}"/>

            @endforeach
        @else
            <h2 class="text-2xl text-gray-300">No Product Available</h2>
        @endif
        
    </div>
</div>