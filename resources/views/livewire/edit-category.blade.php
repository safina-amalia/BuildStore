<div>
    <livewire:bread-crumb :url="$currentUrl" />

    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="bg-slate-100 rounded-xl shadow p-4 sm:p-7">
            <form wire:submit.prevent="updateCategory"> <!-- Trigger the Livewire action -->
                <div
                    class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Edit Category
                        </h2>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="edit-category-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Category Name
                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <div>
                            <input type="text" wire:model="category_name" id="edit-category-name"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 rounded-lg">
                            @error('category_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <div wire:loading
                        class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white-600 rounded-full"
                        role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Update Category
                </button>
            </form>
        </div>
    </div>
</div>
