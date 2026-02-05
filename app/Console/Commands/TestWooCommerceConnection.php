<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WooCommerceService;
use Exception;

class TestWooCommerceConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'woocommerce:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the connection to WooCommerce API';

    /**
     * Execute the console command.
     */
    public function handle(WooCommerceService $wooCommerceService)
    {
        $this->info('Testing WooCommerce connection...');
        $this->info('Store URL: ' . config('woocommerce.store_url'));

        try {
            $products = $wooCommerceService->getProducts(['per_page' => 1]);
            
            $this->info('Successfully connected to WooCommerce!');
            $this->info('Found ' . count($products) . ' product(s) in the first page test.');
            
            if (count($products) > 0) {
                $product = $products[0];
                $this->line('Sample Product: ' . ($product->name ?? 'N/A'));
            }
        } catch (Exception $e) {
            $this->error('Failed to connect to WooCommerce.');
            $this->error('Error: ' . $e->getMessage());
            
            if (config('woocommerce.store_url') === 'https://example.com') {
                $this->warn('HINT: You are still using the placeholder URL "https://example.com". Please update WOOCOMMERCE_STORE_URL in your .env file.');
            }
        }
    }
}
