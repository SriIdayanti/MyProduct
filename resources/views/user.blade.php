<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaryaKU - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200 px-4 py-3 shadow-sm sticky top-0 z-10">
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-primary-600 text-2xl font-bold">KaryaKU</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('upload.create') }}" 
                       class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition flex items-center space-x-2">
                       <i class="fas fa-upload text-sm"></i>
                       <span>Upload Produk</span>
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-primary-600 focus:outline-none">
                            <img src="https://i.pinimg.com/736x/9e/83/75/9e837528f01cf3f42119c5aeeed1b336.jpg" 
                                 class="w-8 h-8 rounded-full border-2 border-primary-500" alt="Profile">
                            <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <div x-show="open" 
                             @click.away="open = false" 
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-20"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100">
                        

                          
                            <div class="border-t border-gray-100 my-1"></div>
                            <button id="logoutButton" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Logout Form (Hidden) -->
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-6 flex-grow">
            <!-- Welcome & Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex flex-col items-center">
                        <img src="https://i.pinimg.com/736x/9e/83/75/9e837528f01cf3f42119c5aeeed1b336.jpg" 
                             class="w-20 h-20 rounded-full border-4 border-primary-100" alt="Profile">
                        <h2 class="text-lg font-semibold mt-4">{{ Auth::user()->name }}</h2>
                        <span class="text-sm px-3 py-1 bg-primary-100 text-primary-700 rounded-full mt-2">{{ Auth::user()->role }}</span>
                        
                        <div class="w-full mt-4 pt-4 border-t border-gray-100">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Produk Saya</span>
                                <span class="font-medium">{{ count($uploads) }}</span>
                            </div>
                            <div class="flex justify-between text-sm mt-2">
                                <span class="text-gray-500">Status Aktif</span>
                                <span class="font-medium">{{ $uploads->where('status', 'Aktif')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Welcome Message -->
                <div class="lg:col-span-2 bg-gradient-to-r from-primary-600 to-primary-500 rounded-xl shadow-sm p-6 text-white flex items-center">
                    <div>
                        <h2 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h2>
                        <p class="mt-2 opacity-90">Tunjukkan kreativitas terbaikmu! Upload produk hasil karyamu dan raih apresiasi atas inovasi yang kamu ciptakan.</p>
                        <div class="mt-4 flex space-x-3">
                            <a href="{{ route('upload.create') }}" class="inline-flex items-center px-4 py-2 bg-white text-primary-600 rounded-lg font-medium hover:bg-primary-50 transition">
                                <i class="fas fa-plus mr-2"></i> Tambah Produk
                            </a>
                           
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Section -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Produk Saya</h3>
                    
                </div>
                
                @if(count($uploads) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($uploads as $upload)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition duration-300 hover:shadow-md">
                        <div class="relative">
                            <img src="{{ $upload->image ? asset('images/' . $upload->image) : 'https://via.placeholder.com/300x200' }}" 
                                 alt="Gambar Produk" class="w-full h-48 object-cover">
                            <div class="absolute top-3 right-3">
                                <span class="px-2 py-1 text-xs font-medium text-white rounded-lg {{ $upload->status == 'Aktif' ? 'bg-green-500' : 'bg-gray-500' }}">
                                    {{ $upload->status }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-primary-600 bg-primary-50 px-2 py-1 rounded-full">{{ $upload->kategoriproduk }}</span>
                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($upload->tanggaldibuat)->format('d M Y') }}</span>
                            </div>
                            
                            <h5 class="text-lg font-semibold text-gray-800 mb-2 truncate">{{ $upload->namaproduk }}</h5>
                            
                            <div class="flex justify-between items-center mt-4">
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="text-gray-700 hover:text-primary-600 focus:outline-none">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    
                                    <div x-show="open" 
                                         @click.away="open = false" 
                                         class="absolute bottom-0 left-0 mb-8 w-36 bg-white rounded-lg shadow-lg py-2 z-20"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="opacity-0 transform scale-95"
                                         x-transition:enter-end="opacity-100 transform scale-100">
                                        <a href="{{ route('upload.show', $upload->uploadID) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50">
                                            <i class="fas fa-eye mr-2"></i> Lihat
                                        </a>
                                        <a href="{{ route('upload.edit', $upload->uploadID) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </a>
                                        <form action="{{ route('upload.destroy', $upload->uploadID) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                <i class="fas fa-trash mr-2"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <a href="{{ route('upload.show', $upload->uploadID) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700">
                                    <span class="text-sm">Detail</span>
                                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-box-open text-primary-500 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-medium text-gray-800 mb-2">Belum ada produk</h4>
                        <p class="text-gray-500 mb-6">Anda belum mengunggah produk apapun. Mulai bagikan karya Anda sekarang!</p>
                        <a href="{{ route('upload.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition">
                            <i class="fas fa-plus mr-2"></i> Tambah Produk Pertama
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="mt-auto bg-white border-t border-gray-200 py-4">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-500 text-sm mb-2 md:mb-0">
                        &copy; 2025 KaryaKU. Hak Cipta Dilindungi.
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-primary-600">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary-600">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary-600">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.getElementById('logoutButton').addEventListener('click', function (event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logoutForm').submit();
            }
        });
    </script>
</body>
</html>