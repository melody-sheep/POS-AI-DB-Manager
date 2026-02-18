<?php

// Debug products and ProductManager
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$container = $app->make(Illuminate\Contracts\Container\Container::class);
$app->make(Illuminate\Contracts\Http\Kernel::class);

// Load the Product model
$products = \App\Models\Product::all();

echo "=== DATABASE PRODUCTS ===\n";
echo "Total Products: " . count($products) . "\n\n";

if (count($products) > 0) {
    foreach ($products as $product) {
        echo "ID: {$product->id}\n";
        echo "Name: {$product->name}\n";
        echo "Category: {$product->category}\n";
        echo "Stock: {$product->stock}\n";
        echo "Price: {$product->price}\n";
        echo "Is Active: {$product->is_active}\n";
        echo "---\n";
    }
} else {
    echo "No products found!\n";
}

echo "\n=== PRODUCTS BY CATEGORY (Breads) ===\n";
$breads = \App\Models\Product::where('category', 'breads')->where('is_active', true)->get();
echo "Breads Count: " . count($breads) . "\n";

echo "\n=== PRODUCTS BY CATEGORY (Cakes) ===\n";
$cakes = \App\Models\Product::where('category', 'cakes')->where('is_active', true)->get();
echo "Cakes Count: " . count($cakes) . "\n";

echo "\n=== PRODUCTS BY CATEGORY (Beverages) ===\n";
$beverages = \App\Models\Product::where('category', 'beverages')->where('is_active', true)->get();
echo "Beverages Count: " . count($beverages) . "\n";

echo "\n=== API RESPONSE TEST ===\n";
echo json_encode([
    'products' => $breads->toArray(),
    'category' => 'breads'
], JSON_PRETTY_PRINT) . "\n";

echo "\nDebug complete.\n";
