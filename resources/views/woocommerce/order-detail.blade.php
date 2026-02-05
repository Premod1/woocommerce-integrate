@extends('layouts.app')

@section('styles')
<style>
    .order-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .glass-card {
        background: var(--card-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--primary);
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid var(--glass-border);
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-info {
        display: flex;
        gap: 1rem;
    }

    .item-name {
        font-weight: 600;
    }

    .item-meta {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .order-summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }

    .total-row {
        border-top: 1px solid var(--glass-border);
        padding-top: 1rem;
        margin-top: 1rem;
        font-size: 1.5rem;
        font-weight: 800;
        color: #10b981;
    }

    .address-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .address-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: var(--text-secondary);
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .status-banner {
        padding: 1rem 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-processing { background: linear-gradient(90deg, rgba(59, 130, 246, 0.2), transparent); border-left: 4px solid #3b82f6; }
    .status-completed { background: linear-gradient(90deg, rgba(16, 185, 129, 0.2), transparent); border-left: 4px solid #10b981; }

    @media (max-width: 968px) {
        .order-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<a href="{{ route('orders.index') }}" class="back-btn">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Orders
</a>

<div class="status-banner status-{{ $order->status }}">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 800;">Order #{{ $order->id }}</h1>
        <p style="color: var(--text-secondary);">Placed on {{ date('F d, Y at H:i', strtotime($order->date_created)) }}</p>
    </div>
    <div style="text-align: right;">
        <div class="status-badge status-{{ $order->status }}">{{ $order->status }}</div>
        <p style="margin-top: 0.5rem; font-size: 0.85rem;">Payment via {{ $order->payment_method_title }}</p>
    </div>
</div>

<div class="order-container">
    <div class="order-main">
        <div class="glass-card">
            <h2 class="card-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path><path d="M3 6h18"></path><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                Order Items
            </h2>
            
            @foreach($order->line_items as $item)
                <div class="item-row">
                    <div class="item-info">
                        <div>
                            <div class="item-name">{{ $item->name }}</div>
                            <div class="item-meta">SKU: {{ $item->sku ?: 'N/A' }} | Price: {!! $order->currency_symbol !!}{{ number_format($item->price, 2) }}</div>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-weight: 600;">× {{ $item->quantity }}</div>
                        <div style="font-weight: 700; color: var(--text-main);">{!! $order->currency_symbol !!}{{ number_format($item->total, 2) }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="glass-card">
            <h2 class="card-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                Shipping Details
            </h2>
            <div style="color: var(--text-secondary); line-height: 1.8;">
                <strong>Method:</strong> {{ $order->shipping_lines[0]->method_title ?? 'N/A' }}<br>
                <strong>Tracking:</strong> {{ $order->customer_note ?: 'No notes provided' }}
            </div>
        </div>
    </div>

    <div class="order-sidebar">
        <div class="glass-card">
            <h2 class="card-title">Summary</h2>
            <div class="order-summary-row">
                <span>Subtotal</span>
                <span>{!! $order->currency_symbol !!} {{ number_format($order->total - $order->total_tax - $order->shipping_total, 2) }}</span>
            </div>
            <div class="order-summary-row">
                <span>Shipping</span>
                <span>{!! $order->currency_symbol !!} {{ number_format($order->shipping_total, 2) }}</span>
            </div>
            <div class="order-summary-row">
                <span>Tax</span>
                <span>{!! $order->currency_symbol !!} {{ number_format($order->total_tax, 2) }}</span>
            </div>
            <div class="order-summary-row total-row">
                <span>Total</span>
                <span>{!! $order->currency_symbol !!} {{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <div class="glass-card">
            <h2 class="card-title">Customer</h2>
            <div class="address-grid">
                <div>
                    <div class="address-label">Billing Address</div>
                    <div style="font-size: 0.95rem;">
                        <strong>{{ $order->billing->first_name }} {{ $order->billing->last_name }}</strong><br>
                        {{ $order->billing->address_1 }}<br>
                        @if($order->billing->address_2) {{ $order->billing->address_2 }}<br> @endif
                        {{ $order->billing->city }}, {{ $order->billing->state }} {{ $order->billing->postcode }}<br>
                        {{ $order->billing->country }}<br>
                        <div style="margin-top: 0.5rem; color: var(--primary);">{{ $order->billing->phone }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
