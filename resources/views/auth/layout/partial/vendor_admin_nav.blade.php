<div class="nk-sidebar-element nk-sidebar-body">
    <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>

            <ul class="nk-menu">
                <li class="nk-menu-item"><a href="{{ route('vendor-admin.dashboard') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span><span class="nk-menu-text">Dashboard</span></a></li>


                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-icon"><em class="icon ni ni-calendar-booking-fill"></em></span><span class="nk-menu-text">Vendor</span></a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.vendor.create') }}" class="nk-menu-link"><span class="nk-menu-text">Vendor Info</span></a></li>
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.owner.create') }}" class="nk-menu-link"><span class="nk-menu-text">Owner Details</span></a></li>
                        <li class="nk-menu-item"><a href="{{ route('owners.bankInfo') }}" class="nk-menu-link"><span class="nk-menu-text">Owner Banking Info</span></a></li>
                    </ul>
                </li>



                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-icon"><em class="icon ni ni-dashlite-alt"></em></span><span class="nk-menu-text">Manage Hotel</span></a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.hotel.create') }}" class="nk-menu-link"><span class="nk-menu-text">Create Hotel</span></a></li>
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.hotel.index') }}" class="nk-menu-link"><span class="nk-menu-text">All Hotel</span></a></li>
                    </ul>
                </li>

                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-icon"><em class="icon ni ni-dashlite-alt"></em></span><span class="nk-menu-text">Manage Room List</span></a>
                    <ul class="nk-menu-sub">
                        @foreach(\App\Models\Hotel::all()->where('approve','1')->where('status','submitted') as $hotel)
                        <li class="nk-menu-item"><a href="{{ route('vendor-admin.room.index',\Illuminate\Support\Facades\Crypt::encrypt($hotel->id)) }}" class="nk-menu-link"><span class="nk-menu-text">{{ $hotel->description }}</span></a></li>
                        @endforeach
                    </ul>
                </li>

{{--                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-icon"><em class="icon ni ni-cart"></em></span><span class="nk-menu-text">Order</span></a>--}}
{{--                    <ul class="nk-menu-sub">--}}

{{--                        <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text"> All Order</span></a></li>--}}
{{--                        <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">Approved Order</span></a></li>--}}
{{--                        <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">Pending Order</span></a></li>--}}
{{--                        <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">Reject Order</span></a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span><span class="nk-menu-text">Payment & Withdraw</span></a>--}}
{{--                    <ul class="nk-menu-sub">--}}
{{--                        <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">Withdraw Request</span></a></li>--}}
{{--                        <li class="nk-menu-item"><a href="#" class="nk-menu-link"><span class="nk-menu-text">Approve Payment</span></a></li>--}}

{{--                    </ul>--}}
{{--                </li>--}}

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
