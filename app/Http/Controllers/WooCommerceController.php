<?php

namespace App\Http\Controllers;

use App\Services\WooCommerceService;
use Illuminate\Http\Request;

class WooCommerceController extends Controller
{
    protected $wooService;

    public function __construct(WooCommerceService $wooService)
    {
        $this->wooService = $wooService;
    }

    /**
     * Display a listing of products from WooCommerce.
     */
    public function index()
    {
        try {
            $products = $this->wooService->getProducts([
                'per_page' => 20,
            ]);

            return view('woocommerce.products', compact('products'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch products: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        try {
            $product = $this->wooService->client()->get("products/{$id}");
            return view('woocommerce.product-detail', compact('product'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch product details.');
        }
    }

    /**
     * Display a listing of orders from WooCommerce.
     */
    public function orders()
    {
        try {
            $orders = $this->wooService->getOrders([
                'per_page' => 20,
            ]);

            return view('woocommerce.orders', compact('orders'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch orders: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified order details.
     */
    public function showOrder($id)
    {
        try {
            $order = $this->wooService->getOrder($id);
            return view('woocommerce.order-detail', compact('order'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch order details.');
        }
    }
}
