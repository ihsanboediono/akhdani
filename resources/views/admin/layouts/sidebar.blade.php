<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                @php
                    $rol = auth()->user()->role == 'pegawai' ? 'pegawai' : 'admin';
                @endphp
                <li class="nav-item {{  request()->routeIs($rol.'.dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route($rol.'.dashboard.index') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item {{  request()->routeIs($rol.'.perdin.*') ? 'active' : '' }}">
                    <a href="{{ route($rol.'.perdin.index') }}">
                        <i class="fas fa-plane"></i>
                        <p>Pejalanan Dinas</p>
                    </a>
                </li>
                @if ($rol == 'admin')
                    <li class="nav-item {{  request()->routeIs($rol.'.kota.*') ? 'active' : '' }}">
                        <a href="{{ route($rol.'.kota.index') }}">
                            <i class="fas fa-store-alt"></i>
                            <p>Master Kota</p>
                        </a>
                    </li>
                    

                    <li class="nav-item {{  request()->routeIs($rol.'.users.*') ? 'active' : '' }}">
                        <a href="{{ route($rol.'.users.index') }}">
                            <i class="fas fa-users"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>
                @endif
                
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->