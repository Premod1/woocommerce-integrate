@extends('layouts.app')

@section('styles')
<style>
    .product-image-container {
        height: 240px;
        position: relative;
        overflow: hidden;
        background: rgba(0,0,0,0.2);
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .card:hover .product-image {
        transform: scale(1.1);
    }
    
    .product-content {
        padding: 1.5rem;
    }
    
    .product-category {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 0.5rem;
        letter-spacing: 0.05em;
    }
    
    .product-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--text-main);
    }
    
    .product-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #10b981;
        margin-bottom: 1.5rem;
    }
    
    .badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        backdrop-filter: blur(4px);
    }
    
    .badge-on-sale {
        background: rgba(244, 63, 94, 0.8);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        background: var(--card-bg);
        border-radius: 24px;
        border: 1px dashed var(--glass-border);
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 2rem;
        background: linear-gradient(to right, #fff, #94a3b8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection

@section('content')
<h1 class="page-title">WooCommerce Products</h1>

@if(isset($products) && count($products) > 0)
    <div class="grid">
        @foreach($products as $product)
            <div class="card">
                <div class="product-image-container">
                    @if($product->on_sale)
                        <span class="badge badge-on-sale">Sale!</span>
                    @endif
                    
                    @if(isset($product->images) && count($product->images) > 0)
                        <img src="{{ $product->images[0]->src }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <div class="product-image loading-shimmer"></div>
                    @endif
                </div>
                
                <div class="product-content">
                    <div class="product-category">
                        @if(isset($product->categories) && count($product->categories) > 0)
                            {{ $product->categories[0]->name }}
                        @else
                            Uncategorized
                        @endif
                    </div>
                    
                    <h2 class="product-title" title="{{ $product->name }}">{{ $product->name }}</h2>
                    
                    <div class="product-price">
                        {!! $product->price_html !!}
                    </div>
                    
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary" style="width: 100%; text-align: center;">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <h2 style="font-size: 2rem; margin-bottom: 1rem;">No Products Found</h2>
        <p style="color: var(--text-secondary);">Your WooCommerce store seems to have no products or there's a connection issue.</p>
        <div style="margin-top: 2rem;">
            <a href="{{ route('products.index') }}" class="btn btn-primary">Refresh Store</a>
        </div>
    </div>
@endif
@endsection
