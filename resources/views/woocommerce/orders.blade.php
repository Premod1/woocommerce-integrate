@extends('layouts.app')

@section('styles')
<style>
    .orders-table-container {
        background: var(--card-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        overflow: hidden;
        margin-top: 2rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        color: var(--text-main);
    }

    th {
        text-align: left;
        padding: 1.25rem 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
        color: var(--primary);
        border-bottom: 1px solid var(--glass-border);
    }

    td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--glass-border);
        font-size: 0.95rem;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background: rgba(255, 255, 255, 0.02);
    }

    .order-id {
        font-weight: 700;
        color: var(--text-main);
    }

    .status-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-completed { background: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
    .status-processing { background: rgba(59, 130, 246, 0.2); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3); }
    .status-pending { background: rgba(245, 158, 11, 0.2); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); }
    .status-on-hold { background: rgba(107, 114, 128, 0.2); color: #9ca3af; border: 1px solid rgba(107, 114, 128, 0.3); }
    .status-cancelled { background: rgba(244, 63, 94, 0.2); color: #f43f5e; border: 1px solid rgba(244, 63, 94, 0.3); }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">Recent Orders</h1>
    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">Refresh Orders</a>
</div>

<div class="orders-table-container">
    @if(isset($orders) && count($orders) > 0)
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <span class="order-id">#{{ $order->id }}</span>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $order->billing->first_name }} {{ $order->billing->last_name }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-secondary);">{{ $order->billing->email }}</div>
                        </td>
                        <td>
                            {{ date('M d, Y', strtotime($order->date_created)) }}
                        </td>
                        <td>
                            <span class="status-badge status-{{ $order->status }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>
                            <span style="font-weight: 700; color: #10b981;">{!! $order->currency_symbol !!} {{ number_format($order->total, 2) }}</span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="padding: 4rem; text-align: center;">
            <h2 style="color: var(--text-secondary);">No orders found.</h2>
            <p style="margin-top: 1rem; color: var(--text-secondary);">Your WooCommerce store hasn't received any orders yet.</p>
        </div>
    @endif
</div>
@endsection
