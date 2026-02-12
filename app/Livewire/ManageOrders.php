<?php

namespace App\Livewire;

use App\Models\Pesanan;
use Livewire\Component;
use Livewire\WithPagination;

class ManageOrders extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $statusFilter = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $currentUrl;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function setSortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'ASC';
        }
        $this->resetPage();
    }

    public function updateStatus($id, $status)
    {
        $order = Pesanan::find($id);
        if ($order) {
            $order->status = $status;
            $order->save();
            session()->flash('message', 'Status updated successfully.');
        }
    }

    public function render()
    {
        // Ambil bagian URL saat ini dan olah jika ingin digunakan di breadcrumb atau view
        $current_url = url()->current();
        $explode_url = explode('/', $current_url);
        $this->currentUrl = $explode_url[3] . ' ' . ($explode_url[4] ?? '');

        $query = Pesanan::with('customer')
            ->when($this->search, function ($q) {
                $q->where('kode', 'like', '%' . $this->search . '%')
                  ->orWhereHas('customer', function ($q) {
                      $q->where('nama', 'like', '%' . $this->search . '%');
                  });
            })
            ->when($this->statusFilter, function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortBy, $this->sortDir);

        $orders = $query->paginate($this->perPage);

        return view('livewire.manage-orders', [
            'orders' => $orders,
            'currentUrl' => $this->currentUrl,
        ])->layout('admin-layout');
    }
}
