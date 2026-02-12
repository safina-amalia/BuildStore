<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Carbon\Carbon;

class AdminDashboard extends Component
{
    public $totalHariIni;
    public $jumlahOrderHariIni;
    public $orderSelesaiHariIni;
    public $chartData = [];

    public function mount()
    {
        $today = Carbon::today();

        $ordersToday = Order::whereDate('created_at', $today)->get();

        $this->totalHariIni = $ordersToday->sum('total_price'); // Ganti sesuai kolom yang tersedia
        $this->jumlahOrderHariIni = $ordersToday->count();
        $this->orderSelesaiHariIni = $ordersToday->where('status', 'Selesai')->count();

        // Dummy data chart 7 hari terakhir
        $this->chartData = [
            ['date' => '2025-05-25', 'total' => 5],
            ['date' => '2025-05-26', 'total' => 7],
            ['date' => '2025-05-27', 'total' => 3],
            ['date' => '2025-05-28', 'total' => 6],
            ['date' => '2025-05-29', 'total' => 8],
            ['date' => '2025-05-30', 'total' => 4],
            ['date' => '2025-05-31', 'total' => 9],
        ];
    }

    public function render()
    {
        return view('livewire.admin-dashboard')->layout('admin-layout');
    }
}
