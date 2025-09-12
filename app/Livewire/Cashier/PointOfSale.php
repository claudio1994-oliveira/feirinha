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

    // Novas propriedades para melhor UX
    public ?int $selected_open_order = null;
    public bool $show_payment_modal = false;
    public string $payment_type = 'instant'; // 'instant', 'open_tab', 'close_tab', 'add_to_tab'
    public Order $order_to_pay;

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
            $this->dispatch('notify', message: 'Produto esgotado.', type: 'error');
            return;
        }
        if (!is_null($fp->quantity) && $fp->sold >= $fp->quantity) {
            $this->dispatch('notify', message: 'Produto esgotado.', type: 'error');
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

        $this->dispatch('notify', message: $fp->product->name . ' adicionado ao carrinho!', type: 'success');
    }

    public function removeFromCart(int $index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart); // Reindexar array
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

    public function clearCart()
    {
        $this->cart = [];
        $this->payment_method = null;
        $this->customer_id = null;
    }

    // Novo método para iniciar processo de pagamento
    public function startPayment($type = 'instant')
    {
        if (empty($this->cart)) {
            $this->dispatch('notify', message: 'Carrinho vazio!', type: 'error');
            return;
        }

        $this->payment_type = $type;
        $this->show_payment_modal = true;
        $this->resetErrorBag();
    }

    // Processar pagamento instantâneo ou abrir conta
    public function processPayment()
    {
        if ($this->payment_type === 'add_to_tab') {
            $this->processAddToOrder();
            return;
        }

        if (!$this->fair_id) {
            $this->dispatch('notify', message: 'Nenhuma feirinha atual definida.', type: 'error');
            return;
        }

        if ($this->payment_type === 'instant') {
            $this->validate(['payment_method' => 'required|in:cash,pix,card']);
        } else {
            // Para conta em aberto, payment_method não é obrigatório
            $this->validate(['customer_id' => 'nullable|exists:customers,id']);
        }

        $order = Order::create([
            'fair_id' => $this->fair_id,
            'customer_id' => $this->payment_type === 'open_tab' ? $this->customer_id : null,
            'status' => $this->payment_type === 'instant' ? 'paid' : 'open',
            'payment_method' => $this->payment_type === 'instant' ? $this->payment_method : null,
            'total' => $this->total,
        ]);

        foreach ($this->cart as $item) {
            $fp = FairProduct::find($item['fair_product_id']);

            // Verificar estoque novamente
            if ($fp->sold_out || (!is_null($fp->quantity) && $fp->sold + $item['qty'] > $fp->quantity)) {
                $this->dispatch('notify', message: $fp->product->name . ' não tem estoque suficiente.', type: 'error');
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

        // Enviar e-mail para pagamento instantâneo
        if ($this->payment_type === 'instant' && $order->customer && $order->customer->email) {
            $order->load(['items.fairProduct.product']);
            Mail::to($order->customer->email)->send(new OrderReceipt($order));
        }

        $message = $this->payment_type === 'instant' ? 'Venda finalizada com sucesso!' : 'Conta aberta para o cliente!';
        $this->dispatch('notify', message: $message, type: 'success');

        $this->clearCart();
        $this->show_payment_modal = false;
    }

    public function cancelPayment()
    {
        $this->show_payment_modal = false;
        $this->resetErrorBag();
    }

    // Selecionar conta aberta para pagamento
    public function selectOpenOrder($orderId)
    {
        $this->order_to_pay = Order::findOrFail($orderId);
        $this->payment_type = 'close_tab';
        $this->payment_method = ''; // Reset payment method
        $this->show_payment_modal = true;
    }

    public function addToOpenOrder($orderId)
    {
        if (empty($this->cart)) {
            $this->dispatch('notify', message: 'Carrinho vazio. Adicione produtos primeiro.', type: 'error');
            return;
        }

        $this->order_to_pay = Order::findOrFail($orderId);
        $this->payment_type = 'add_to_tab';
        $this->show_payment_modal = true;
    }

    public function processAddToOrder()
    {
        if (empty($this->cart)) {
            $this->dispatch('notify', message: 'Carrinho vazio.', type: 'error');
            return;
        }

        foreach ($this->cart as $item) {
            $fp = FairProduct::find($item['fair_product_id']);

            // Verificar estoque
            if ($fp->sold_out || (!is_null($fp->quantity) && $fp->sold + $item['qty'] > $fp->quantity)) {
                $this->dispatch('notify', message: $fp->product->name . ' não tem estoque suficiente.', type: 'error');
                continue;
            }

            OrderItem::create([
                'order_id' => $this->order_to_pay->id,
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

        // Atualizar total da conta
        $this->order_to_pay->update([
            'total' => $this->order_to_pay->total + $this->total
        ]);

        $this->dispatch('notify', message: 'Produtos adicionados à conta #' . $this->order_to_pay->id . '!', type: 'success');

        $this->clearCart();
        $this->show_payment_modal = false;
        $this->resetErrorBag();
    }

    // Fechar conta aberta
    public function closeOpenOrder()
    {
        $this->validate(['payment_method' => 'required|in:cash,pix,card']);

        $this->order_to_pay->update([
            'status' => 'paid',
            'payment_method' => $this->payment_method,
        ]);

        if ($this->order_to_pay->customer && $this->order_to_pay->customer->email) {
            Mail::to($this->order_to_pay->customer->email)->send(new OrderReceipt($this->order_to_pay));
        }

        $this->dispatch('notify', message: 'Conta #' . $this->order_to_pay->id . ' fechada com sucesso!', type: 'success');

        $this->show_payment_modal = false;
        $this->selected_open_order = null;
        $this->payment_method = null;
        $this->resetErrorBag();
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

        $openOrders = Order::where('fair_id', $this->fair_id)
            ->where('status', 'open')
            ->with('customer')
            ->latest()
            ->get();

        $customers = Customer::orderBy('name')->get();

        return view('livewire.cashier.pos', compact('fair', 'menu', 'openOrders', 'customers'));
    }
}
