<!-- BOTTOM NAVIGATION (FLOATING DOCK PJ) -->
<div class="bottom-nav-container">
    <div class="bottom-nav">
        <a href="{{ route('pj.dashboard') }}" class="nav-link-custom {{ request()->routeIs('pj.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Beranda</span>
        </a>
        <a href="{{ route('pj.verifikasi') }}" class="nav-link-custom {{ request()->routeIs('pj.verifikasi') ? 'active' : '' }}">
            <i class="bi bi-check2-square"></i>
            <span>Verifikasi</span>
        </a>
        <a href="{{ Route::has('pj.perizinan') ? route('pj.perizinan') : '#' }}" class="nav-link-custom {{ request()->routeIs('pj.perizinan') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text-fill"></i>
            <span>Izin</span>
        </a>
        <a href="{{ Route::has('pj.rapor') ? route('pj.rapor') : '#' }}" class="nav-link-custom {{ request()->routeIs('pj.rapor') ? 'active' : '' }}">
            <i class="bi bi-award-fill"></i>
            <span>Rapor</span>
        </a>
        <a href="{{ Route::has('pj.profil') ? route('pj.profil') : '#' }}" class="nav-link-custom {{ request()->routeIs('pj.profil') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i>
            <span>Profil</span>
        </a>
    </div>
</div>