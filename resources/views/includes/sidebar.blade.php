<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="/" class="d-block text-decoration-none position-relative">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo-icon">
            <span class="logo-text fw-bold text-dark">Klinik</span>
        </a>
        <button
            class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
            id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">MAIN</span>
            </li>


            @if (Auth::user()->peran == 'bidan')
                <li class="menu-item {{ request()->is('bidan/dashboard') ? 'open' : '' }}">
                    <a href="{{ route('bidan.dashboard') }}"
                        class="menu-link {{ request()->is('bidan/dashboard') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">dashboard</span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                
                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">APPS</span>
                </li>
                
                <li class="menu-item {{ request()->is('bidan/rekam-medis') ? 'open' : '' }}">
                    <a href="{{ route('rekam-medis.index') }}" class="menu-link {{ request()->is('bidan/rekam-medis') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">
                            stethoscope
                        </span>
                        <span class="title">Rekam Medis</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('bidan/pasien') ? 'open' : '' }}">
                    <a href="{{ route('bidan.pasien.index') }}" class="menu-link {{ request()->is('bidan/pasien') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">
                            group
                        </span>
                        <span class="title">Pasien</span>
                    </a>
                </li>

            @endif

            @if (Auth::user()->peran == 'petugas')
                <li class="menu-item {{ request()->is('petugas/dashboard') ? 'open' : '' }}">
                    <a href="{{ route('petugas.dashboard') }}"
                        class="menu-link {{ request()->is('petugas/dashboard') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">dashboard</span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                
                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">APPS</span>
                </li>
                
                <li class="menu-item {{ request()->is('petugas/antrian') ? 'open' : '' }}">
                    <a href="{{ route('petugas.antrian.index') }}" class="menu-link {{ request()->is('petugas/antrian') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">
                            queue
                        </span>
                        <span class="title">Antrian</span>
                    </a>
                </li>
                
                <li class="menu-item {{ request()->is('petugas/rumah-sakit') ? 'open' : '' }}">
                    <a href="{{ route('rumah-sakit.index') }}"
                        class="menu-link {{ request()->is('petugas/rumah-sakit') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">
                            local_hospital
                        </span>
                        <span class="title">Rumah Sakit</span>
                    </a>
                </li>
                
                <li class="menu-item {{ request()->is('petugas/layanan') ? 'open' : '' }}">
                    <a href="{{ route('layanan.index') }}" class="menu-link {{ request()->is('petugas/layanan') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">
                            design_services
                        </span>
                        <span class="title">Layanan</span>
                    </a>
                </li>
                
                <li class="menu-item {{ request()->is('petugas/pasien') ? 'open' : '' }}">
                    <a href="{{ route('petugas.pasien.index') }}" class="menu-link {{ request()->is('petugas/pasien') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">
                            group
                        </span>
                        <span class="title">Pasien</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->peran == 'user')
                <li class="menu-item {{ request()->is('user/dashboard') ? 'open' : '' }}">
                    <a href="{{ route('user.dashboard') }}"
                        class="menu-link {{ request()->is('user/dashboard') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">dashboard</span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                
                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">APPS</span>
                </li>

                <li class="menu-item {{ request()->is('user/layanan') ? 'open' : '' }}">
                    <a href="{{ route('user.layanan.index') }}" class="menu-link {{ request()->is('user/layanan') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">
                            design_services
                        </span>
                        <span class="title">Layanan</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('user/rekam-medis') ? 'open' : '' }}">
                    <a href="{{ route('user.rekam.medis.index') }}"
                        class="menu-link {{ request()->is('user/rekam-medis') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">
                            stethoscope
                        </span>
                        <span class="title">Rekam Medis</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('user/akun') ? 'open' : '' }}">
                    <a href="{{ route('user.akun.index') }}" class="menu-link {{ request()->is('user/akun') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">
                            account_circle
                        </span>
                        <span class="title">Akun</span>
                    </a>
                </li>
            @endif

            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link" onclick="logout()">
                    <span class="material-symbols-outlined menu-icon">logout</span>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
    </aside>
</div>