<?php

namespace App\Livewire\Cashier;

use App\Models\Fair;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Closing extends Component
{
    public ?int $fair_id = null;

    #[Layout('components.layouts.app')]
    public function mount()
    {
        $this->fair_id = Fair::where('is_current', true)->value('id');
    }

    public function render()
    {
        $fair = Fair::find($this->fair_id);

        $totals = Order::query()
            ->where('fair_id', $this->fair_id)
            ->where('status', 'paid')
            ->select('payment_method', DB::raw('COUNT(*) as count'), DB::raw('SUM(total) as total'))
            ->groupBy('payment_method')
            ->get();

        $byProduct = DB::table('order_items as oi')
            ->join('fair_product as fp', 'fp.id', '=', 'oi.fair_product_id')
            ->join('products as p', 'p.id', '=', 'fp.product_id')
            ->join('orders as o', 'o.id', '=', 'oi.order_id')
            ->where('o.fair_id', $this->fair_id)
            ->where('o.status', 'paid')
            ->select('p.name', DB::raw('SUM(oi.quantity) as qty'), DB::raw('SUM(oi.subtotal) as total'))
            ->groupBy('p.name')
            ->orderBy('p.name')
            ->get();

        $grandTotal = $totals->sum('total');

        return view('livewire.cashier.closing', compact('fair', 'totals', 'byProduct', 'grandTotal'));
    }
}
