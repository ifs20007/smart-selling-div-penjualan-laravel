<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Smart Selling CMS - Pos Indonesia</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
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
                    <li><a href="{{ route('cek-ongkir.komparasi') }}" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-calculator text-warning\'></i> Komparasi Cek Ongkir')"><i class="fa-solid fa-calculator"></i> Cek Ongkir</a></li>
                    
                    @if(auth()->user()->role == 'Admin')
                    <li><a href="{{ route('data-ongkir.index') }}" target="contentFrame" onclick="updateTitle('<i class=\'fa-solid fa-money-check-dollar text-warning\'></i> Master Tarif Ekspedisi')"><i class="fa-solid fa-table-list"></i> Data Ongkir</a></li>
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