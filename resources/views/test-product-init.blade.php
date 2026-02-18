<!DOCTYPE html>
<html>
<head>
    <title>ProductManager Test</title>
</head>
<body>
    <h1>ProductManager Initialization Test</h1>
    <div id="productsGrid" class="products-grid" style="border: 2px solid red; padding: 20px; min-height: 300px;">
        <p>Grid will load here...</p>
    </div>

    <script src="{{ asset('js/cashier/product-manager.js') }}"></script>
    
    <script>
        console.log("=== TEST PAGE LOADED ===");
        console.log("ProductManager class available:", typeof ProductManager);
        console.log("productManager instance:", window.productManager);
        
        // Wait a bit and check again
        setTimeout(() => {
            console.log("After 1 second:");
            console.log("productManager instance:", window.productManager);
            if (window.productManager) {
                console.log("Current category:", window.productManager.currentCategory);
                console.log("Products count:", window.productManager.products.length);
            }
        }, 1000);
    </script>
</body>
</html>
