<!-- Sidebar -->
<div class="dashboard-sidebar">
    <div class="sidebar-header">
        <h2 class="sidebar-title">Dashboard</h2>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('guest.dashboard') }}" class="{{ request()->routeIs('guest.dashboard') ? 'active' : '' }}">
                <i class="fa fa-dashboard"></i>
                <span>Overview</span>
            </a>
        </li>
        <li>
            <a href="{{ route('guest.bookings') }}" class="{{ request()->routeIs('guest.bookings') ? 'active' : '' }}">
                <i class="fa fa-calendar-check-o"></i>
                <span>My Bookings</span>
            </a>
        </li>
        <li>
            <a href="{{ route('guest.wishlist') }}" class="{{ request()->routeIs('guest.wishlist') ? 'active' : '' }}">
                <i class="fa fa-heart"></i>
                <span>My Wishlist</span>
            </a>
        </li>
        <li>
            <a href="{{ route('guest.payment-history') }}" class="{{ request()->routeIs('guest.payment-history') ? 'active' : '' }}">
                <i class="fa fa-credit-card"></i>
                <span>Payment History</span>
            </a>
        </li>
        <li>
            <a href="{{ route('guest.reviews') }}" class="{{ request()->routeIs('guest.reviews') ? 'active' : '' }}">
                <i class="fa fa-star"></i>
                <span>My Reviews</span>
            </a>
        </li>
        <li>
            <a href="{{ route('guest.notifications') }}" class="{{ request()->routeIs('guest.notifications') ? 'active' : '' }}">
                <i class="fa fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
    </ul>
</div>
