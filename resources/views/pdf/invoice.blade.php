<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <style>body{font-family: DejaVu Sans, sans-serif; color:#0F172A;} table{width:100%; border-collapse:collapse;} td,th{border:1px solid #E2E8F0; padding:8px; font-size:12px;} .right{text-align:right;}</style>
</head>
<body>
    <h2><span style="color:#2563EB">UP</span>NEZ Invoice</h2>
    <p><strong>Invoice:</strong> {{ $invoice->invoice_number }}</p>
    <p><strong>Client:</strong> {{ $invoice->client?->company_name }}</p>
    <p><strong>Issue Date:</strong> {{ $invoice->issue_date?->format('M d, Y') }}</p>
    <p><strong>Due Date:</strong> {{ $invoice->due_date?->format('M d, Y') }}</p>

    <table>
        <thead><tr><th>Item</th><th>Qty</th><th class="right">Price</th></tr></thead>
        <tbody>
            @foreach(($invoice->line_items ?? []) as $item)
                <tr><td>{{ $item['name'] ?? 'Service' }}</td><td>{{ $item['qty'] ?? 1 }}</td><td class="right">${{ number_format((float)($item['price'] ?? 0),2) }}</td></tr>
            @endforeach
        </tbody>
    </table>

    <p class="right"><strong>Subtotal:</strong> ${{ number_format($invoice->subtotal,2) }}</p>
    <p class="right"><strong>Tax:</strong> ${{ number_format($invoice->tax,2) }}</p>
    <p class="right"><strong>Total:</strong> ${{ number_format($invoice->total,2) }}</p>
</body>
</html>
