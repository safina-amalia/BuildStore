<section>
    <div class="mx-auto max-w-3xl">
        <header class="text-center flex gap-3">
            <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Your Cart</h1>
            <div wire:loading
                class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-white-600 rounded-full"
                role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
        </header>

        <div class="mt-8">
            <ul class="space-y-4">
                @foreach ($cartItems as $item)
                    <li class="flex items-center gap-4">
                        <img src="{{ Storage::url($item->product->image) }}" alt=""
                            class="size-16 rounded object-cover" />

                        <div>
                            <h3 class="text-sm text-gray-900">{{ $item->product->name }}</h3>
                            <dl class="mt-0.5 space-y-px text-xs text-gray-700">
                                <div>Rp{{ number_format($item->product->price ?? 0, 0, ',', '.') }}</div>
                            </dl>
                        </div>

                        <div class="flex flex-1 items-center justify-end gap-2">
                            <form>
                                <label for="Line{{ $item->id }}Qty" class="sr-only"> Quantity </label>
                                <input type="number" min="1" value="{{ $item->quantity }}"
                                    id="Line{{ $item->id }}Qty"
                                    wire:change="updateQuantity({{ $item->id }}, $event.target.value)"
                                    class="h-8 w-12 rounded border-gray-200 bg-gray-50 p-0 text-center text-xs text-gray-600 focus:outline-none" />
                            </form>

                            <button wire:click="removeItem({{ $item->id }})"
                                class="text-gray-600 transition hover:text-red-600">
                                <span class="sr-only">Remove item</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21..." />
                                </svg>
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>

            {{-- Input Jarak --}}
            <div class="mt-8 flex items-center justify-end gap-4">
                <label class="text-sm text-gray-700">Jarak Pengiriman (km):</label>
                <input type="number" wire:model="distance" class="w-20 border rounded px-2 py-1 text-sm"
                    min="0" />
            </div>

            <div class="mt-8 flex justify-end border-t border-gray-100 pt-8">
                <div class="w-screen max-w-lg space-y-4">
                    <dl class="space-y-0.5 text-sm text-gray-700">
                        <div class="flex justify-between">
                            <dt>Subtotal</dt>
                            <dd>Rp{{ number_format($subtotal, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Ongkir ({{ $distance }} km)</dt>
                            <dd>Rp{{ number_format($shippingCost, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex justify-between !text-base font-medium">
                            <dt>Total</dt>
                            <dd>Rp{{ number_format($total, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    <div class="flex justify-end gap-2">
                        <a wire:navigate
                            class="block rounded bg-blue-700 px-5 py-3 text-sm text-gray-100 transition hover:bg-blue-600"
                            href="/">Continue Shopping</a>
                        <a href="#"
                            class="flex gap-3 items-center rounded bg-gray-700 px-5 py-3 text-sm text-gray-100 transition hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="..." />
                            </svg>
                            Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
