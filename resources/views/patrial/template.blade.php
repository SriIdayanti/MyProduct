<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a class="text-xl font-bold" href="#">DASHBOARD USER</a>
            <div class="space-x-4">
                <a href="#" class="bg-white text-blue-600 px-4 py-2 rounded-lg shadow">Upload Product</a>
                <a href="{{ route('logout') }}" class="hover:underline">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-blue-500 text-white text-center py-16">
        <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('https://source.unsplash.com/1600x900/?technology,blue');"></div>
        <div class="relative z-10">
            <h1 class="text-4xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-lg mt-2">Role: {{ Auth::user()->role }}</p>
        </div>
    </header>
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Content Section -->
   
<p> yyy
</p>
    <!-- Table Section -->
 

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
