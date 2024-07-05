<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Game Drive</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item mb-3">
                    <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('my-dashboard' ? 'active' : '') }}"
                        aria-current="page" href="/my-dashboard/profile">
                        <i data-feather="user" style="color: #000"></i>
                        {{ auth()->user()->name }}
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('my-dashboard' ? 'active' : '') }}"
                        aria-current="page" href="/my-dashboard">
                        <i data-feather="home" style="color: #000"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('my-dashboard/post' ? 'active' : '') }}"
                        href="/my-dashboard/post">
                        <i data-feather="dollar-sign" style="color: #000"></i>
                        Topup Game
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('my-dashboard/post' ? 'active' : '') }}"
                        href="/my-dashboard/joki">
                        <i data-feather="monitor" style="color: #000"></i>
                        Jasa Joki Game
                    </a>
                </li>
            </ul>

            @if (auth()->user()->isAdmin())
                <hr class="my-3">
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 mb-3 {{ Request::is('my-dashboard/post' ? 'active' : '') }}"
                            href="/my-dashboard/admin">
                            <i data-feather="user-check" style="color: #000"></i>
                            Admin
                        </a>
                    </li>
                </ul>
            @endif

            @if (auth()->user()->isPetugas() || auth()->user()->isAdmin())
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 mb-3 {{ Request::is('my-dashboard/post' ? 'active' : '') }}"
                            href="/my-dashboard/admin">
                            <i data-feather="user-check" style="color: #000"></i>
                            Petugas
                        </a>
                    </li>
                </ul>
            @endif
            
            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 mb-3 {{ Request::is('my-dashboard/post' ? 'active' : '') }}"
                        href="/">
                        <i data-feather="rewind" style="color: #000"></i>
                        Landing Page
                    </a>
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <i data-feather="log-out" style="color: #000"></i>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                Logout
                            </button>
                        </form>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
