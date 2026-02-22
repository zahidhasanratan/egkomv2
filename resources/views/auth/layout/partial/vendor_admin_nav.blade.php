<div class="nk-sidebar-element nk-sidebar-body">
    <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>

            <ul class="nk-menu">
                <li class="nk-menu-item"><a href="{{ route('vendor-admin.dashboard') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span><span class="nk-menu-text">Dashboard</span></a></li>


                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-icon"><em class="icon ni ni-calendar-booking-fill"></em></span><span class="nk-menu-text">Vendor</span></a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.vendor.create') }}" class="nk-menu-link"><span class="nk-menu-text">Vendor Info</span></a></li>
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.owner.create') }}" class="nk-menu-link"><span class="nk-menu-text">Owner Details</span></a></li>
                        @if(Auth::guard('vendor')->user()->isApproved())
                        <li class="nk-menu-item"><a href="{{ route('owners.bankInfo') }}" class="nk-menu-link"><span class="nk-menu-text">Owner Banking Info</span></a></li>
                        @endif
                    </ul>
                </li>



                @if(Auth::guard('vendor')->user()->isApproved())
                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-icon"><em class="icon ni ni-dashlite-alt"></em></span><span class="nk-menu-text">Manage Hotel</span></a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.hotel.create') }}" class="nk-menu-link"><span class="nk-menu-text">Create Hotel</span></a></li>
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.hotel.index') }}" class="nk-menu-link"><span class="nk-menu-text">All Hotel</span></a></li>
                    </ul>
                </li>

                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-icon"><em class="icon ni ni-dashlite-alt"></em></span><span class="nk-menu-text">Manage Room List</span></a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.room.all') }}" class="nk-menu-link"><span class="nk-menu-text">All Room</span></a></li>
                        @foreach(\App\Models\Hotel::where('vendor_id', Auth::guard('vendor')->id())->where('approve','1')->where('status','submitted')->get() as $hotel)
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.room.index',\Illuminate\Support\Facades\Crypt::encrypt($hotel->id)) }}" class="nk-menu-link"><span class="nk-menu-text">{{ $hotel->description }}</span></a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-users"></em>
                        </span>
                        <span class="nk-menu-text">Manage Co-Hosts</span>
                    </a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item">
                            <a href="{{ route('vendor.co-hosts.all') }}" class="nk-menu-link">
                                <span class="nk-menu-text">All Co Host</span>
                            </a>
                        </li>
                        @foreach(\App\Models\Hotel::where('vendor_id', Auth::guard('vendor')->id())->where('approve','1')->where('status','submitted')->get() as $hotel)
                        <li class="nk-menu-item">
                            <a href="{{ route('vendor.co-hosts.index', $hotel->id) }}" class="nk-menu-link">
                                <span class="nk-menu-text">{{ $hotel->description }} - Co-Hosts</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-calendar-booking"></em>
                        </span>
                        <span class="nk-menu-text">My Bookings</span>
                    </a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item">
                            <a href="{{ route('vendor.bookings.index') }}" class="nk-menu-link {{ request()->routeIs('vendor.bookings.index') && !request()->routeIs('vendor.bookings.by-status') ? 'active' : '' }}">
                                <span class="nk-menu-text">All</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('vendor.bookings.by-status', 'pending') }}" class="nk-menu-link {{ request()->routeIs('vendor.bookings.by-status') && request()->route('status') === 'pending' ? 'active' : '' }}">
                                <span class="nk-menu-text">Pending</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('vendor.bookings.by-status', 'confirmed') }}" class="nk-menu-link {{ request()->routeIs('vendor.bookings.by-status') && request()->route('status') === 'confirmed' ? 'active' : '' }}">
                                <span class="nk-menu-text">Confirmed</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('vendor.bookings.by-status', 'staying') }}" class="nk-menu-link {{ request()->routeIs('vendor.bookings.by-status') && request()->route('status') === 'staying' ? 'active' : '' }}">
                                <span class="nk-menu-text">Staying</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('vendor.bookings.by-status', 'completed') }}" class="nk-menu-link {{ request()->routeIs('vendor.bookings.by-status') && request()->route('status') === 'completed' ? 'active' : '' }}">
                                <span class="nk-menu-text">Completed</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('vendor.bookings.by-status', 'cancelled') }}" class="nk-menu-link {{ request()->routeIs('vendor.bookings.by-status') && request()->route('status') === 'cancelled' ? 'active' : '' }}">
                                <span class="nk-menu-text">Cancelled</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nk-menu-item">
                    <a href="{{ route('vendor.reviews.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-star"></em>
                        </span>
                        <span class="nk-menu-text">Reviews Management</span>
                    </a>
                </li>
                @endif

                <li class="nk-menu-item">
                    <form id="logout-form" action="{{ route('vendor-admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nk-menu-link">
        <span class="nk-menu-icon">
            <em class="icon ni ni-signout"></em>
        </span>
                        <span class="nk-menu-text">Logout</span>
                    </a>
                </li>




            </ul>

        </div>
    </div>
</div>
