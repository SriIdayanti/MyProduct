<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: gray;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    
        .video-container video {
            width: 100%;
            max-width: 320px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        body {
    background: linear-gradient(to right, #c2e9fb, #a1c4fd);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
:root {
            --primary-color: #4361ee;
            --primary-hover: #3a56d4;
            --light-bg: #f8fafc;
            --border-radius: 12px;
            --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background: linear-gradient(135deg, #c2e9fb 0%, #a1c4fd 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .main-container {
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            width: 90%;
            max-width: 1000px;
        }

        .row {
            margin: 0;
        }
        
        .video-side {
            background: linear-gradient(135deg, #4361ee 0%, #3a56d4 100%);
            padding: 0;
            height: 100%;
            position: relative;
        }
        
        .video-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 30px;
        }
        
        .video-container video {
            width: 100%;
            max-width: 400px;
            border-radius: var(--border-radius);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .form-side {
            padding: 0;
        }
        
        .register-box {
            padding: 40px;
            height: 100%;
        }
        
        .form-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }
        
        /* Perbaikan untuk password container */
        .password-container {
            position: relative;
        }
        
        /* Perbaikan untuk password toggle icon */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: calc(50% + 13px); /* Penyesuaian untuk posisi yang lebih tepat */
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            border: none;
            padding: 0;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }
        
        .gender-container {
            display: flex;
            gap: 20px;
        }
        
        .gender-option {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .gender-option.active {
            border-color: var(--primary-color);
            background-color: rgba(67, 97, 238, 0.1);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .login-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
        
        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            color: #495057;
        }
        
        .form-label {
            font-weight: 500;
        }
        
        @media (max-width: 767.98px) {
            .main-container {
                max-width: 500px;
            }
            
            .register-box {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    

            <!-- Form Register -->
            <div class="col-md-6">
                <div class="register-box">
                    <h3 class="text-center text-primary mb-4">Register</h3>
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input id="name" type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Telepon</label>
                            <input id="phone" type="number" class="form-control" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input type="radio" class="form-check-input" name="jenis_kelamin" id="laki-laki" value="laki-laki" required>
                                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="jenis_kelamin" id="perempuan" value="perempuan" required>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-4 password-container">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Minimal 8 karakter" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password')" tabindex="-1">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>

                        <div class="mb-4 password-container">
                            <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Masukkan password yang sama" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')" tabindex="-1">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>

                        <div class="text-center mt-3">
                            <small>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var passwordToggle = document.querySelector('.password-toggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
