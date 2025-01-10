<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('home.index') }}" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0 text-primary">ConnectFriend</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home.index') }}"
                class="nav-item nav-link {{ Route::is('home.index') ? 'active' : '' }}">Home</a>
            <a href="{{ route('home.topup') }}" class="nav-item nav-link {{ Route::is('home.topup') ? 'active' : '' }}">Top up</a>
            <a href="{{ route('home.filter') }}" class="nav-item nav-link {{ Route::is(['home.filter', 'filter.search']) ? 'active' : '' }}">Friend Filter</a>
            <a href="{{ route('home.avatar') }}" class="nav-item nav-link {{ Route::is('home.avatar') ? 'active' : '' }}">Avatar</a>
        </div>
        @if (Auth::check())
            <a href="{{ route('home.profile') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                Profile
                <i class="fa fa-arrow-right ms-3">
                    <span class="badge text-bg-secondary bg-danger">{{ Auth::user()->friendRequests()->where('status', 'pending')->count() }}</span>
                </i>
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                Login
                <i class="fa fa-arrow-right ms-3"></i>
            </a>
        @endif
    </div>
</nav>
