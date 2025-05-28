<div>
    <livewire:bread-crumb :url="$currentUrl" />

    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="bg-slate-100 rounded-xl shadow p-4 sm:p-7">

            <form wire:submit.prevent="save">
                <!-- Section -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 border-t border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800">Add New Product</h2>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">Product Name</label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="text" wire:model="product_name"
                            class="py-2 px-3 block w-full border-gray-200 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('product_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">Price</label>
                    </div>
                    <div class="sm:col-span-9">
                        <input type="text" wire:model="product_price"
                            class="py-2 px-3 block w-full border-gray-200 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
                            inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*">
                        @error('product_price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Stock
                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <input type="number" wire:model="product_stock"
                            class="py-2 px-3 block w-full shadow-sm text-sm rounded-lg
                                    focus:border-blue-500 focus:ring-blue-500
                                    disabled:opacity-50 disabled:pointer-events-none">
                        @error('product_stock')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Stock -->

                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">Stock</label>
                    </div>
<<<<<<< HEAD
                    <div class="sm:col-span-9">
                        <input type="number" wire:model="product_stock"
                            class="py-2 px-3 block w-full border-gray-200 rounded-lg shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('product_stock')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

=======
                    <!-- End Col -->
                    <div class="sm:col-span-9">
                        <select wire:model="category_id"
                            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                            <option selected="">Select Product Category</option>
                            @foreach ($all_categories as $category)
                                <option value="{{ $category->id }}" wire:key="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                        @error('category_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Col -->

                </div>
                <!-- End Section -->

                <!-- Section -->
                <div
                    class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800">
                            More Details
                        </h2>
                    </div>
                    <!-- End Col -->
>>>>>>> 423fe2a09e74310352221c0c481cb2111a1b057f
                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">Category</label>
                    </div>
                    <div class="sm:col-span-9">
                        <select wire:model="category_id"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Product Category</option>
                            @foreach ($all_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Image & Description -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 border-t border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800">More Details</h2>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">Product Image</label>
                    </div>
                    <div class="sm:col-span-9">
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="rounded-lg mb-2" width="300"
                                height="300">
                        @else
                            <img src="{{ asset('images/placeholder-image.jpg') }}" class="rounded-lg mb-2"
                                width="300" height="300">
                        @endif

                        <input type="file" wire:model="photo"
                            class="block w-full border-gray-200 rounded-lg text-sm file:bg-gray-100 file:py-2 file:px-4 file:border-0 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('photo')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div x-show="uploading" class="mt-2">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" :style="`width: ${progress}%`"></div>
                                </div>
                                <div class="text-sm text-gray-700 mt-1" x-text="`${progress}%`"></div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">Product Description</label>
                    </div>
                    <div class="sm:col-span-9">
                        <textarea wire:model="product_description"
                            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500"
                            rows="6" placeholder="Add a product description here!"></textarea>
                        @error('product_description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div wire:loading wire:target="save"
                        class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                        role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Submit and Save
                </button>
            </form>
        </div>
    </div>
</div>
