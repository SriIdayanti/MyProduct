<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Simple navbar styling */
        .app-header {
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
        }

        .navbar {
            padding: 10px 20px;
        }

        /* Simple notification dot */
        .notification {
            width: 8px;
            height: 8px;
            background-color: #0d6efd;
            position: absolute;
            top: 10px;
            right: 10px;
            border-radius: 50%;
        }

        /* Profile image */
        .profile-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Dropdown menu */
        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        /* Content container */
        .content-container {
            margin-top: 80px;
            padding: 20px;
        }

        /* Responsive adjustment */
        @media (max-width: 768px) {
            .content-container {
                margin-top: 70px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- Mobile menu toggle -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Left side items -->
                <ul class="navbar-nav d-flex flex-row">
                    <!-- Notification icon -->
                    <li class="nav-item position-relative mx-2">
                        <a class="nav-link" href="#">
                           
                        </a>
                    </li>
                </ul>
                
                <!-- Right side items -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <!-- Profile dropdown -->
                        <a class="navbar-brand ms-2" href="#">
      <img src="../assets/images/logos/logomp.png" alt="Logo" style="height: 30px;">
      
    </a>
                           
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
