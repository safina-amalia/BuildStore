<div>
    <livewire:bread-crumb :url="$currentUrl" />
    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="bg-slate-100 rounded-xl shadow p-4 sm:p-7">
            <form wire:submit.prevent="save">
                <!-- Section -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 border-t border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Tambah Kurir Baru
                        </h2>
                    </div>

                    @foreach ([['label' => 'Nama Kurir', 'model' => 'nama', 'type' => 'text'], ['label' => 'Email', 'model' => 'email', 'type' => 'email'], ['label' => 'No Telepon', 'model' => 'no_tlp', 'type' => 'text'], ['label' => 'Password', 'model' => 'password', 'type' => 'password']] as $field)
                        <div class="sm:col-span-3">
                            <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                {{ $field['label'] }}
                            </label>
                        </div>
                        <div class="sm:col-span-9">
                            <input type="{{ $field['type'] }}" wire:model.defer="{{ $field['model'] }}"
                                class="py-2 px-3 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500"
                                placeholder="{{ $field['label'] }}">

                            @error($field['model'])
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>
                <!-- End Section -->

                <button type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none">
                    <div wire:loading
                        class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white-600 rounded-full"
                        role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Submit and Save
                </button>
            </form>
        </div>
    </div>
</div>
