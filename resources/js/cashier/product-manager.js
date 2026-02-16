 
// Product Manager - With Add Product Modal functionality
class ProductManager {
    constructor() {
        console.log('Product Manager initialized');
        this.initModalTriggers();
    }

    initModalTriggers() {
        // Listen for Add Product button clicks
        document.addEventListener('click', (e) => {
            if (e.target.closest('.add-product-btn') || e.target.closest('[data-add-product]')) {
                this.openAddProductModal();
            }
        });

        // Listen for form submission
        const form = document.getElementById('addProductForm');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleAddProduct();
            });
        }
    }

    openAddProductModal() {
        // Dispatch Alpine event to open modal
        window.dispatchEvent(new CustomEvent('open-modal', { 
            detail: 'add-product-modal' 
        }));
        
        // Also try Alpine data method as fallback
        const alpineRoot = document.querySelector('[x-data]');
        if (alpineRoot && alpineRoot.__x) {
            alpineRoot.__x.$data.showProductModal = true;
        }
    }

    handleAddProduct() {
        // TODO: Implement product addition logic
        console.log('Adding new product...');
        
        // Show success notification
        this.showNotification('Product added successfully!', 'success');
        
        // Close modal
        window.dispatchEvent(new CustomEvent('close-modal', { 
            detail: 'add-product-modal' 
        }));
    }

    showNotification(message, type = 'success') {
        // Use Alpine's notification system
        const alpineRoot = document.querySelector('[x-data]');
        if (alpineRoot && alpineRoot.__x) {
            // Add to notifications array
            const newNotification = {
                id: Date.now(),
                type: type,
                title: type === 'success' ? 'Success' : 'Info',
                message: message,
                time: 'Just now',
                read: false
            };
            
            // Access Alpine data and update
            const cashierData = alpineRoot.__x.$data;
            if (cashierData.notifications) {
                cashierData.notifications.unshift(newNotification);
                cashierData.unreadCount = (cashierData.unreadCount || 0) + 1;
            }
        }
    }
}

// Make it globally available
window.ProductManager = ProductManager;

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM ready, initializing Product Manager');
    window.productManager = new ProductManager();
});