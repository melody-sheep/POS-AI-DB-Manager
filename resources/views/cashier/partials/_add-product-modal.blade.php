<!-- Add Product Modal -->
<x-modal name="add-product-modal" :show="$showProductModal ?? false" focusable maxWidth="2xl">
    <div class="p-8">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">
                Add New Product
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Fill in the product details below
            </p>
        </div>

        <form id="addProductForm" class="space-y-5" x-data="{
            // Form fields
            productName: '',
            category: '',
            stock: '',
            price: '',
            imagePreview: null,
            imageSource: 'upload',
            
            // Error states
            errors: {
                productName: false,
                category: false,
                stock: false,
                price: false,
                image: false
            },
            
            // Touched fields for validation
            touched: {
                productName: false,
                category: false,
                stock: false,
                price: false
            },
            
            // Computed property for form validity
            get isFormValid() {
                return this.productName.trim() !== '' && 
                       this.category !== '' && 
                       this.stock !== '' && 
                       this.price !== '' && 
                       parseFloat(this.price) > 0;
            },
            
            // Stock status
            get stockStatus() {
                if (this.stock === '' || this.stock === null) return '';
                const stockNum = parseInt(this.stock);
                if (stockNum === 0) return 'out';
                if (stockNum < 6) return 'low';
                return 'in';
            },
            
            // Validate specific field
            validateField(field) {
                this.touched[field] = true;
                
                switch(field) {
                    case 'productName':
                        this.errors.productName = this.productName.trim() === '';
                        break;
                    case 'category':
                        this.errors.category = this.category === '';
                        break;
                    case 'stock':
                        this.errors.stock = this.stock === '' || parseInt(this.stock) < 0;
                        break;
                    case 'price':
                        this.errors.price = this.price === '' || parseFloat(this.price) <= 0;
                        break;
                }
            },
            
            // Validate all fields
            validateAll() {
                this.validateField('productName');
                this.validateField('category');
                this.validateField('stock');
                this.validateField('price');
                
                return !this.errors.productName && 
                       !this.errors.category && 
                       !this.errors.stock && 
                       !this.errors.price;
            },
            
            // Handle form submission
            submitForm() {
                if (this.validateAll()) {
                    // Form is valid, submit
                    this.handleAddProduct();
                } else {
                    // Show error message
                    this.showFormError('Please fill in all required fields correctly');
                }
            },
            
            // Image handling
            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                    this.imageSource = 'upload';
                    this.errors.image = false;
                }
            },
            
            selectExistingImage(imageUrl) {
                this.imagePreview = imageUrl;
                this.imageSource = 'existing';
                this.errors.image = false;
            },
            
            // Placeholder methods (to be implemented)
            handleAddProduct() {
                console.log('Adding new product...', {
                    name: this.productName,
                    category: this.category,
                    stock: this.stock,
                    price: this.price,
                    image: this.imagePreview
                });
                
                // Show success notification
                this.showNotification('Product added successfully!', 'success');
                
                // Close modal and reset form
                this.resetForm();
                $dispatch('close-modal', 'add-product-modal');
            },
            
            showNotification(message, type) {
                const alpineRoot = document.querySelector('[x-data]');
                if (alpineRoot && alpineRoot.__x) {
                    const cashierData = alpineRoot.__x.$data;
                    const newNotification = {
                        id: Date.now(),
                        type: type,
                        title: type === 'success' ? 'Success' : 'Info',
                        message: message,
                        time: 'Just now',
                        read: false
                    };
                    if (cashierData.notifications) {
                        cashierData.notifications.unshift(newNotification);
                        cashierData.unreadCount = (cashierData.unreadCount || 0) + 1;
                    }
                }
            },
            
            showFormError(message) {
                // You can implement a toast or alert here
                alert(message);
            },
            
            resetForm() {
                this.productName = '';
                this.category = '';
                this.stock = '';
                this.price = '';
                this.imagePreview = null;
                this.imageSource = 'upload';
                this.errors = { productName: false, category: false, stock: false, price: false, image: false };
                this.touched = { productName: false, category: false, stock: false, price: false };
            }
        }">
            
            <!-- Image Section -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Product Image <span class="text-gray-400 text-xs font-normal">(Optional)</span>
                </label>
                <div class="flex items-start space-x-4">
                    <!-- Image Preview/Upload Box -->
                    <div class="relative flex-shrink-0">
                        <template x-if="!imagePreview">
                            <div class="w-20 h-20 bg-gray-50 border border-gray-200 rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-gray-400 transition-colors group">
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs text-gray-500 mt-1">Upload</span>
                                <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="previewImage" accept="image/*">
                            </div>
                        </template>
                        <template x-if="imagePreview">
                            <div class="relative">
                                <img :src="imagePreview" class="w-20 h-20 rounded-lg object-cover border border-gray-200">
                                <button type="button" @click="imagePreview = null; imageSource = 'upload'" class="absolute -top-2 -right-2 w-5 h-5 bg-white text-gray-600 rounded-full flex items-center justify-center hover:bg-gray-100 transition-colors border border-gray-300 shadow-sm">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- Existing Images Icon -->
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Select from gallery
                        </p>
                        <button type="button" @click="$dispatch('open-modal', 'gallery-modal')" class="flex items-center space-x-2 text-sm text-gray-600 hover:text-pink-border transition-colors group">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-pink-50">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-pink-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span>Browse existing images</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Name and Category - 2 columns with proper spacing -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Product Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           x-model="productName"
                           @blur="validateField('productName')"
                           @input="validateField('productName')"
                           :class="{'border-red-500 focus:border-red-500 focus:ring-red-500/30': errors.productName, 'border-gray-300': !errors.productName}"
                           class="w-full h-10 px-3 border rounded-lg text-sm focus:ring-1 outline-none transition-colors"
                           placeholder="e.g. Cinnamon Roll">
                    <template x-if="errors.productName">
                        <p class="text-xs text-red-500 mt-1">Product name is required</p>
                    </template>
                </div>
                
                <!-- Category -->
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <div class="relative mt-1">
                        <select x-model="category"
                                @blur="validateField('category')"
                                @change="validateField('category')"
                                :class="{'border-red-500 focus:border-red-500 focus:ring-red-500/30': errors.category, 'border-gray-300': !errors.category}"
                                class="w-full h-10 px-3 border rounded-lg text-sm focus:ring-1 outline-none transition-colors appearance-none bg-white">
                            <option value="" disabled>Select category</option>
                            <option value="breads">Breads</option>
                            <option value="cakes">Cakes</option>
                            <option value="beverages">Beverages</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <template x-if="errors.category">
                        <p class="text-xs text-red-500 mt-1">Please select a category</p>
                    </template>
                </div>
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Stock Quantity <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="number" 
                           x-model="stock"
                           @blur="validateField('stock')"
                           @input="validateField('stock')"
                           :class="{'border-red-500 focus:border-red-500 focus:ring-red-500/30': errors.stock, 'border-gray-300': !errors.stock}"
                           class="w-full h-10 px-3 border rounded-lg text-sm focus:ring-1 outline-none transition-colors [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                           placeholder="Enter quantity">
                    
                    <!-- Stock Status - Subtle -->
                    <div class="absolute right-3 top-1/2 -translate-y-1/2">
                        <template x-if="stockStatus === 'out' && stock !== ''">
                            <span class="text-xs text-red-500 font-medium">Out of Stock</span>
                        </template>
                        <template x-if="stockStatus === 'low' && stock !== ''">
                            <span class="text-xs text-orange-500 font-medium">Low Stock</span>
                        </template>
                        <template x-if="stockStatus === 'in' && stock !== ''">
                            <span class="text-xs text-green-500 font-medium">In Stock</span>
                        </template>
                    </div>
                </div>
                <template x-if="errors.stock">
                    <p class="text-xs text-red-500 mt-1">Valid stock quantity is required</p>
                </template>
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Price (₱) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">₱</span>
                    <input type="number" 
                           x-model="price"
                           @blur="validateField('price')"
                           @input="validateField('price')"
                           :class="{'border-red-500 focus:border-red-500 focus:ring-red-500/30': errors.price, 'border-gray-300': !errors.price}"
                           class="w-full h-10 pl-7 pr-3 border rounded-lg text-sm focus:ring-1 outline-none transition-colors [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                           step="0.01"
                           min="0"
                           placeholder="0.00">
                </div>
                <template x-if="errors.price">
                    <p class="text-xs text-red-500 mt-1">Please enter a valid price</p>
                </template>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-100 mt-6">
                <button type="button"
                        @click="$dispatch('close-modal', 'add-product-modal')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors">
                    Cancel
                </button>
                <button type="button"
                        @click="submitForm()"
                        :disabled="!isFormValid"
                        :class="isFormValid ? 'bg-[#FF0059] hover:bg-[#E0004D] cursor-pointer' : 'bg-gray-300 cursor-not-allowed'"
                        class="px-4 py-2 text-sm font-medium text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0059]/50 transition-colors">
                    Add Product
                </button>
            </div>
        </form>
    </div>
</x-modal>