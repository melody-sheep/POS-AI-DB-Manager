// Frontend Diagnostic Script
// Add this to console or view page source

console.log("=== PRODUCT MANAGER DIAGNOSTICS ===\n");

// Check if grid element exists
const grid = document.querySelector('#productsGrid');
console.log("1. Grid element found:", grid ? "YES" : "NO");
if (grid) {
    console.log("   - Grid ID:", grid.id);
    console.log("   - Grid classes:", grid.className);
    console.log("   - Grid parent:", grid.parentElement?.className);
    console.log("   - Grid innerHTML length:", grid.innerHTML.length);
}

// Check if ProductManager exists
console.log("\n2. ProductManager class:", typeof ProductManager, "(should be 'function')");
console.log("3. ProductManager instance (window.productManager):", window.productManager ? "EXISTS" : "MISSING");

if (window.productManager) {
    console.log("   - Current category:", window.productManager.currentCategory);
    console.log("   - Products loaded:", window.productManager.products ? window.productManager.products.length : "0");
    console.log("   - Grid selector:", window.productManager.config.gridSelector);
}

// Check for script errors
console.log("\n4. Script loading status:");
console.log("   - dashboard.js:", document.querySelector('script[src*="dashboard.js"]') ? "LOADED" : "NOT FOUND");
console.log("   - product-manager.js:", document.querySelector('script[src*="product-manager.js"]') ? "LOADED" : "NOT FOUND");

// Try to manually trigger refresh
console.log("\n5. Attempting to refresh products...");
if (window.productManager) {
    window.productManager.refreshProducts();
    console.log("   ✓ Refresh triggered");
} else {
    console.log("   ✗ ProductManager not available");
}

// Check fetch capability
console.log("\n6. Testing API endpoint...");
fetch('/cashier/products?category=breads', {
    headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
})
.then(r => r.json())
.then(data => {
    console.log("   ✓ API Response received");
    console.log("   - Products count:", data.products?.length || 0);
    console.log("   - First product:", data.products?.[0]?.name || "N/A");
})
.catch(e => {
    console.log("   ✗ API Error:", e.message);
});

console.log("\n=== END DIAGNOSTICS ===");
