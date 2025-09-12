<?php

namespace App\Livewire\Dashboard;

use App\Models\Fair;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Overview extends Component
{
    public ?int $fair_id = null;

    public function mount()
    {
        $this->fair_id = Fair::where('is_current', true)->value('id');
    }

    public function render()
    {
        $fair = Fair::find($this->fair_id);

        $paidOrdersQuery = Order::query()
            ->where('fair_id', $this->fair_id)
            ->where('status', 'paid');

        $total = (float) $paidOrdersQuery->clone()->sum('total');
        $ordersCount = (int) $paidOrdersQuery->clone()->count();
        $avgTicket = $ordersCount ? $total / $ordersCount : 0.0;

        $cashTotal = (float) $paidOrdersQuery->clone()->where('payment_method', 'cash')->sum('total');
        $pixTotal = (float) $paidOrdersQuery->clone()->where('payment_method', 'pix')->sum('total');
        $cardTotal = (float) $paidOrdersQuery->clone()->where('payment_method', 'card')->sum('total');

        $openTabs = Order::where('fair_id', $this->fair_id)->where('status', 'open')->count();

        $itemsSold = (int) DB::table('order_items as oi')
            ->join('orders as o', 'o.id', '=', 'oi.order_id')
            ->where('o.fair_id', $this->fair_id)
            ->where('o.status', 'paid')
            ->sum('oi.quantity');

        $topProducts = DB::table('order_items as oi')
            ->join('fair_product as fp', 'fp.id', '=', 'oi.fair_product_id')
            ->join('products as p', 'p.id', '=', 'fp.product_id')
            ->join('orders as o', 'o.id', '=', 'oi.order_id')
            ->where('o.fair_id', $this->fair_id)
            ->where('o.status', 'paid')
            ->select('p.name', DB::raw('SUM(oi.quantity) as qty'), DB::raw('SUM(oi.subtotal) as total'))
            ->groupBy('p.name')
            ->orderByDesc('qty')
            ->limit(5)
            ->get();

        // Distribuição por hora (compatível com MySQL e SQLite)
        $driverName = DB::connection()->getDriverName();
        
        if ($driverName === 'mysql') {
            $hourExpression = "HOUR(created_at)";
        } else {
            $hourExpression = "strftime('%H', created_at)";
        }
        
        $byHour = DB::table('orders')
            ->select(
                DB::raw("{$hourExpression} as hour"), 
                DB::raw('COUNT(*) as count'), 
                DB::raw('SUM(total) as total')
            )
            ->where('fair_id', $this->fair_id)
            ->where('status', 'paid')
            ->groupBy(DB::raw($hourExpression))
            ->orderBy('hour')
            ->get();

        $recentOrders = Order::where('fair_id', $this->fair_id)
            ->where('status', 'paid')
            ->latest()
            ->limit(10)
            ->get();

        return view('livewire.dashboard.overview', compact(
            'fair', 'total', 'ordersCount', 'avgTicket', 'cashTotal', 'pixTotal', 'cardTotal', 'openTabs', 'itemsSold', 'topProducts', 'byHour', 'recentOrders'
        ));
    }
}
