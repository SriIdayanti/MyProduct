<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyProduct | Premium Product </title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#3b82f6',
            secondary: '#f59e0b',
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
        }
      }
    }
  </script>
</head>

<body class="font-sans">
  <!-- Main Content -->
  <main class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-50">
      <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
          <a class="flex items-center font-bold text-2xl italic" href="#">
            <span class="text-blue-500">Karya</span>
            <span class="text-amber-500">Ku</span>
          </a>
          
          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button id="menu-toggle" class="focus:outline-none">
              <i class="fas fa-bars text-gray-600"></i>
            </button>
          </div>
          
          <!-- Desktop Navigation -->
          <div class="hidden md:flex items-center space-x-6">
            <ul class="flex space-x-6">
              <li><a class="text-gray-700 hover:text-blue-500 font-medium transition-colors" href="/login">Login</a></li>
            </ul>
            <a href="/register" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transition duration-300">Register</a>
          </div>
        </div>
        
        <!-- Mobile Navigation (Hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-2">
          <ul class="flex flex-col space-y-3">
            <li><a class="block text-gray-700 hover:text-blue-500 font-medium" href="/login">Login</a></li>
            <li class="mt-2">
              <a href="/register" class="block text-center bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transition duration-300">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section with Full Background -->
    <section class="relative min-h-screen flex items-center overflow-hidden">
  <!-- Improved layered background with modern gradient overlay -->
  <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-indigo-900/80 z-0"></div>

  
  <!-- Animated shapes for modern look (optional) -->
  <div class="absolute top-0 right-0 -mr-16 transform rotate-45 opacity-10 z-0">
    <div class="w-96 h-96 rounded-full bg-blue-400"></div>
  </div>
  <div class="absolute bottom-0 left-0 -ml-16 transform -rotate-45 opacity-10 z-0">
    <div class="w-64 h-64 rounded-full bg-indigo-300"></div>
  </div>
  
  <div class="container mx-auto px-6 lg:px-8 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <div class="text-center md:text-left">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight text-white mb-6 animate-fade-in-up">
            🌟Temukan,Ajukan <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-indigo-300">Produk</span> Terbaik di Karyaku
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-xl animate-fade-in-up animation-delay-200">
                KaryaKu adalah platform yang memungkinkan Anda untuk menjelajahi, menyimpan,  berbagai produk yang tersedia di SMK Informatika Utama. Dapatkan informasi mengenai kualitas setiap produk dan berikan penilaian Anda untuk membantu evaluasi produk tersebut.
            </p>


        
        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start animate-fade-in-up animation-delay-400">
    @auth
        <a href="{{ route('upload.create') }}" class="group relative px-8 py-4 rounded-full font-medium text-center transition-all duration-300 overflow-hidden">
    @else
        <a href="{{ route('login') }}" class="group relative px-8 py-4 rounded-full font-medium text-center transition-all duration-300 overflow-hidden">
    @endauth
        <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 transition-all duration-300 group-hover:from-blue-600 group-hover:to-indigo-700"></span>
        <span class="relative flex items-center justify-center text-white gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Ajukan Product
        </span>
    </a>


          
          <div class="relative mt-4 sm:mt-0 group">
           
          </div>
        </div>
      </div>
      
      <!-- Added a floating product showcase (can be replaced with actual product image) -->
      <div class="hidden md:flex justify-center items-center">
        <div class="relative w-full max-w-md">
          <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-indigo-500/20 rounded-xl blur-xl"></div>
          <div class="relative bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-6 shadow-2xl animate-float">
            <div class="grid grid-cols-2 gap-4">
              <div class="bg-white/80 p-4 rounded-lg shadow-sm">
                <div class="h-24 bg-blue-100 rounded mb-3"></div>
                <div class="h-3 bg-gray-200 rounded mb-2"></div>
                <div class="h-3 w-2/3 bg-gray-200 rounded"></div>
              </div>
              <div class="bg-white/80 p-4 rounded-lg shadow-sm">
                <div class="h-24 bg-indigo-100 rounded mb-3"></div>
                <div class="h-3 bg-gray-200 rounded mb-2"></div>
                <div class="h-3 w-2/3 bg-gray-200 rounded"></div>
              </div>
              <div class="bg-white/80 p-4 rounded-lg shadow-sm">
                <div class="h-24 bg-purple-100 rounded mb-3"></div>
                <div class="h-3 bg-gray-200 rounded mb-2"></div>
                <div class="h-3 w-2/3 bg-gray-200 rounded"></div>
              </div>
              <div class="bg-white/80 p-4 rounded-lg shadow-sm">
                <div class="h-24 bg-teal-100 rounded mb-3"></div>
                <div class="h-3 bg-gray-200 rounded mb-2"></div>
                <div class="h-3 w-2/3 bg-gray-200 rounded"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modern subtle wave pattern at bottom -->
  <div class="absolute bottom-0 left-0 right-0 z-0 opacity-30">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
      <path fill="#ffffff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,208C1248,171,1344,117,1392,90.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
  </div>
</section>

<!-- Add these CSS animations to your stylesheet -->
<style>
  .animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
  }
  
  .animation-delay-200 {
    animation-delay: 0.2s;
  }
  
  .animation-delay-400 {
    animation-delay: 0.4s;
  }
  
  .animate-float {
    animation: float 6s ease-in-out infinite;
  }
  
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  @keyframes float {
    0% {
      transform: translateY(0px);
    }
    50% {
      transform: translateY(-20px);
    }
    100% {
      transform: translateY(0px);
    }
  }
