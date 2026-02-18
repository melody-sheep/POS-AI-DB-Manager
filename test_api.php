<?php

// Test the API endpoint by calling it directly
echo "Testing Products API...\n\n";

// Start a request to the API endpoint
$categories = ['breads', 'cakes', 'beverages'];

foreach ($categories as $category) {
    echo "=== Testing $category ===\n";
    
    $url = "http://localhost:8000/cashier/products?category=$category";
    
    // Try to fetch using curl
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_HTTPHEADER => ['Accept: application/json'],
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        echo "CURL Error: $error\n";
        echo "Note: Make sure Laravel development server is running!\n";
        echo "Run: php artisan serve\n";
    } else {
        echo "HTTP Status: $httpCode\n";
        echo "Response:\n";
        if ($httpCode == 200) {
            echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n";
        } else {
            echo $response . "\n";
        }
    }
    echo "\n";
}
