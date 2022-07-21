<div class="dlabnav" style="z-index: 100000000">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Menu Navigasi</li>
            <li><a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{ route('map') }}" aria-expanded="false">
                    <i class="la la-map-marker"></i>
                    <span class="nav-text">Peta Drainase</span>
                </a>
            </li>
            <li class="{{ Request::is('datamaster/*') ? 'mm-active' : '' }}"><a class="has-arrow"
                    href="javascript:void()" aria-expanded="false">
                    <i class="la la-server"></i>
                    <span class="nav-text">Data Master</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Drainase</a>
                        <ul aria-expanded="false">
                            <li><a class="{{ Request::is('drainase/2020/*') ? 'mm-active' : '' }}"
                                    href="{{ route('drainase.index', 2020) }}">2020</a></li>
                            <li><a class="{{ Request::is('drainase/2021/*') ? 'mm-active' : '' }}"
                                    href="page-error-403.html">2021</a></li>
                            <li><a class="{{ Request::is('drainase/2022/*') ? 'mm-active' : '' }}"
                                    href="{{ route('drainase.index', 2022) }}">2022</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li><a class="{{ Request::is('datamaster/drainase2022/*') ? 'mm-active' : '' }}"
                            href="{{ route('drainase2022.index') }}">Drainase 2022</a></li> --}}
                    <li><a class="{{ Request::is('datamaster/genangan/*') ? 'mm-active' : '' }}"
                            href="{{ route('genangan.index') }}">Titik Genangan</a></li>
                    <li><a class="{{ Request::is('datamaster/jalan/*') ? 'mm-active' : '' }}"
                            href="{{ route('jalan.index') }}">Jalan</a></li>
                    <li><a class="{{ Request::is('datamaster/kelurahan/*') ? 'mm-active' : '' }}"
                            href="{{ route('kelurahan.index') }}">Kelurahan</a></li>
                    <li><a class="{{ Request::is('datamaster/kecamatan/*') ? 'mm-active' : '' }}"
                            href="{{ route('kecamatan.index') }}">Kecamatan</a></li>
                </ul>
            </li>
            {{-- class="{{ Request::is('datamaster/drainase2022*') ? 'active' : '' }}" --}}
            <li><a class="ai-icon" href="{{ route('r24.edit', 1) }}" aria-expanded="false">
                    <i class="la la-wrench"></i>
                    <span class="nav-text">Setting R24</span>
                </a>
            </li>

            <li class="nav-label">Admin</li>
            <li><a class="ai-icon" href="{{ route('profile.edit', Auth::user()->username) }}" aria-expanded="false">
                    <i class="la la-user"></i>
                    <span class="nav-text">Profil</span>
                </a>
            </li>
            <li>
                <form id="logout">
                    @csrf
                    <a class="ai-icon" href="javascript: void(0);" onclick="logout()" aria-expanded="false">
                        <i class="la la-sign-out"></i>
                        <span class="nav-text">Log Out</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
