<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Smart Selling CMS - Pos Indonesia</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root { 
            --primary-navy: #003B73; 
            --primary-navy-hover: #002D59;
            --accent-orange: #F7941D; 
            --bg-body: #F4F7F6;
            --bg-card: #FFFFFF;
            --text-dark: #2C3E50;
            --text-muted: #7F8C8D;
            --border-light: #E2E8F0;
        }

        body { margin: 0; padding: 0; background-color: var(--bg-body) !important; color: var(--text-dark) !important; font-family: 'Segoe UI', Tahoma, sans-serif; display: flex; height: 100vh; overflow: hidden; }

        .sidebar { width: 280px; background-color: var(--primary-navy); padding: 25px 20px; box-sizing: border-box; display: flex; flex-direction: column; box-shadow: 4px 0 15px rgba(0,0,0,0.05); z-index: 1050; overflow-y: auto; transition: transform 0.3s ease; border-right: 1px solid var(--primary-navy-hover);}
        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--primary-navy-hover); border-radius: 5px; }
        
        .brand-container { margin-bottom: 40px; display: flex; flex-direction: column; align-items: center; }
        .logo-plate { background-color: #ffffff; padding: 15px; border-radius: 12px; width: 80%; display: flex; justify-content: center; align-items: center; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: 0.3s; text-decoration: none;}
        .logo-plate:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(0,0,0,0.15); }
        .brand-logo { max-width: 120px; height: auto; }
        .brand-badge { color: #ffffff; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); font-size: 11px; font-weight: bold; padding: 6px 15px; border-radius: 20px; letter-spacing: 1px; text-transform: uppercase;}

        .menu { list-style: none; padding: 0; margin: 0; }
        .menu-item { margin-bottom: 8px; }
        .menu-link { display: flex; align-items: center; justify-content: space-between; padding: 14px 20px; color: rgba(255,255,255,0.8); text-decoration: none !important; font-weight: 500; font-size: 14.5px; border-radius: 10px; cursor: pointer; transition: all 0.3s ease; }
        .menu-link:hover { color: #ffffff; background-color: rgba(255,255,255,0.08); }
        .menu-link.active { color: #ffffff; background-color: var(--primary-navy-hover); border-left: 4px solid var(--accent-orange); font-weight: 600;}
        .menu-link i.icon-left { margin-right: 12px; width: 20px; text-align: center; font-size: 16px; color: var(--accent-orange);}
        
        .submenu { list-style: none; padding: 0; margin: 5px 0 10px 0; display: none; flex-direction: column; gap: 4px; }
        .submenu.open { display: flex; }
        .submenu a { display: flex; align-items: center; padding: 10px 15px 10px 52px; color: rgba(255,255,255,0.7); text-decoration: none !important; font-size: 13.5px; border-radius: 8px; transition: 0.3s; font-weight: 400; }
        .submenu a i { margin-right: 12px; font-size: 12px; }
        .submenu a:hover { color: #ffffff; background-color: rgba(255,255,255,0.05); }

        .main-wrapper { flex: 1; display: flex; flex-direction: column; background-color: var(--bg-body); min-width: 0; }
        .navbar-custom { background-color: #ffffff; height: 75px; padding: 0 35px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.03); z-index: 5; border-bottom: 1px solid var(--border-light);}
        .nav-title { font-size: 18px; font-weight: 700; color: var(--primary-navy); letter-spacing: 0.5px; display: flex; align-items: center; gap: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        .nav-actions { display: flex; align-items: center; gap: 15px; }
        
        .btn-visit-site { background-color: #F8FAFC; color: var(--primary-navy); border: 1px solid var(--border-light); padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none !important; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-visit-site:hover { background-color: var(--primary-navy); color: #ffffff; border-color: var(--primary-navy); }

        .nav-profile { display: flex; align-items: center; gap: 12px; }
        .profile-info { text-align: right; line-height: 1.2; }
        .profile-name { font-weight: 700; font-size: 14px; color: var(--text-dark); text-transform: capitalize;}
        .profile-role { font-size: 11px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; }
        
        .profile-circle { width: 42px; height: 42px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 18px; color: var(--accent-orange); background: #FFF5EA; cursor: pointer; transition: 0.3s; border: 1px solid rgba(247, 148, 29, 0.2); flex-shrink:0;}
        .profile-circle:hover, .profile-circle.show { background: var(--accent-orange); color: #ffffff; }
        
        .clean-dropdown { border: 1px solid var(--border-light); box-shadow: 0 10px 25px rgba(0,0,0,0.05); border-radius: 12px; padding: 10px; margin-top: 15px !important;}
        .clean-dropdown .dropdown-item { color: var(--text-dark); font-weight: 500; font-size: 13.5px; padding: 10px 15px; border-radius: 8px; transition: 0.2s; }
        .clean-dropdown .dropdown-item:hover { background-color: #F8FAFC; color: var(--primary-navy); }

        .content-container { flex: 1; padding: 25px; box-sizing: border-box; overflow: hidden; position: relative; }
        .content-frame { width: 100%; height: 100%; border: none; border-radius: 12px; background-color: transparent; display: block; }

        .mobile-toggle { display: none; background: transparent; border: none; color: var(--primary-navy); font-size: 22px; cursor: pointer; margin-right: 15px; }
        .sidebar-backdrop { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,35,70,0.5); z-index: 1040; backdrop-filter: blur(2px); }

        .clean-toast { background-color: #ffffff; color: var(--text-dark); box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-radius: 10px; border-left: 5px solid var(--accent-orange); font-size: 14px; font-weight: 500; border-top:1px solid var(--border-light); border-right:1px solid var(--border-light); border-bottom:1px solid var(--border-light);}
        .clean-toast.success { border-left-color: #2ecc71; }
        .clean-toast.error { border-left-color: #e74c3c; }

        .clean-modal { background-color: #ffffff; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: none; }
        .clean-input { width: 100%; padding: 12px 16px; background-color: #F8FAFC; color: var(--text-dark); border: 1px solid var(--border-light); border-radius: 8px; font-size: 14px; outline: none; margin-bottom: 20px; transition: 0.3s;}
        .clean-input:focus { border-color: var(--primary-navy); box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1); background:#ffffff;}
        .btn-modal { padding: 10px 20px; border-radius: 8px; font-size: 13.5px; font-weight: bold; border: none; cursor: pointer; transition: 0.3s; }
        .btn-modal-cancel { background-color: #F1F5F9; color: var(--text-muted); }
        .btn-modal-cancel:hover { background-color: #E2E8F0; color: var(--text-dark); }
        .btn-modal-save { background-color: var(--primary-navy); color: #ffffff; }
        .btn-modal-save:hover { background-color: var(--primary-navy-hover); }

        @media (max-width: 991.98px) {
            .sidebar { position: fixed; top: 0; left: 0; bottom: 0; transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-backdrop.show { display: block; }
            .mobile-toggle { display: block; }
            .navbar-custom { padding: 0 20px; height: 65px; }
            .nav-title { font-size: 16px; }
            .content-container { padding: 15px; }
            .profile-info { display: none; }
            .btn-visit-site span { display: none; }
        }
    </style>
</head>
<body>

    <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleMobileMenu()"></div>

    <div class="sidebar" id="sidebarMenu">
        <div class="brand-container">
            <!-- REVISI 2: Logo sekarang me-refresh halaman dashboard, bukan lari ke front index -->
            <a href="{{ route('dashboard') }}" class="logo-plate" title="Segarkan Dashboard">
                <img src="{{ asset('assets/images/posind.png') }}" alt="Logo Pos Indonesia" class="brand-logo">
            </a>
            <div class="brand-badge">Internal CMS</div>
        </div>

        <ul class="menu">
            <li class="menu-item">
                <a class="menu-link active" onclick="loadContent('dashboard')" id="menuDashboard">
                    <span><i class="fa-solid fa-chart-line icon-left"></i> Dashboard</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a class="menu-link" onclick="toggleMenu('kompetitorMenu', this)">
                    <span><i class="fa-solid fa-crosshairs icon-left"></i> Analisis Pasar</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px; color:rgba(255,255,255,0.5);"></i>
                </a>
                <ul class="submenu" id="kompetitorMenu">
                    <li><a href="{{ route('kompetitor.index') }}" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-map-location-dot text-warning\'></i> Peta Interaktif')"><i class="fa-solid fa-map"></i> Peta Wilayah</a></li>
                    
                    @if(auth()->user()->role == 'Admin')
                    <li><a href="{{ route('kategori-kompetitor.index') }}" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-server text-warning\'></i> Database Kompetitor')"><i class="fa-solid fa-table"></i> Data Kompetitor</a></li>
                    @endif
                </ul>
            </li>

            <li class="menu-item">
                <a class="menu-link" onclick="toggleMenu('ongkirMenu', this)">
                    <span><i class="fa-solid fa-truck-fast icon-left"></i> Ongkos Kirim</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px; color:rgba(255,255,255,0.5);"></i>
                </a>
                <ul class="submenu" id="ongkirMenu">
                    <li><a href="#" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-calculator text-warning\'></i> Komparasi Cek Ongkir')"><i class="fa-solid fa-calculator"></i> Cek Ongkir</a></li>
                    
                    @if(auth()->user()->role == 'Admin')
                    <li><a href="#" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-money-check-dollar text-warning\'></i> Master Tarif Ekspedisi')"><i class="fa-solid fa-table-list"></i> Data Ongkir</a></li>
                    @endif
                </ul>
            </li>

            <li class="menu-item">
                <a class="menu-link" onclick="toggleMenu('crmMenu', this)">
                    <span><i class="fa-solid fa-users-gear icon-left"></i> CRM & Mitra</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px; color:rgba(255,255,255,0.5);"></i>
                </a>
                <ul class="submenu" id="crmMenu">
                    @if(auth()->user()->role == 'Admin')
                    <li><a href="#" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-layer-group text-warning\'></i> Kategori Bisnis')"><i class="fa-solid fa-layer-group"></i> Kategori Bisnis</a></li>
                    @endif
                    <li><a href="#" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-address-book text-warning\'></i> Database Prospek')"><i class="fa-solid fa-store"></i> Data Prospek & Mitra</a></li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="#" target="contentFrame" class="menu-link" id="menuForum" onclick="updateTitle('<i class=\'fa-solid fa-users text-warning\'></i> Aktivitas Internal'); handleMenuClick(this);">
                    <span><i class="fa-regular fa-comments icon-left"></i> Aktivitas Pegawai</span>
                </a>
            </li>

            @if(auth()->user()->role == 'Admin')
            <li class="menu-item">
                <a class="menu-link" onclick="toggleMenu('kampanyeMenu', this)">
                    <span><i class="fa-solid fa-bullhorn icon-left"></i> Modul Promosi</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px; color:rgba(255,255,255,0.5);"></i>
                </a>
                <ul class="submenu" id="kampanyeMenu">
                    <li><a href="#" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-comment-sms text-warning\'></i> Broadcast SMS')"><i class="fa-solid fa-paper-plane"></i> Broadcast SMS</a></li>
                    <li><a href="#" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-newspaper text-warning\'></i> Pengelolaan Promosi Publik')"><i class="fa-solid fa-bullseye"></i> Forum Promosi</a></li>
                </ul>
            </li>

            <li class="menu-item">
                <a class="menu-link" onclick="toggleMenu('userMenu', this)">
                    <span><i class="fa-solid fa-user-shield icon-left"></i> Pengaturan</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px; color:rgba(255,255,255,0.5);"></i>
                </a>
                <ul class="submenu" id="userMenu">
                    <li>
                        <a href="{{ route('pegawai.index') }}" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-users text-warning\'></i> Manajemen Akses')">
                            <i class="fa-solid fa-user-tie"></i> Data Pegawai
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>

    <div class="main-wrapper">
        <div class="navbar-custom">
            <div class="nav-title" id="topTitle">
                <button class="mobile-toggle" onclick="toggleMobileMenu()">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <i class='fa-solid fa-chart-line' style='color: var(--accent-orange);'></i> Dashboard Operasional
            </div>
            
            <div class="nav-actions">
                <a href="{{ route('front.index') }}" class="btn-visit-site" title="Kembali ke Beranda Utama (Tanpa Logout)">
                    <i class="fa-solid fa-globe text-warning"></i>
                    <span>Website Utama</span>
                </a>

                <div class="nav-profile">
                    <div class="profile-info">
                        <div class="profile-name">{{ auth()->user()->name }}</div>
                        <div class="profile-role">{{ auth()->user()->role }}</div>
                    </div>
                    
                    <div class="dropdown">
                        <button class="profile-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-tie"></i>
                        </button>
                        <!-- REVISI 1: Tombol Beranda Utama yang mubazir telah dihapus dari dropdown -->
                        <ul class="dropdown-menu dropdown-menu-end clean-dropdown">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#passModal">
                                    <i class="fa-solid fa-key text-warning" style="width:20px;"></i> Ganti Sandi
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket" style="width:20px;"></i> Keluar Sistem
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-container">
            <iframe name="contentFrame" class="content-frame" src="{{ route('dashboard.main') }}"></iframe>
        </div>
    </div>

    <!-- Modal Ganti Password -->
    <div class="modal fade" id="passModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content clean-modal">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" style="color: var(--primary-navy); font-weight: bold;"><i class="fa-solid fa-user-lock text-warning"></i> Keamanan Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="modal-body border-0 pt-4 pb-0">
                        <label style="font-size:12px; color:var(--text-muted); font-weight:bold; margin-bottom:6px;">SANDI LAMA</label>
                        <input type="password" name="current_password" class="clean-input" required>
                        
                        <label style="font-size:12px; color:var(--text-muted); font-weight:bold; margin-bottom:6px;">SANDI BARU</label>
                        <input type="password" name="password" class="clean-input" required>
                        
                        <label style="font-size:12px; color:var(--text-muted); font-weight:bold; margin-bottom:6px;">KONFIRMASI SANDI BARU</label>
                        <input type="password" name="password_confirmation" class="clean-input" required>
                    </div>
                    
                    <div class="modal-footer border-0 pt-0 pb-4" style="justify-content: flex-end; gap: 10px; padding-right:16px;">
                        <button type="button" class="btn-modal btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal btn-modal-save">Perbarui Sandi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast UI -->
    <div class="toast-container position-fixed bottom-0 end-0 p-4" style="z-index: 2000;">
        <div id="cmsGlobalToast" class="toast clean-toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex p-1">
                <div class="toast-body" id="toastMessage"></div>
                <button type="button" class="btn-close me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function toggleMobileMenu() {
            document.getElementById('sidebarMenu').classList.toggle('show');
            document.getElementById('sidebarBackdrop').classList.toggle('show');
        }

        function closeSidebarOnMobile() {
            if(window.innerWidth <= 991) {
                document.getElementById('sidebarMenu').classList.remove('show');
                document.getElementById('sidebarBackdrop').classList.remove('show');
            }
        }

        window.showToast = function(message, type = 'success') {
            const toastEl = document.getElementById('cmsGlobalToast');
            const toastMsg = document.getElementById('toastMessage');
            let icon = '';
            if(type === 'success') {
                toastEl.className = 'toast clean-toast success align-items-center';
                icon = '<i class="fa-solid fa-circle-check" style="color: #2ecc71; font-size: 18px; margin-right: 12px; vertical-align:middle;"></i>';
            } else if(type === 'error') {
                toastEl.className = 'toast clean-toast error align-items-center';
                icon = '<i class="fa-solid fa-triangle-exclamation" style="color: #e74c3c; font-size: 18px; margin-right: 12px; vertical-align:middle;"></i>';
            }
            toastMsg.innerHTML = icon + '<span style="vertical-align:middle;">' + message + '</span>';
            const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
            toast.show();
        }

        function toggleMenu(menuId, element) {
            const submenu = document.getElementById(menuId);
            const isOpen = submenu.classList.contains('open');
            document.querySelectorAll('.submenu').forEach(el => el.classList.remove('open'));
            document.querySelectorAll('.menu-link').forEach(el => {
                el.classList.remove('active');
                if(el.querySelector('.fa-chevron-down')) { el.querySelector('.fa-chevron-down').style.transform = 'rotate(0deg)'; }
            });

            if (!isOpen) {
                submenu.classList.add('open'); 
                element.classList.add('active'); 
                element.querySelector('.fa-chevron-down').style.transform = 'rotate(180deg)';
            }
        }

        function updateTitle(title) { 
            document.getElementById('topTitle').innerHTML = '<button class="mobile-toggle" onclick="toggleMobileMenu()"><i class="fa-solid fa-bars"></i></button>' + title; 
        }

        function handleMenuClick(element) {
            document.querySelectorAll('.menu-link').forEach(el => el.classList.remove('active')); 
            element.classList.add('active');
            closeSidebarOnMobile();
        }

        function loadContent(page) {
            if(page === 'dashboard') {
                updateTitle('<i class=\'fa-solid fa-chart-line\' style=\'color: var(--accent-orange);\'></i> Dashboard Operasional');
                document.querySelector('.content-frame').src = "{{ route('dashboard.main') }}"; 
                document.querySelectorAll('.menu-link').forEach(el => el.classList.remove('active'));
                document.getElementById('menuDashboard').classList.add('active');
                document.querySelectorAll('.submenu').forEach(el => el.classList.remove('open'));
                closeSidebarOnMobile();
            }
        }

        document.querySelectorAll('.submenu a').forEach(link => {
            link.addEventListener('click', closeSidebarOnMobile);
        });
    </script>

    @if (session('status') === 'password-updated')
        <script>window.showToast('Kata sandi berhasil diperbarui dengan aman!', 'success');</script>
    @endif

    @if ($errors->updatePassword->any())
        <script>window.showToast('{{ $errors->updatePassword->first() }}', 'error');</script>
    @endif
</body>
</html>