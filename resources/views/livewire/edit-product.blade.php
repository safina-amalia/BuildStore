<div>
    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="bg-slate-100 rounded-xl shadow p-4 sm:p-7">
            <form wire:submit.prevent="update"> {{-- pakai prevent supaya submit via Livewire --}}
                <!-- Section: Product Details -->
                <div
                    class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Edit Product Details
                        </h2>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="product_name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Product name
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="text" wire:model.defer="product_name" id="product_name"
                            class="py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
                            autocomplete="off">
                        @error('product_name')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="product_price" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Price
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="text" wire:model.defer="product_price" id="product_price" inputmode="decimal"
                            pattern="[0-9]*[.,]?[0-9]*"
                            class="py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('product_price')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="product_stock" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Stock
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="text" wire:model.defer="product_stock" id="product_stock" inputmode="decimal"
                            pattern="[0-9]*[.,]?[0-9]*"
                            class="py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('product_stock')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="category_id" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Category
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <select wire:model.defer="category_id" id="category_id"
                            class="py-3 px-4 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Product Category</option>
                            @foreach ($all_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Section: More Details -->
                <div
                    class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800">
                            More Details
                        </h2>
                    </div>

                    <div class="sm:col-span-3"></div>
                    <div class="sm:col-span-9 mb-4">
                        @if ($photo && is_string($photo))
                            <img src="{{ Storage::url($photo) }}" alt="Product image"
                                class="rounded-lg max-h-72 object-contain">
                        @elseif ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" alt="Product image"
                                class="rounded-lg max-h-72 object-contain">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" alt="default image"
                                class="rounded-lg max-h-72 object-contain">
                        @endif
                    </div>

                    <div class="sm:col-span-3">
                        <label for="photo" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Product Image
                        </label>
                    </div>
                    <div class="sm:col-span-9" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <input type="file" wire:model="photo" id="photo"
                            class="block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500 file:bg-gray-50 file:border-0 file:bg-gray-100 file:py-2 file:px-4"
                            accept="image/*">
                        @error('photo')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror

                        <!-- Progress bar -->
                        <div x-show="uploading" class="mt-2">
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-blue-600 h-2" :style="`width: ${progress}%`"></div>
                            </div>
                            <div class="text-right text-xs text-gray-700 mt-1" x-text="progress + '%'"></div>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="product_description" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Product description
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <textarea id="product_description" wire:model.defer="product_description"
                            class="py-2 px-3 block w-full border border-gray-300 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
                            rows="6" placeholder="Add a product description here!"></textarea>
                        @error('product_description')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                    wire:loading.attr="disabled">
                    <div wire:loading
                        class="animate-spin inline-block w-4 h-4 border-3 border-current border-t-transparent rounded-full"
                        role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Submit and Save
                </button>
            </form>
        </div>
    </div>
</div>
