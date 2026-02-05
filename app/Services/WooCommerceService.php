<?php

namespace App\Services;

use Automattic\WooCommerce\Client;

class WooCommerceService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(
            config('woocommerce.store_url'),
            config('woocommerce.consumer_key'),
            config('woocommerce.consumer_secret'),
            [
                'version' => config('woocommerce.api_version'),
                'verify_ssl' => config('woocommerce.verify_ssl'),
            ]
        );
    }

    /**
     * Get the WooCommerce client.
     *
     * @return Client
     */
    public function client()
    {
        return $this->client;
    }

    /**
     * Fetch all products.
     *
     * @param array $params
     * @return array
     */
    public function getProducts($params = [])
    {
        return $this->client->get('products', $params);
    }

    /**
     * Fetch all orders.
     *
     * @param array $params
     * @return array
     */
    public function getOrders($params = [])
    {
        return $this->client->get('orders', $params);
    }

    /**
     * Fetch a specific order.
     *
     * @param int $id
     * @return object
     */
    public function getOrder($id)
    {
        return $this->client->get("orders/{$id}");
    }

    /**
     * Update an order.
     *
     * @param int $id
     * @param array $data
     * @return object
     */
    public function updateOrder($id, $data)
    {
        return $this->client->put("orders/{$id}", $data);
    }

    /**
     * Create a product.
     *
     * @param array $data
     * @return object
     */
    public function createProduct($data)
    {
        return $this->client->post('products', $data);
    }
}