</style>

    <!-- Section: Product List with Enhanced Cards -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center mb-4">Karya Unggulan</h2>
<p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Jelajahi koleksi karya unggulan dari siswa-siswi SMK Informatika Utama yang menampilkan kreativitas, inovasi, dan dedikasi. Setiap karya dipilih dengan cermat untuk mencerminkan standar kualitas tinggi dan semangat belajar yang luar biasa.</p>

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
  @forelse($uploads as $upload)
    <div class="group relative overflow-hidden rounded-2xl shadow-xl bg-white transition-all duration-300 hover:-translate-y-2">
      <!-- Ribbon (for new products) -->
      <div class="absolute top-4 right-4 z-10 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">New</div>
      
      <!-- Image with overlay on hover -->
      <div class="relative h-72 overflow-hidden">
        <img 
          src="{{ $upload->image ? asset('images/' . $upload->image) : 'https://via.placeholder.com/300x200' }}" 
          alt="{{ $upload->namaproduk }}" 
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-start p-6">
          <div class="space-y-1 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
            <p class="font-semibold">{{ $upload->kategoriproduk }}</p>
            <p>Created by {{ $upload->name }}</p>
          </div>
        </div>
      </div>
      
      <!-- Content -->
      <div class="p-6">
        <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-blue-600 transition-colors">{{ $upload->namaproduk }}</h3>
        <div class="space-y-1 text-gray-600">
          <p class="flex items-center"><span class="inline-block w-5 mr-2"><i class="fas fa-user text-blue-500"></i></span> {{ $upload->name }}</p>
          <p class="flex items-center"><span class="inline-block w-5 mr-2"><i class="fas fa-tag text-blue-500"></i></span> {{ $upload->kategoriproduk }}</p>
          <p class="flex items-center"><span class="inline-block w-5 mr-2"><i class="fas fa-calendar text-blue-500"></i></span> {{ \Carbon\Carbon::parse($upload->tanggaldibuat)->format('d-m-Y') }}</p>
        </div>
        
        <!-- Action buttons with hover effect -->
        <div class="mt-6 flex space-x-2">
          <a href="{{ route('upload.show', $upload->uploadID) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition">Lihat Detail</a>
        </div>
      </div>
    </div>

          @empty
            <div class="col-span-3 text-center py-20 bg-gray-50 rounded-2xl">
              <div class="bg-white p-8 rounded-full inline-flex items-center justify-center mb-6 shadow-md">
                <i class="fas fa-box-open text-gray-300 text-5xl"></i>
              </div>
              <h3 class="text-2xl font-bold text-gray-700 mb-3">No Products Yet</h3>
              <p class="text-gray-500 text-lg mb-6 max-w-md mx-auto">Be the first to showcase your amazing products to our community!</p>
              <a href="{{ route('upload.create') }}" class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 text-white px-8 py-3 rounded-full font-medium hover:shadow-lg transition duration-300">
                Submit Your Product <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>
          @endforelse
        </div>
      </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <a class="flex items-center font-bold text-2xl italic mb-4" href="#">
              <span class="text-blue-400">Karya</span>
              <span class="text-amber-400">Ku</span>
            </a>
            <p class="text-gray-400"></p>
          </div>
          <div>
            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Products</a></li>
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
            </ul>
          </div>
          <div>
            <h3 class="text-lg font-semibold mb-4">Connect With Us</h3>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
              <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
              <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="mt-4">
              <p class="text-gray-400">Subscribe to our newsletter:</p>
              <div class="mt-2 flex">
                <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-md focus:outline-none text-gray-800 w-full">
                <button class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-r-md transition-colors">
                  <i class="fas fa-paper-plane"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
          <p>© 2025 MyProduct. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </main>

  <!-- Simple JavaScript for Mobile Menu Toggle -->
  <script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
      const mobileMenu = document.getElementById('mobile-menu');
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>