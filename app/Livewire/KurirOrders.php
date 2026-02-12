<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pesanan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class KurirOrders extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortBy === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortBy = $field;
    }

    public function updateStatus($orderId)
    {
        $order = Pesanan::where('kurir_id', Auth::id())->findOrFail($orderId);

        if ($order->status === 'sedang dikirim') {
            $order->status = 'sudah diterima';
            $order->save();

            session()->flash('message', 'Status pesanan diperbarui menjadi Sudah Diterima.');
        }
    }

    public function render()
    {
        $current_url = url()->current();
        $explode_url = explode('/', $current_url);
        $this->currentUrl = $explode_url[3] . ' ' . ($explode_url[4] ?? '');

        $orders = Pesanan::with(['customer', 'detailPesanan']) // gunakan relasi yang benar
            ->where('kurir_id', Auth::id())
            ->whereHas('customer', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.kurir-orders', [
            'orders' => $orders,
            'currentUrl' => $this->currentUrl,
        ])->layout('kurir-layout');
    }
}
