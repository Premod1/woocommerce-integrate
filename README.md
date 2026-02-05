# Laravel WooCommerce Integration

A powerful and seamless integration between Laravel and WooCommerce, allowing you to manage your WooCommerce store directly from your Laravel application.

## 🚀 Purpose

This project serves as a bridge between a Laravel-based system (like an ERP or CRM) and a WooCommerce store. It leverages the official WooCommerce REST API to fetch and manage products, orders, and more, providing a robust foundation for building custom multi-platform e-commerce solutions.

## ✨ Features

-   **Product Management**: View, list, and detail WooCommerce products.
-   **Order Tracking**: Access and view customer orders from your WooCommerce store.
-   **Service Layer Architecture**: Clean and reusable `WooCommerceService` for all API interactions.
-   **Configurable**: Easily configure store credentials via environment variables.
-   **Tailwind CSS Integration**: Beautifully designed UI for viewing products and orders (standard Laravel stack).

## 🛠 Tech Stack

-   **Backend**: Laravel 11.x
-   **API Client**: [WooCommerce PHP SDK](https://github.com/woocommerce/wc-api-php)
-   **UI**: Blade, Tailwind CSS, Vite

## 📥 Installation

1.  **Clone the repository**:
    ```bash
    git clone https://github.com/your-repo/woocommerce-integrate.git
    cd woocommerce-integrate
    ```

2.  **Install dependencies**:
    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup**:
    Copy the `.env.example` to `.env` and configure your WooCommerce credentials:
    ```bash
    cp .env.example .env
    ```
    Update the following keys in your `.env` file:
    ```env
    WOOCOMMERCE_STORE_URL=https://your-store.com
    WOOCOMMERCE_CONSUMER_KEY=ck_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    WOOCOMMERCE_CONSUMER_SECRET=cs_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    WOOCOMMERCE_VERIFY_SSL=true
    WOOCOMMERCE_API_VERSION=wc/v3
    ```

4.  **Generate App Key**:
    ```bash
    php artisan key:generate
    ```

5.  **Compile Assets**:
    ```bash
    npm run dev
    ```

6.  **Run Server**:
    ```bash
    php artisan serve
    ```

## ⚙️ Configuration

The configuration for the WooCommerce integration is located in `config/woocommerce.php`. It handles the store URL, consumer keys, and API versioning.

```php
return [
    'store_url' => env('WOOCOMMERCE_STORE_URL'),
    'consumer_key' => env('WOOCOMMERCE_CONSUMER_KEY'),
    'consumer_secret' => env('WOOCOMMERCE_CONSUMER_SECRET'),
    'verify_ssl' => env('WOOCOMMERCE_VERIFY_SSL', true),
    'api_version' => env('WOOCOMMERCE_API_VERSION', 'wc/v3'),
];
```

## 📂 Project Structure

-   `app/Services/WooCommerceService.php`: Core logic for API communication.
-   `app/Http/Controllers/WooCommerceController.php`: Handles requests and renders views.
-   `config/woocommerce.php`: Configuration file for the SDK.
-   `resources/views/woocommerce/`: Blade templates for products and orders.

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
