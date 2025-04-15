<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar dengan Iconify</title>
    <!-- Load Iconify -->
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <!-- Load CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .collapsed {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body>
    <aside class="left-sidebar" id="sidebar">
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index.html" class="text-nowrap logo-img">
                    <img src="../assets/images/logos/logomp.png" alt="" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <span class="iconify" data-icon="ti:x" data-inline="false"></span>
                </div>
            </div>

            <!-- Sidebar navigation -->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <span class="iconify" data-icon="ti:dots" data-inline="false"></span>
                        <span class="hide-menu">Home</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                            <span class="iconify" data-icon="solar:home-smile-bold-duotone" data-inline="false"></span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                        <span class="iconify" data-icon="ti:dots" data-inline="false"></span>
                        <span class="hide-menu">Form</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('penilaian.index') }}" aria-expanded="false">
                            <span class="iconify" data-icon="solar:danger-circle-bold-duotone" data-inline="false"></span>
                            <span class="hide-menu">Penilaian</span>
                        </a>
                    </li>

                    @if(auth()->user()->role == 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('petugas.index') }}" aria-expanded="false">
                            <span class="iconify" data-icon="solar:file-text-bold-duotone" data-inline="false"></span>
                            <span class="hide-menu">Petugas</span>
                        </a>
                    </li>
                    @endif

                    <!-- Logout -->
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false">
                            <span class="iconify" data-icon="solar:logout-2-bold-duotone" data-inline="false"></span>
                            <span class="hide-menu">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
    </aside>

    <!-- Load JavaScript -->
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function(event) {
            event.stopPropagation();
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>
</body>
</html>
