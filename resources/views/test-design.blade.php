<!DOCTYPE html>
<html>
<head>
    <title>Test Design</title>
    <style>
        /* Basic dark theme */
        body {
            background: #0f172a;
            color: #e2e8f0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .test-box {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(100, 116, 139, 0.3);
            border-radius: 1rem;
            padding: 2rem;
            max-width: 400px;
            backdrop-filter: blur(10px);
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #8b5cf6, #ec4899);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="test-box">
        <h1 class="text-3xl font-bold mb-4 gradient-text">Test Successful!</h1>
        <p class="mb-6">If you see this with dark background, CSS is working.</p>
        
        <div class="space-y-4">
            <div class="p-3 bg-gray-800 rounded-lg">
                <strong>Test 1:</strong> Dark background ✓
            </div>
            <div class="p-3 bg-gray-800 rounded-lg">
                <strong>Test 2:</strong> Rounded corners ✓
            </div>
            <div class="p-3 bg-gray-800 rounded-lg">
                <strong>Test 3:</strong> Glass effect ✓
            </div>
        </div>
        
        <div class="mt-6 pt-4 border-t border-gray-700">
            <a href="/login" class="block w-full text-center py-2 bg-purple-600 hover:bg-purple-700 rounded-lg transition">
                Go to Login Page
            </a>
        </div>
    </div>
</body>
</html>