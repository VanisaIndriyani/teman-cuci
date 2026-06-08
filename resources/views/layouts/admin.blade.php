<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TemanCuci</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0a192f;
            --navy-light: #112240;
            --blue-light: #3498db;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --topbar-height: 70px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fc;
            overflow-x: hidden;
        }

        .bg-navy { background-color: var(--navy) !important; }
        .text-navy { color: var(--navy) !important; }
        .text-blue-light { color: var(--blue-light) !important; }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--navy);
            color: white;
            transition: var(--transition);
            z-index: 1050;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        #sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        #sidebar .sidebar-header {
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: var(--topbar-height);
        }

        #sidebar.collapsed .sidebar-header h4,
        #sidebar.collapsed .nav-text {
            display: none;
        }

        #sidebar .nav-link {
            color: rgba(255,255,255,0.6);
            padding: 14px 25px;
            margin: 4px 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            transition: var(--transition);
            white-space: nowrap;
        }

        #sidebar .nav-link i {
            font-size: 1.25rem;
            min-width: 30px;
        }

        #sidebar .nav-link:hover, 
        #sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
        }

        #sidebar .nav-link.active {
            background-color: var(--blue-light);
            color: white;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        #sidebar.collapsed .nav-link {
            margin: 4px 10px;
            padding: 14px 0;
            justify-content: center;
        }

        #sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        /* Content Area */
        #content {
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
        }

        #content.expanded {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }

        /* Topbar */
        .topbar {
            height: var(--topbar-height);
            background: white;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.03);
        }

        .toggle-sidebar-btn {
            background: #f8f9fc;
            border: none;
            color: var(--navy);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .toggle-sidebar-btn:hover {
            background: #edf2f7;
            color: var(--blue-light);
        }

        /* Cards and Tables */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: 25px;
        }

        .table thead th {
            background-color: #f8f9fc;
            border-bottom: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 15px;
        }

        .table td {
            padding: 15px;
            vertical-align: middle;
        }

        /* Mobile Adjustments */
        @media (max-width: 992px) {
            #sidebar {
                left: calc(-1 * var(--sidebar-width));
            }
            #sidebar.mobile-show {
                left: 0;
            }
            #content, #content.expanded {
                margin-left: 0;
                width: 100%;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                width: 100vw;
                height: 100vh;
                background: rgba(0,0,0,0.4);
                z-index: 1040;
                top: 0;
                left: 0;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }

        /* Custom Scrollbar for Sidebar */
        #sidebar::-webkit-scrollbar {
            width: 5px;
        }
        #sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="text-white fw-800 m-0"><i class="bi bi-water text-blue-light"></i> TemanCuci</h4>
        </div>
        
        <div class="mt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2"></i>
                        <span class="nav-text ms-2">Dashboard</span>
                    </a>
                </li>
                <div class="px-4 py-2 small text-uppercase fw-bold opacity-50 nav-text" style="font-size: 0.7rem;">Sistem Pakar</div>
                <li class="nav-item">
                    <a href="{{ route('admin.rbf.index') }}" class="nav-link {{ request()->routeIs('admin.rbf.*') ? 'active' : '' }}">
                        <i class="bi bi-diagram-3"></i>
                        <span class="nav-text ms-2">Aturan RBF</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.saw.index') }}" class="nav-link {{ request()->routeIs('admin.saw.*') ? 'active' : '' }}">
                        <i class="bi bi-calculator"></i>
                        <span class="nav-text ms-2">Bobot SAW</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.saw-scores.index') }}" class="nav-link {{ request()->routeIs('admin.saw-scores.*') ? 'active' : '' }}">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <span class="nav-text ms-2">Sub Kriteria SAW</span>
                    </a>
                </li>
                <div class="px-4 py-2 small text-uppercase fw-bold opacity-50 nav-text" style="font-size: 0.7rem;">Konten</div>
                <li class="nav-item">
                    <a href="{{ route('admin.washing-steps.index') }}" class="nav-link {{ request()->routeIs('admin.washing-steps.*') ? 'active' : '' }}">
                        <i class="bi bi-list-check"></i>
                        <span class="nav-text ms-2">Langkah Cuci</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.detergents.index') }}" class="nav-link {{ request()->routeIs('admin.detergents.*') ? 'active' : '' }}">
                        <i class="bi bi-droplet"></i>
                        <span class="nav-text ms-2">Deterjen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.tips.index') }}" class="nav-link {{ request()->routeIs('admin.tips.*') ? 'active' : '' }}">
                        <i class="bi bi-lightbulb"></i>
                        <span class="nav-text ms-2">Tips Perawatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-text"></i>
                        <span class="nav-text ms-2">Artikel</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.symbols.index') }}" class="nav-link {{ request()->routeIs('admin.symbols.*') ? 'active' : '' }}">
                        <i class="bi bi-tags"></i>
                        <span class="nav-text ms-2">Simbol Care</span>
                    </a>
                </li>
                <div class="px-4 py-2 small text-uppercase fw-bold opacity-50 nav-text" style="font-size: 0.7rem;">Sistem</div>
                <li class="nav-item">
                    <a href="{{ route('admin.faq.index') }}" class="nav-link {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}">
                        <i class="bi bi-question-circle"></i>
                        <span class="nav-text ms-2">FAQ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i>
                        <span class="nav-text ms-2">Pengaturan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.manage-admins.index') }}" class="nav-link {{ request()->routeIs('admin.manage-admins.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span class="nav-text ms-2">Akun Admin</span>
                    </a>
                </li>
                <li class="nav-item mt-4 mb-4">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link bg-transparent border-0 text-danger w-100 text-start">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="nav-text ms-2">Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <div class="topbar">
            <div class="d-flex align-items-center">
                <button type="button" id="sidebarCollapse" class="toggle-sidebar-btn me-3">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h5 class="m-0 fw-bold d-none d-md-block text-navy">Dashboard Panel</h5>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="me-3 text-end d-none d-sm-block">
                    <div class="fw-bold text-navy small">{{ Auth::guard('admin')->user()->name }}</div>
                    <div class="text-muted" style="font-size: 0.7rem;">Administrator</div>
                </div>
                <div class="dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle show-none" id="userDropdown" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->user()->name }}&background=0a192f&color=fff&bold=true" class="rounded-circle border" width="40" height="40" alt="">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-2">
                        <li><a class="dropdown-item py-2" href="{{ route('admin.manage-admins.index') }}"><i class="bi bi-person me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('admin.settings.index') }}"><i class="bi bi-gear me-2"></i> Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="p-4 p-md-5">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-4 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const toggleBtn = document.getElementById('sidebarCollapse');
            const overlay = document.getElementById('sidebarOverlay');

            function toggleSidebar() {
                if (window.innerWidth > 992) {
                    // Desktop: Toggle collapsed state
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('expanded');
                } else {
                    // Mobile: Toggle slide-in state
                    sidebar.classList.toggle('mobile-show');
                    overlay.classList.toggle('show');
                }
            }

            toggleBtn.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    sidebar.classList.remove('mobile-show');
                    overlay.classList.remove('show');
                } else {
                    sidebar.classList.remove('collapsed');
                    content.classList.remove('expanded');
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
