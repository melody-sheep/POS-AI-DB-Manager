// Dashboard Tab Management
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard JS loaded');
    
    const tabs = document.querySelectorAll('.tab-item');
    const activeTabNameEl = document.getElementById('active-tab-name');
    
    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Update active tab visual indicator
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Get category from tab text
                const tabText = this.querySelector('.tab-text')?.textContent || 'Breads';
                const category = tabText.toLowerCase();
                
                // Update active tab display
                if (activeTabNameEl) {
                    activeTabNameEl.textContent = tabText;
                }
                
                // Refresh products if ProductManager exists
                if (window.productManager) {
                    console.log('Tab clicked, switching to category:', category);
                    window.productManager.currentCategory = category;
                    window.productManager.refreshProducts();
                }
            });
        });
        
        // Set first tab as active by default
        tabs[0].classList.add('active');
    }
});
