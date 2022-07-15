<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Menu Navigasi</li>
            <li><a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="ai-icon" href="event-management.html" aria-expanded="false">
                    <i class="la la-map-marker"></i>
                    <span class="nav-text">Peta Drainase</span>
                </a>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-server"></i>
                    <span class="nav-text">Data Master</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="all-professors.html">Drainase 2020-2021</a></li>
                    <li><a href="add-professor.html">Drainase 2022</a></li>
                </ul>
            </li>

            <li class="nav-label">Admin</li>
            <li><a class="ai-icon" href="event-management.html" aria-expanded="false">
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
