<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Laravel Blog</title>
</head>
<body>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @yield('content')
</body>
</html>