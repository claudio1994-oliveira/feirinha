<?php

namespace App\Livewire\Cashier;

use App\Mail\OrderReceipt;
use App\Models\Customer;
use App\Models\Fair;
use App\Models\FairProduct;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PointOfSale extends Component
{
    public ?int $customer_id = null;
    public array $cart = []; // [['fair_product_id'=>, 'name'=>, 'qty'=>, 'price'=>, 'subtotal'=>]]

    #[Validate('required|in:cash,pix,card')]
    public ?string $payment_method = null;

    public ?int $fair_id = null;

    #[Layout('components.layouts.app')]
    public function mount()
    {
        $fair = Fair::where('is_current', true)->first();
        $this->fair_id = $fair?->id;
    }

    public function addToCart(int $fairProductId)
    {
        $fp = FairProduct::with('product')->findOrFail($fairProductId);
        if ($fp->sold_out) {
            $this->dispatch('notify', message: 'Produto esgotado e removido do carrinho.');
            return;
        }
        if (!is_null($fp->quantity) && $fp->sold >= $fp->quantity) {
            $this->dispatch('notify', message: 'Produto esgotado e removido do carrinho.');
            return;
        }

        $key = collect($this->cart)->search(fn($i) => $i['fair_product_id'] === $fp->id);
        if ($key === false) {
            $this->cart[] = [
                'fair_product_id' => $fp->id,
                'name' => $fp->product->name,
                'qty' => 1,
                'price' => (float) $fp->price,
                'subtotal' => (float) $fp->price,
            ];
        } else {
            $this->cart[$key]['qty'] += 1;
            $this->cart[$key]['subtotal'] = $this->cart[$key]['qty'] * $this->cart[$key]['price'];
        }
    }

    public function removeFromCart(int $index)
    {
        array_splice($this->cart, $index, 1);
    }

    public function updateQty(int $index, int $qty)
    {
        if ($qty < 1) $qty = 1;
        $this->cart[$index]['qty'] = $qty;
        $this->cart[$index]['subtotal'] = $qty * $this->cart[$index]['price'];
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->sum('subtotal');
    }

    public function checkout(bool $openTab = false)
    {
        if (!$this->fair_id) {
            $this->dispatch('notify', message: 'Nenhuma feirinha atual definida.');
            return;
        }
        if (!$openTab) {
            $this->validate();
        }

        $order = Order::create([
            'fair_id' => $this->fair_id,
            'customer_id' => $openTab ? $this->customer_id : null,
            'status' => $openTab ? 'open' : 'paid',
            'payment_method' => $openTab ? null : $this->payment_method,
            'total' => $this->total,
        ]);

        foreach ($this->cart as $item) {
            $fp = FairProduct::find($item['fair_product_id']);
            // Verificar estoque
            if ($fp->sold_out || (!is_null($fp->quantity) && $fp->sold + $item['qty'] > $fp->quantity)) {
                // remove item do carrinho
                continue;
            }
            OrderItem::create([
                'order_id' => $order->id,
                'fair_product_id' => $item['fair_product_id'],
                'quantity' => $item['qty'],
                'unit_price' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);

            $fp->sold += $item['qty'];
            if (!is_null($fp->quantity) && $fp->sold >= $fp->quantity) {
                $fp->sold_out = true;
            }
            $fp->save();
        }

        // Enviar e-mail quando a venda for concluída e cliente tiver email
        if (!$openTab && $order->customer && $order->customer->email) {
            $order->load(['items.fairProduct.product']);
            Mail::to($order->customer->email)->send(new OrderReceipt($order));
        }

        $this->cart = [];
        $this->payment_method = null;

        $this->dispatch('notify', message: $openTab ? 'Conta aberta para o cliente.' : 'Venda concluída!');
    }

    public function payOpenOrder(int $orderId)
    {
        $order = Order::where('status', 'open')->with(['items.fairProduct.product','customer'])->findOrFail($orderId);
        $this->validate();
        $order->update([
            'status' => 'paid',
            'payment_method' => $this->payment_method,
        ]);
        if ($order->customer && $order->customer->email) {
            Mail::to($order->customer->email)->send(new OrderReceipt($order));
        }
        $this->dispatch('notify', message: 'Conta fechada com sucesso.');
    }

    public function render()
    {
        $fair = Fair::with(['products' => function($q){
            $q->wherePivot('sold_out', false);
        }])->find($this->fair_id);

        $menu = FairProduct::with('product')
            ->where('fair_id', $this->fair_id)
            ->where('sold_out', false)
            ->get();

        $openOrders = Order::where('fair_id', $this->fair_id)->where('status', 'open')->with('customer')->latest()->get();

        return view('livewire.cashier.pos', compact('fair', 'menu', 'openOrders'));
    }
}
