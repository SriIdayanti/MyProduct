<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

     <script src="https://cdn.tailwindcss.com"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pO1e3gGcwRYKh5AVzFvZ+uGhZwrFUEH8EBK5RtX7T6VoQBB3uEnY6KZmfTfJAwR5dGz0sFMbUM0HlVZl8tkQ6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font Awesome (ikon mata) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<style>
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #6b7280; /* Tailwind gray-500 */
    }
</style>
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-r from-blue-100 to-blue-300">

    <div class="bg-white rounded-2xl shadow-lg flex flex-col md:flex-row max-w-4xl w-full overflow-hidden">
        <!-- Bagian Kiri (Ilustrasi Video) -->
        <div class="hidden md:flex items-center justify-center w-1/2 bg-blue-200 p-5">
            <video class="w-full max-w-xs rounded-lg shadow-md" autoplay loop muted>
                <source src="https://v1.pinimg.com/videos/mc/720p/6e/c7/2e/6ec72ed5b020281c4469cac3f72017ac.mp4" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
        </div>

        <!-- Bagian Kanan (Form Login) -->
        <div class="w-full md:w-1/2 p-10">
            <h2 class="text-3xl font-bold text-blue-700 mb-2 text-center">Login</h2>
            <p class="text-gray-600 mb-6 text-center">Selamat datang! Silakan masuk untuk melanjutkan.</p>
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 mb-1">Email:</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <button type="button" onclick="togglePassword()" class="password-toggle">
                        <i id="toggleIcon" class="fas fa-eye"></i>
                    </button>
                </div>

                <!-- Tombol Login -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Masuk
                </button>
            </form>

            <!-- Link ke register -->
            <div class="mt-4 text-center">
                <p class="text-gray-600">Belum punya akun?
                    <a href="/register" class="text-blue-600 font-semibold hover:underline">Daftar</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Script Toggle Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

    <!-- SweetAlert Flash -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif


</body>
</html>
