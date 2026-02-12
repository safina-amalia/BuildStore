<?php

namespace App\Livewire;

use App\Models\Kurir;
use Livewire\Component;
use Livewire\WithPagination;

class ManageKurir extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $search = '';
    public $currentUrl;

    public function setSortBy($sortColumn)
    {
        if ($this->sortBy === $sortColumn) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $sortColumn;
            $this->sortDir = 'ASC';
        }
    }

    public function deleteKurir($id)
    {
        $kurir = Kurir::findOrFail($id);
        $kurir->delete();

        $this->resetPage();
        session()->flash('message', 'Kurir berhasil dihapus.');
    }

    public function render()
    {
        // Ambil bagian URL saat ini
        $current_url = url()->current();
        $explode_url = explode('/', $current_url);
        $this->currentUrl = $explode_url[3] . ' ' . ($explode_url[4] ?? '');

        // Query dengan search
        $kurirs = Kurir::query()
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('no_tlp', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.manage-kurir', [
            'kurirs' => $kurirs,
        ])->layout('admin-layout');
    }
}
