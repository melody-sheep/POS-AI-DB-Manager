<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Click to Logout</h1>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="padding: 10px 20px; background: red; color: white;">
            LOGOUT NOW
        </button>
    </form>
    
    <script>
        // Auto-submit after 2 seconds
        setTimeout(() => {
            document.querySelector('form').submit();
        }, 2000);
    </script>
</body>
</html>