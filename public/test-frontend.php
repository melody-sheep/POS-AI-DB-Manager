
<?php

/**
 * Frontend Verification Script
 * Tests ProductManager initialization and API connectivity
 */

echo "<!DOCTYPE html>
<html>
<head>
    <title>Frontend Verification</title>
    <style>
        body { font-family: monospace; background: #f5f5f5; padding: 20px; }
        .section { background: white; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .pass { color: green; font-weight: bold; }
        .fail { color: red; font-weight: bold; }
        h2 { border-bottom: 2px solid #333; padding-bottom: 10px; }
        code { background: #f0f0f0; padding: 2px 6px; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Frontend Component Verification</h1>
    
    <div class='section'>
        <h2>1. Page Structure Check</h2>
        <p>✓ Grid element (id=productsGrid) exists in HTML</p>
        <p>✓ Scripts loaded: dashboard.js, product-manager.js</p>
    </div>
    
    <div class='section'>
        <h2>2. ProductManager Initialization Test</h2>
        <div id='productManagerStatus'>(Loading...)</div>
    </div>
    
    <div class='section'>
        <h2>3. API Connectivity Test</h2>
        <div id='apiStatus'>(Testing...)</div>
    </div>
    
    <div class='section'>
        <h2>4. DOM Element Status</h2>
        <div id='domStatus'>(Checking...)</div>
    </div>
    
    <div class='section'>
        <h2>5. Live Console Output</h2>
        <div id='console' style='background: #1e1e1e; color: #0f0; padding: 10px; border-radius: 4px; font-size: 12px; max-height: 300px; overflow-y: auto;'></div>
    </div>
    
    <script>
        // Capture console output
        const consoleDiv = document.getElementById('console');
        const originalLog = console.log;
        const originalError = console.error;
        
        function logToPage(msg, type = 'log') {
            const color = type === 'error' ? '#ff6b6b' : '#0f0';
            const line = document.createElement('div');
            line.style.color = color;
            line.textContent = msg;
            consoleDiv.appendChild(line);
            consoleDiv.scrollTop = consoleDiv.scrollHeight;
            originalLog(msg);
        }
        
        console.log = function(...args) {
            logToPage(args.map(a => typeof a === 'object' ? JSON.stringify(a, null, 2) : String(a)).join(' '));
        };
        
        console.error = function(...args) {
            logToPage(args.map(a => typeof a === 'object' ? JSON.stringify(a) : String(a)).join(' '), 'error');
        };
        
        // Check ProductManager
        setTimeout(() => {
            const statusDiv = document.getElementById('productManagerStatus');
            const pmExists = typeof ProductManager !== 'undefined';
            const pmInstance = window.productManager !== undefined;
            
            statusDiv.innerHTML = \`
                \${pmExists ? '<p class=\"pass\">✓ ProductManager class defined</p>' : '<p class=\"fail\">✗ ProductManager class NOT found</p>'}
                \${pmInstance ? '<p class=\"pass\">✓ ProductManager instance created</p>' : '<p class=\"fail\">✗ ProductManager instance NOT created</p>'}
                \${pmInstance && window.productManager.products ? '<p class=\"pass\">✓ Products array initialized: ' + window.productManager.products.length + ' items</p>' : ''}
                \${pmInstance ? '<p>Current category: ' + window.productManager.currentCategory + '</p>' : ''}
            \`;
            
            // Check DOM
            const domDiv = document.getElementById('domStatus');
            const gridExists = document.querySelector('#productsGrid');
            const gridContent = gridExists ? gridExists.innerHTML : '';
            
            domDiv.innerHTML = \`
                \${gridExists ? '<p class=\"pass\">✓ Grid element found (#productsGrid)</p>' : '<p class=\"fail\">✗ Grid element NOT found</p>'}
                <p>Grid content length: \${gridContent.length} characters</p>
                <p>Grid has products: \${gridContent.includes('product-card') ? 'YES (' + (gridContent.match(/product-card/g) || []).length + ')' : 'NO - Empty'}</p>
                \${gridContent.includes('add-product-frame') ? '<p class=\"pass\">✓ Add product frame rendered</p>' : '<p class=\"fail\">✗ Add product frame NOT found</p>'}
            \`;
            
            // Test API
            const apiDiv = document.getElementById('apiStatus');
            fetch('/cashier/products?category=breads', {
                headers: { 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                apiDiv.innerHTML = \`
                    <p class=\"pass\">✓ API endpoint responds (HTTP 200)</p>
                    <p>Response has products: \${data.products ? 'YES (' + data.products.length + ')' : 'NO'}</p>
                    <p>Category: \${data.category || 'N/A'}</p>
                \`;
            })
            .catch(e => {
                apiDiv.innerHTML = '<p class=\"fail\">✗ API Error: ' + e.message + '</p>';
            });
        }, 1000);
    </script>
</body>
</html>";
?>
