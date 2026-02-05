@extends('layouts.app')

@section('styles')
<style>
    .product-detail-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        background: var(--card-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 32px;
        padding: 3rem;
    }

    .detail-image-container {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .detail-image {
        width: 100%;
        height: auto;
        display: block;
    }

    .detail-content {
        display: flex;
        flex-direction: column;
    }

    .detail-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        line-height: 1.1;
    }

    .detail-price {
        font-size: 2.5rem;
        font-weight: 700;
        color: #10b981;
        margin-bottom: 2rem;
    }

    .detail-description {
        color: var(--text-secondary);
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 2.5rem;
    }

    .detail-description p {
        margin-bottom: 1rem;
    }

    .meta-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .meta-item {
        background: rgba(255, 255, 255, 0.05);
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid var(--glass-border);
    }

    .meta-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .meta-value {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-secondary);
        text-decoration: none;
        margin-bottom: 2rem;
        font-weight: 500;
        transition: color 0.3s;
    }

    .back-btn:hover {
        color: var(--text-main);
    }

    @media (max-width: 968px) {
        .product-detail-container {
            grid-template-columns: 1fr;
            padding: 2rem;
            gap: 2rem;
        }
        .detail-title {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<a href="{{ route('products.index') }}" class="back-btn">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Products
</a>

<div class="product-detail-container">
    <div class="detail-image-container">
        @if(isset($product->images) && count($product->images) > 0)
            <img src="{{ $product->images[0]->src }}" alt="{{ $product->name }}" class="detail-image">
        @else
            <div class="detail-image loading-shimmer" style="aspect-ratio: 1/1;"></div>
        @endif
    </div>

    <div class="detail-content">
        <div class="meta-label">
            @if(isset($product->categories) && count($product->categories) > 0)
                {{ $product->categories[0]->name }}
            @endif
        </div>
        
        <h1 class="detail-title">{{ $product->name }}</h1>
        
        <div class="detail-price">
            {!! $product->price_html !!}
        </div>

        <div class="meta-info">
            <div class="meta-item">
                <div class="meta-label">Status</div>
                <div class="meta-value">{{ ucfirst($product->status) }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">SKU</div>
                <div class="meta-value">{{ $product->sku ?: 'N/A' }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Stock Status</div>
                <div class="meta-value" style="color: {{ $product->stock_status === 'instock' ? '#10b981' : '#f43f5e' }}">
                    {{ $product->stock_status === 'instock' ? 'In Stock' : 'Out of Stock' }}
                </div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Weight</div>
                <div class="meta-value">{{ $product->weight ?: '0' }} kg</div>
            </div>
        </div>

        <div class="detail-description">
            {!! $product->description ?: '<p>No description available.</p>' !!}
        </div>

        <div style="margin-top: auto;">
            <a href="{{ $product->permalink }}" target="_blank" class="btn btn-primary" style="width: 100%; text-align: center; padding: 1rem;">View on WooCommerce Store</a>
        </div>
    </div>
</div>
@endsection
