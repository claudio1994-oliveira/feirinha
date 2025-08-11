<h1>Comprovante de Compra</h1>
<p>Pedido #{{ $order->id }}</p>
<p>Status: {{ strtoupper($order->status) }}</p>
<p>Forma de pagamento: {{ strtoupper($order->payment_method ?? 'pendente') }}</p>
<table width="100%" cellpadding="6" cellspacing="0" border="1" style="border-collapse:collapse">
    <thead>
        <tr>
            <th align="left">Produto</th>
            <th align="right">Qtd</th>
            <th align="right">Preço</th>
            <th align="right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->fairProduct->product->name }}</td>
                <td align="right">{{ $item->quantity }}</td>
                <td align="right">R$ {{ number_format($item->unit_price, 2, ',', '.') }}</td>
                <td align="right">R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" align="right"><strong>Total</strong></td>
            <td align="right"><strong>R$ {{ number_format($order->total, 2, ',', '.') }}</strong></td>
        </tr>
    </tfoot>
</table>
