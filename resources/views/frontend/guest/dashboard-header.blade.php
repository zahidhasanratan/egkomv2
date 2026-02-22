<!-- Dashboard Header -->
<div class="dashboard-header-bar">
    <div class="dashboard-header-content">
        <div class="dashboard-header-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('frontend')}}/images/logo.png" alt="EZBOOKING">
            </a>
        </div>
        <div class="dashboard-header-user">
            @if(auth()->guard('guest')->check())
                <span>Welcome, {{ auth()->guard('guest')->user()->name }}</span>
                <a href="{{ route('guest.profile') }}">Profile</a>
                <a href="{{ route('guest.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('guest.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('guest.login') }}">Login</a>
            @endif
        </div>
    </div>
</div>
