<div class="nk-sidebar-element nk-sidebar-body">
    <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>

            <ul class="nk-menu">
                <li class="nk-menu-item"><a href="{{ route('super-admin.dashboard') }}" class="nk-menu-link"><span
                            class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span><span
                            class="nk-menu-text">Dashboard</span></a></li>

                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span
                            class="nk-menu-icon"><em class="icon ni ni-calendar-booking-fill"></em></span><span
                            class="nk-menu-text">Vendor</span></a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item"><a href="{{ route('super-admin.vendor.create') }}"
                                                    class="nk-menu-link"><span
                                    class="nk-menu-text">Add Vendor</span></a></li>
                        <li class="nk-menu-item"><a href="{{ route('super-admin.vendor.index') }}" class="nk-menu-link"><span
                                    class="nk-menu-text">All Vendor</span></a></li>
                    </ul>
                </li>

                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span
                            class="nk-menu-icon"><em class="icon ni ni-dashlite-alt"></em></span><span
                            class="nk-menu-text">Manage Hotel</span></a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item"><a href="{{ route('super-admin.hotel.index') }}"
                                                    class="nk-menu-link"><span class="nk-menu-text">All Hotel</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span
                            class="nk-menu-icon"><em class="icon ni ni-dashlite-alt"></em></span><span
                            class="nk-menu-text">Manage Room</span></a>
                    <ul class="nk-menu-sub">
                        @foreach(\App\Models\Hotel::all()->where('approve','1')->where('status','submitted') as $hotel)
                            <li class="nk-menu-item"><a
                                    href="{{ route('super-admin.room.index',\Illuminate\Support\Facades\Crypt::encrypt($hotel->id)) }}"
                                    class="nk-menu-link"><span class="nk-menu-text">{{ $hotel->description }}</span></a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nk-menu-item">
                    <a href="{{ route('super-admin.bookings.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-calendar-booking"></em>
                        </span>
                        <span class="nk-menu-text">All Bookings</span>
                    </a>
                </li>

                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span
                            class="nk-menu-icon"><em class="icon ni ni-map-pin-fill"></em></span><span
                            class="nk-menu-text">Most Popular Destination</span></a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item"><a href="{{ route('super-admin.popular-destinations.create') }}"
                                                    class="nk-menu-link"><span class="nk-menu-text">Add Destination</span></a></li>
                        <li class="nk-menu-item"><a href="{{ route('super-admin.popular-destinations.index') }}" class="nk-menu-link"><span class="nk-menu-text">All Destinations</span></a></li>
                    </ul>
                </li>

                <li class="nk-menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="nk-menu-link">
        <span class="nk-menu-icon">
            <em class="icon ni ni-dashboard"></em> <!-- Updated icon -->
        </span>
                        <span class="nk-menu-text">Go to CMS</span>

                    </a>
                </li>


            </ul>

        </div>
    </div>
</div>
