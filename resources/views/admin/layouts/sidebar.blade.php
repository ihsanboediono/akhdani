@php
    $count = App\Models\OfficialTravel::whereIn('status', ['pending'])->count()
@endphp

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
                
                @if ($rol == 'admin')
                    <li class="nav-item {{  request()->routeIs('admin.perdin.*') ? 'active sub-menu' : '' }}">
                        <a class="" data-toggle="collapse" href="#perdin" aria-expanded="{{  request()->routeIs('admin.perdin.*') ? 'true' : 'false' }}">
                            <i class="fas fa-plane"></i>
                            <p>Pejalanan Dinas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{  request()->routeIs('admin.perdin.*') ? 'show' : '' }}" id="perdin">
                            <ul class="nav nav-collapse">
                                <li class="{{  request()->routeIs('admin.perdin.*') && !request()->routeIs('admin.perdin.history.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.perdin.index') }}">
                                        <span class="sub-item">Pengajuan Baru</span>
                                        @if ($count > 0)
                                            <span class="badge badge-success">{{ $count }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.perdin.history.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.perdin.history.index') }}">
                                        <span class="sub-item">History Pengajuan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{  request()->routeIs('admin.kota.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.kota.index') }}">
                            <i class="fas fa-store-alt"></i>
                            <p>Master Kota</p>
                        </a>
                    </li>
                    
                    @if (auth()->user()->role == 'root')
                        <li class="nav-item {{  request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item {{  request()->routeIs('pegawai.perdin.*') ? 'active' : '' }}">
                        <a href="{{ route('pegawai.perdin.index') }}">
                            <i class="fas fa-plane"></i>
                            <p>Pejalanan Dinas</p>
                        </a>
                    </li>
                @endif
                
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->