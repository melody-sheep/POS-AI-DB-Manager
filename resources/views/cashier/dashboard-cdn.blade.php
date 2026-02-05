<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS AI-POWERED - Cashier</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- AlpineJS for dropdowns -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome for icons (optional alternative) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Custom styles */
        body {
            margin: 0;
            padding: 0;
            background: white;
            overflow: auto;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        /* Main container */
        .main-container {
            width: 100%;
            min-width: 1440px;
            max-width: 1920px;
            min-height: 1024px;
            margin: 0 auto;
            background: white;
            padding-left: 40px;
            padding-right: 40px;
            box-sizing: border-box;
        }
        
        /* Header stays fixed to left */
        .header-container {
            padding-top: 24px;
            position: relative;
            left: 40px;
            width: calc(100% - 80px);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Header content (logo and title) */
        .header-left-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        /* Header right content (icons) */
        .header-right-content {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        
        /* Tab container */
        .tab-container {
            position: relative;
            left: 40px;
            width: calc(100% - 80px);
            max-width: 1361px;
            height: 80px;
            border: 3px solid #FFC5D9;
            background: white;
            border-radius: 8px;
            margin-top: 40px;
            display: flex;
            align-items: center;
            padding: 0 40px;
        }
        
        /* Logo */
        .logo-responsive {
            flex-shrink: 0;
            transition: all 0.3s ease;
        }
        
        /* Logo color */
        .logo-triangle {
            stroke: #484545;
        }
        
        /* Header text */
        .title-responsive {
            font-weight: bold;
            color: #484545;
            white-space: nowrap;
            transition: all 0.3s ease;
        }
        
        /* Notification Bell Icon */
        .notification-bell {
            color: #484545;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .notification-bell:hover {
            color: #333;
            transform: scale(1.05);
        }
        
        /* Profile Icon */
        .profile-icon {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .profile-icon-circle {
            width: 40px;
            height: 40px;
            background-color: #f3f4f6;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        
        .profile-icon-circle:hover {
            background-color: #e5e7eb;
            border-color: #9ca3af;
        }
        
        /* Dropdowns */
        .dropdown-content {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }
        
        /* Navigation Tabs Styles */
        .nav-tabs {
            display: flex;
            width: 100%;
            height: 100%;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        
        /* First column - Food items */
        .nav-column-1 {
            display: flex;
            align-items: center;
            gap: 60px;
            height: 100%;
        }
        
        /* Second column - Orders/Log */
        .nav-column-2 {
            display: flex;
            align-items: center;
            gap: 60px;
            height: 100%;
        }
        
        /* Vertical separator line - 3px with pink color and rounded edges */
        .vertical-separator {
            width: 3px;
            height: 57px;
            background-color: #FFC5D9;
            border-radius: 3px; /* Rounded edges */
            margin: 0 50px;
        }
        
        /* Tab item */
        .tab-item {
            height: 100%;
            display: flex;
            align-items: center;
            position: relative;
            cursor: pointer;
            user-select: none;
            padding: 0 5px;
        }
        
        /* Tab text - 30px font */
        .tab-text {
            font-size: 30px;
            font-weight: 500;
            color: #484545;
            opacity: 0.7;
            transition: opacity 0.2s ease;
            white-space: nowrap;
        }
        
        /* Active tab text */
        .tab-item.active .tab-text {
            opacity: 1;
            font-weight: 600;
        }
        
        /* Moving indicator container */
        .indicator-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            z-index: 1;
        }
        
        /* Moving indicator - QUICK animation */
        .moving-indicator {
            position: absolute;
            bottom: 0;
            height: 4px;
            background-color: #FFC5D9;
            border-radius: 2px 2px 0 0;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); /* Fast animation */
        }
        
        /* Hover effects */
        .tab-item:hover .tab-text {
            opacity: 0.85;
        }
        
        /* Media queries for responsive font sizing */
        @media (max-width: 1600px) {
            .tab-text {
                font-size: 28px;
            }
            .nav-column-1,
            .nav-column-2 {
                gap: 50px;
            }
            .vertical-separator {
                margin: 0 40px;
            }
        }
        
        @media (max-width: 1400px) {
            .tab-text {
                font-size: 26px;
            }
            .nav-column-1,
            .nav-column-2 {
                gap: 40px;
            }
            .vertical-separator {
                margin: 0 35px;
                height: 52px;
            }
            .tab-container {
                padding: 0 35px;
                height: 75px;
            }
        }
        
        @media (max-width: 1200px) {
            .tab-text {
                font-size: 24px;
            }
            .nav-column-1,
            .nav-column-2 {
                gap: 35px;
            }
            .vertical-separator {
                margin: 0 30px;
                height: 48px;
            }
            .tab-container {
                padding: 0 30px;
                height: 70px;
            }
        }
        
        @media (max-width: 1000px) {
            .main-container {
                padding-left: 35px;
                padding-right: 35px;
            }
            .header-container {
                left: 35px;
                width: calc(100% - 70px);
            }
            .tab-container {
                left: 35px;
                width: calc(100% - 70px);
                height: 65px;
                padding: 0 25px;
                max-width: 1100px;
            }
            .tab-text {
                font-size: 22px;
            }
            .nav-column-1,
            .nav-column-2 {
                gap: 30px;
            }
            .vertical-separator {
                margin: 0 25px;
                height: 44px;
            }
            .moving-indicator {
                height: 3px;
            }
        }
        
        @media (max-width: 900px) {
            .main-container {
                padding-left: 30px;
                padding-right: 30px;
                min-width: 100%;
            }
            .header-container {
                left: 30px;
                width: calc(100% - 60px);
            }
            .tab-container {
                left: 30px;
                width: calc(100% - 60px);
                height: 60px;
                padding: 0 20px;
            }
            .tab-text {
                font-size: 20px;
            }
            .nav-column-1,
            .nav-column-2 {
                gap: 25px;
            }
            .vertical-separator {
                margin: 0 20px;
                height: 40px;
            }
            .moving-indicator {
                height: 3px;
            }
        }
        
        @media (max-width: 768px) {
            .header-right-content {
                gap: 16px;
            }
            .profile-icon-circle {
                width: 36px;
                height: 36px;
            }
            .tab-container {
                flex-direction: column;
                height: auto;
                padding: 20px;
            }
            .nav-tabs {
                flex-direction: column;
                gap: 25px;
                width: 100%;
            }
            .nav-column-1,
            .nav-column-2 {
                width: 100%;
                justify-content: center;
                gap: 25px;
            }
            .vertical-separator {
                width: 80%;
                height: 3px;
                margin: 15px 0;
                border-radius: 3px;
            }
            .indicator-container {
                display: none;
            }
            .tab-item::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 100%;
                height: 3px;
                background-color: #FFC5D9;
                border-radius: 1.5px;
                transform: scaleX(0);
                transition: transform 0.2s ease;
            }
            .tab-item.active::after {
                transform: scaleX(1);
            }
        }
        
        @media (max-width: 600px) {
            .tab-text {
                font-size: 18px;
            }
            .nav-column-1,
            .nav-column-2 {
                gap: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .tab-text {
                font-size: 16px;
            }
            .nav-column-1,
            .nav-column-2 {
                gap: 15px;
            }
        }
    </style>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pink-border': '#FFC5D9',
                        'custom-gray': '#484545',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white">
    <!-- Main Container -->
    <div class="main-container">
        <!-- Header Section -->
        <div class="header-container">
            <!-- Left side: Logo and Title -->
            <div class="header-left-content">
                <!-- Triangle Logo -->
                <div class="logo-responsive">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet">
                        <polygon points="50,15 85,75 15,75" fill="none" stroke="#484545" stroke-width="6" class="logo-triangle" />
                    </svg>
                </div>

                <!-- Header Text -->
                <h1 class="title-responsive">
                    Cashier Bakery & Cafe POS
                </h1>
            </div>

            <!-- Right side: Notification Bell and Profile Icon -->
            <div class="header-right-content" x-data="{ 
                notificationOpen: false, 
                profileOpen: false,
                notifications: [
                    { id: 1, type: 'info', title: 'System Update', message: 'System is running smoothly', time: '2 hours ago', read: true },
                    { id: 2, type: 'warning', title: 'Low Inventory', message: 'Bread stock is running low', time: '5 hours ago', read: false },
                    { id: 3, type: 'success', title: 'New Order', message: 'Order #1234 has been placed', time: '1 day ago', read: true }
                ],
                unreadCount: 1
            }">
                <!-- Notification Bell Icon with Dropdown -->
                <div class="relative" x-on:click.outside="notificationOpen = false">
                    <button 
                        x-on:click="notificationOpen = !notificationOpen"
                        class="notification-bell relative p-2 rounded-full hover:bg-gray-100"
                        aria-label="Notifications"
                    >
                        <!-- Bell Icon -->
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        
                        <!-- Notification Badge (shows unread count) -->
                        <span 
                            x-show="unreadCount > 0"
                            x-text="unreadCount"
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"
                        ></span>
                    </button>
                    
                    <!-- Notification Dropdown -->
                    <div 
                        x-show="notificationOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50 dropdown-content"
                        style="display: none;"
                    >
                        <div class="py-2">
                            <!-- Notification Header -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-800">Notifications</h3>
                                <p class="text-sm text-gray-500">
                                    <span x-text="unreadCount"></span> unread notification<span x-show="unreadCount !== 1">s</span>
                                </p>
                            </div>
                            
                            <!-- Notification Items -->
                            <div class="max-h-64 overflow-y-auto">
                                <template x-for="notification in notifications" :key="notification.id">
                                    <div 
                                        class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 cursor-pointer"
                                        :class="{ 'bg-blue-50': !notification.read }"
                                        x-on:click="notification.read = true; unreadCount = Math.max(0, unreadCount - 1)"
                                    >
                                        <div class="flex items-start">
                                            <!-- Notification Icon -->
                                            <div class="flex-shrink-0">
                                                <div 
                                                    class="w-8 h-8 rounded-full flex items-center justify-center"
                                                    :class="{
                                                        'bg-blue-100': notification.type === 'info',
                                                        'bg-yellow-100': notification.type === 'warning',
                                                        'bg-green-100': notification.type === 'success'
                                                    }"
                                                >
                                                    <svg 
                                                        class="w-4 h-4" 
                                                        :class="{
                                                            'text-blue-600': notification.type === 'info',
                                                            'text-yellow-600': notification.type === 'warning',
                                                            'text-green-600': notification.type === 'success'
                                                        }" 
                                                        fill="none" 
                                                        stroke="currentColor" 
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <template x-if="notification.type === 'info'">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </template>
                                                        <template x-if="notification.type === 'warning'">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                        </template>
                                                        <template x-if="notification.type === 'success'">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </template>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <!-- Notification Content -->
                                            <div class="ml-3 flex-1">
                                                <p class="text-sm font-medium text-gray-900" x-text="notification.title"></p>
                                                <p class="text-xs text-gray-500" x-text="notification.message"></p>
                                                <p class="text-xs text-gray-400 mt-1" x-text="notification.time"></p>
                                            </div>
                                            
                                            <!-- Unread Dot -->
                                            <div x-show="!notification.read" class="flex-shrink-0">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                
                                <!-- Empty State -->
                                <div x-show="notifications.length === 0" class="px-4 py-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No notifications</h3>
                                    <p class="mt-1 text-sm text-gray-500">You're all caught up!</p>
                                </div>
                            </div>
                            
                            <!-- Notification Footer -->
                            <div class="px-4 py-3 border-t border-gray-100">
                                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium block text-center">
                                    View all notifications
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Icon with Dropdown -->
                <div class="relative" x-on:click.outside="profileOpen = false">
                    <button 
                        x-on:click="profileOpen = !profileOpen"
                        class="profile-icon"
                        aria-label="User Profile"
                    >
                        <div class="profile-icon-circle">
                            <!-- User Icon -->
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </button>
                    
                    <!-- Profile Dropdown -->
                    <div 
                        x-show="profileOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 dropdown-content"
                        style="display: none;"
                    >
                        <div class="py-1">
                            <!-- User Info -->
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">Cashier User</p>
                                <p class="text-xs text-gray-500">cashier@example.com</p>
                            </div>
                            
                            <!-- Profile Link -->
                            <a 
                                href="/profile" 
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            
                            <!-- Settings Link -->
                            <a 
                                href="#" 
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </a>
                            
                            <!-- Logout Link -->
                            <a 
                                href="/logout" 
                                class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 flex items-center border-t border-gray-100"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </a>
                            
                            <!-- Hidden logout form for Laravel -->
                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Section -->
        <div class="tab-container">
            <!-- Navigation Tabs -->
            <div class="nav-tabs">
                <!-- Moving indicator container -->
                <div class="indicator-container">
                    <div class="moving-indicator"></div>
                </div>
                
                <!-- First Column: Breads, Cakes, Beverages -->
                <div class="nav-column-1">
                    <div class="tab-item active" data-tab="breads">
                        <span class="tab-text">Breads</span>
                    </div>
                    <div class="tab-item" data-tab="cakes">
                        <span class="tab-text">Cakes</span>
                    </div>
                    <div class="tab-item" data-tab="beverages">
                        <span class="tab-text">Beverages</span>
                    </div>
                </div>
                
                <!-- Vertical Separator - 3px pink with rounded edges -->
                <div class="vertical-separator"></div>
                
                <!-- Second Column: Ongoing Orders, Today's Log -->
                <div class="nav-column-2">
                    <div class="tab-item" data-tab="ongoing-orders">
                        <span class="tab-text">Ongoing Orders</span>
                    </div>
                    <div class="tab-item" data-tab="todays-log">
                        <span class="tab-text">Today's Log</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Active Tab Display -->
        <div class="fixed bottom-4 right-4 bg-gray-100 p-3 rounded text-sm opacity-75">
            <div class="font-semibold text-custom-gray">Active Tab:</div>
            <div id="active-tab-name" class="text-lg font-bold">Breads</div>
        </div>
    </div>
    
    <script>
        // Navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get all tab items
            const tabItems = document.querySelectorAll('.tab-item');
            const indicator = document.querySelector('.moving-indicator');
            const indicatorContainer = document.querySelector('.indicator-container');
            
            // Set default active tab (Breads)
            setActiveTab('breads', true);
            
            // Add click event to each tab
            tabItems.forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    setActiveTab(tabId, false);
                });
            });
            
            function setActiveTab(tabId, initial = false) {
                // Remove active class from all tabs
                tabItems.forEach(tab => {
                    tab.classList.remove('active');
                });
                
                // Add active class to clicked tab
                const activeTab = document.querySelector(`[data-tab="${tabId}"]`);
                if (activeTab) {
                    activeTab.classList.add('active');
                    
                    // Move the indicator with QUICK animation
                    moveIndicator(activeTab, initial);
                    
                    // Dispatch custom event for other components to listen to
                    const event = new CustomEvent('tabChanged', { 
                        detail: { tabId: tabId, tabName: getTabName(tabId) }
                    });
                    window.dispatchEvent(event);
                }
            }
            
            function moveIndicator(tab, initial = false) {
                if (!indicator || !indicatorContainer) return;
                
                const tabRect = tab.getBoundingClientRect();
                const containerRect = indicatorContainer.getBoundingClientRect();
                
                // Calculate position relative to indicator container
                const leftPosition = tabRect.left - containerRect.left;
                const tabWidth = tabRect.width;
                
                if (initial) {
                    // Set initial position without animation
                    indicator.style.left = leftPosition + 'px';
                    indicator.style.width = tabWidth + 'px';
                } else {
                    // QUICK animation to new position
                    indicator.style.transition = 'all 0.25s cubic-bezier(0.4, 0, 0.2, 1)';
                    indicator.style.left = leftPosition + 'px';
                    indicator.style.width = tabWidth + 'px';
                }
            }
            
            function getTabName(tabId) {
                const tabNames = {
                    'breads': 'Breads',
                    'cakes': 'Cakes',
                    'beverages': 'Beverages',
                    'ongoing-orders': 'Ongoing Orders',
                    'todays-log': "Today's Log"
                };
                return tabNames[tabId] || tabId;
            }
            
            // Update indicator position on resize
            window.addEventListener('resize', function() {
                const activeTab = document.querySelector('.tab-item.active');
                if (activeTab) {
                    moveIndicator(activeTab, true);
                }
            });
        });
        
        // Update active tab display
        window.addEventListener('tabChanged', function(e) {
            const activeTabDisplay = document.getElementById('active-tab-name');
            if (activeTabDisplay) {
                activeTabDisplay.textContent = e.detail.tabName;
            }
        });
        
        // Responsive scaling for header
        document.addEventListener('DOMContentLoaded', function() {
            const logo = document.querySelector('.logo-responsive');
            const title = document.querySelector('.title-responsive');
            
            function updateSizes() {
                const screenWidth = window.innerWidth;
                
                if (screenWidth >= 1440) {
                    const scaleFactor = (screenWidth - 1440) / 100;
                    const logoSize = 48 + Math.min(scaleFactor * 1, 8);
                    const textSize = 40 + Math.min(scaleFactor * 0.75, 6);
                    
                    if (logo) {
                        logo.style.width = logoSize + 'px';
                        logo.style.height = logoSize + 'px';
                    }
                    if (title) {
                        title.style.fontSize = textSize + 'px';
                    }
                } else if (screenWidth < 1440 && screenWidth > 600) {
                    const scaleFactor = (1440 - screenWidth) / 100;
                    const logoSize = Math.max(48 - scaleFactor * 2, 28);
                    const textSize = Math.max(40 - scaleFactor * 2, 18);
                    
                    if (logo) {
                        logo.style.width = logoSize + 'px';
                        logo.style.height = logoSize + 'px';
                    }
                    if (title) {
                        title.style.fontSize = textSize + 'px';
                    }
                }
            }
            
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(updateSizes, 50);
            });
            
            updateSizes();
        });
    </script>
</body>
</html>