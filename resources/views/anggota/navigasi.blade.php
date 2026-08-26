<!-- BOTTOM NAVIGATION (FLOATING DOCK) -->
<div class="bottom-nav-container">
    <div class="bottom-nav">
        <a href="{{ route('anggota.dashboard') }}" class="nav-link-custom {{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Beranda</span>
        </a>
        <a href="{{ route('anggota.riwayat') }}" class="nav-link-custom {{ request()->routeIs('anggota.riwayat') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i>
            <span>Riwayat</span>
        </a>
        <a href="{{ route('anggota.perizinan') }}" class="nav-link-custom {{ request()->routeIs('anggota.perizinan') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text-fill"></i>
            <span>Izin</span>
        </a>
        <a href="{{ route('anggota.rapor') }}" class="nav-link-custom {{ request()->routeIs('anggota.rapor') ? 'active' : '' }}">
            <i class="bi bi-award-fill"></i>
            <span>Rapor</span>
        </a>
        <a href="{{ route('anggota.profil') }}" class="nav-link-custom {{ request()->routeIs('anggota.profil') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i>
            <span>Profil</span>
        </a>
    </div>
</div>