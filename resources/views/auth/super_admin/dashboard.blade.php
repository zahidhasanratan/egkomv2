@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Dashboard Overview</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Welcome to Eg Kom</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content d-flex align-items-center gap-2">
                                <div class="toggle-wrap nk-block-tools-toggle"><a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">{{ $dateRangeLabel }}</span></span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="{{ route('super-admin.dashboard', ['range' => '30d']) }}"><span>Last 30 Days</span></a></li>
                                                            <li><a href="{{ route('super-admin.dashboard', ['range' => '6m']) }}"><span>Last 6 Months</span></a></li>
                                                            <li><a href="{{ route('super-admin.dashboard', ['range' => '1y']) }}"><span>Last 1 Year</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="dropdown d-inline">
                                    <a href="#" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-reports"></em><span>Reports</span><em class="dd-indc icon ni ni-chevron-down"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="{{ route('super-admin.bookings.index') }}"><span>View bookings</span></a></li>
                                            <li><a href="{{ route('super-admin.reports.bookings.excel') }}" target="_blank" rel="noopener"><span>Download Excel (CSV)</span></a></li>
                                            <li><a href="{{ route('super-admin.reports.bookings.pdf') }}" target="_blank" rel="noopener"><span>Download PDF</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-md-3">
                                <div class="card gradient-1 card-bx card-custom-chart">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="me-auto text-white">
                                            <h2 class="text-white">{{ number_format($totalBookings) }}</h2>
                                            <span class="fs-18">Total Bookings</span>
                                        </div>
                                        <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.0611 39.4402L13.7104 52.5947C12.9941 53.2089 11.9873 53.3497 11.1271 52.9556C10.2697 52.5614 9.7226 51.7041 9.7226 50.7597C9.7226 50.7597 9.7226 26.8794 9.7226 14.5028C9.7226 9.16424 14.0517 4.83655 19.3904 4.83655H38.7289C44.0704 4.83655 48.3995 9.16424 48.3995 14.5028V50.7597C48.3995 51.7041 47.8495 52.5614 46.9922 52.9556C46.1348 53.3497 45.1252 53.2089 44.4088 52.5947L29.0611 39.4402ZM43.5656 14.5028C43.5656 11.8335 41.3996 9.66841 38.7289 9.66841C33.0207 9.66841 25.1014 9.66841 19.3904 9.66841C16.7196 9.66841 14.5565 11.8335 14.5565 14.5028V45.5056L27.4873 34.4215C28.3926 33.646 29.7266 33.646 30.6319 34.4215L43.5656 45.5056V14.5028Z" fill="white"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card gradient-3 card-bx card-custom-chart">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="me-auto text-white">
                                            <h2 class="text-white">{{ $checkInToday }}</h2>
                                            <span class="fs-18">Check In Today</span>
                                        </div>
                                        <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.66671 38.6667V43.5C9.66671 48.8409 13.995 53.1667 19.3334 53.1667H43.5C48.8409 53.1667 53.1667 48.8409 53.1667 43.5C53.1667 35.455 53.1667 22.5475 53.1667 14.5C53.1667 9.16162 48.8409 4.83337 43.5 4.83337C36.5908 4.83337 26.245 4.83337 19.3334 4.83337C13.995 4.83337 9.66671 9.16162 9.66671 14.5V19.3334C9.66671 20.6674 10.7494 21.75 12.0834 21.75C13.4174 21.75 14.5 20.6674 14.5 19.3334C14.5 19.3334 14.5 17.069 14.5 14.5C14.5 11.832 16.6654 9.66671 19.3334 9.66671H43.5C46.1705 9.66671 48.3334 11.832 48.3334 14.5V43.5C48.3334 46.1705 46.1705 48.3334 43.5 48.3334C36.5908 48.3334 26.245 48.3334 19.3334 48.3334C16.6654 48.3334 14.5 46.1705 14.5 43.5C14.5 40.9335 14.5 38.6667 14.5 38.6667C14.5 37.3351 13.4174 36.25 12.0834 36.25C10.7494 36.25 9.66671 37.3351 9.66671 38.6667ZM27.9995 26.5834L24.8748 23.461C23.9323 22.5161 23.9323 20.9864 24.8748 20.0415C25.8197 19.099 27.3495 19.099 28.292 20.0415L35.542 27.2915C36.4869 28.2364 36.4869 29.7661 35.542 30.711L28.292 37.961C27.3495 38.9035 25.8197 38.9035 24.8748 37.961C23.9323 37.0161 23.9323 35.4864 24.8748 34.5415L27.9995 31.4167H7.25004C5.91604 31.4167 4.83337 30.334 4.83337 29C4.83337 27.6685 5.91604 26.5834 7.25004 26.5834H27.9995Z" fill="white"></path>
                                        </svg>

                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-3 col-sm-6">
                                <div class="card gradient-4 card-bx card-custom-chart">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="me-auto text-white">
                                            <h2 class="text-white">{{ $checkOutToday }}</h2>
                                            <span class="fs-18">Check Out Today</span>
                                        </div>
                                        <svg width="57" height="46" viewBox="0 0 57 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.55512 20.7503L11.4641 17.8435C12.3415 16.9638 12.3415 15.5397 11.4641 14.6601C10.5844 13.7827 9.16031 13.7827 8.28289 14.6601L1.53353 21.4094C0.653858 22.2891 0.653858 23.7132 1.53353 24.5929L8.28289 31.3422C9.16031 32.2197 10.5844 32.2197 11.4641 31.3422C12.3415 30.4626 12.3415 29.0385 11.4641 28.1588L8.55512 25.2498H27.8718C29.1137 25.2498 30.1216 24.2419 30.1216 23C30.1216 21.7604 29.1137 20.7503 27.8718 20.7503H8.55512Z" fill="white"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5038 31.9992V36.4987C16.5038 41.4708 20.5332 45.4979 25.5029 45.4979H48.0008C52.9728 45.4979 57 41.4708 57 36.4987C57 29.0092 57 16.9931 57 9.50129C57 4.53151 52.9728 0.502136 48.0008 0.502136C41.5687 0.502136 31.9373 0.502136 25.5029 0.502136C20.5332 0.502136 16.5038 4.53151 16.5038 9.50129V14.0009C16.5038 15.2427 17.5117 16.2507 18.7536 16.2507C19.9955 16.2507 21.0034 15.2427 21.0034 14.0009C21.0034 14.0009 21.0034 11.8928 21.0034 9.50129C21.0034 7.01752 23.0192 5.00171 25.5029 5.00171H48.0008C50.4868 5.00171 52.5004 7.01752 52.5004 9.50129V36.4987C52.5004 38.9848 50.4868 40.9983 48.0008 40.9983C41.5687 40.9983 31.9373 40.9983 25.5029 40.9983C23.0192 40.9983 21.0034 38.9848 21.0034 36.4987C21.0034 34.1095 21.0034 31.9992 21.0034 31.9992C21.0034 30.7595 19.9955 29.7494 18.7536 29.7494C17.5117 29.7494 16.5038 30.7595 16.5038 31.9992Z" fill="white"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card gradient-2 card-bx card-custom-chart">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="me-auto text-white">
                                            <h2 class="text-white">{{ number_format($totalRooms) }}</h2>
                                            <span class="fs-18">Total Rooms</span>
                                        </div>
                                        <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M36.25 9.66665V7.24998C36.25 5.91598 37.3327 4.83331 38.6667 4.83331C40.0007 4.83331 41.0833 5.91598 41.0833 7.24998V9.66665C46.4242 9.66665 50.75 13.9949 50.75 19.3333V43.5C50.75 48.8384 46.4242 53.1666 41.0833 53.1666C34.1741 53.1666 23.8283 53.1666 16.9167 53.1666C11.5782 53.1666 7.25 48.8384 7.25 43.5V19.3333C7.25 13.9949 11.5782 9.66665 16.9167 9.66665V7.24998C16.9167 5.91598 17.9993 4.83331 19.3333 4.83331C20.6673 4.83331 21.75 5.91598 21.75 7.24998V9.66665H36.25ZM45.9167 29H12.0833V43.5C12.0833 46.168 14.2487 48.3333 16.9167 48.3333H41.0833C43.7537 48.3333 45.9167 46.168 45.9167 43.5V29ZM33.5748 37.8329L36.9822 34.5172C37.9392 33.5868 39.469 33.6086 40.3994 34.5656C41.3298 35.5202 41.3081 37.0523 40.3535 37.9827L35.3848 42.8161C34.4955 43.6788 33.1011 43.732 32.1513 42.9393L29.4302 40.6677C28.4055 39.8146 28.2677 38.2896 29.1232 37.265C29.9763 36.2403 31.5012 36.1026 32.5259 36.9581L33.5748 37.8329ZM41.0833 14.5V16.9166C41.0833 18.2506 40.0007 19.3333 38.6667 19.3333C37.3327 19.3333 36.25 18.2506 36.25 16.9166V14.5H21.75V16.9166C21.75 18.2506 20.6673 19.3333 19.3333 19.3333C17.9993 19.3333 16.9167 18.2506 16.9167 16.9166V14.5C14.2487 14.5 12.0833 16.6629 12.0833 19.3333V24.1666H45.9167V19.3333C45.9167 16.6629 43.7537 14.5 41.0833 14.5Z" fill="white"></path>
                                        </svg>

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="title">Total Booking</h6></div>
                                            <div class="card-tools"><em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Booking"></em></div>
                                        </div>
                                        <div class="card-amount"><span class="amount">{{ number_format($totalBookings) }}</span></div>
                                        <p class="text-soft small mb-2">{{ $dateRangeLabel }}: <strong>{{ number_format($bookingsInRange) }}</strong> bookings</p>
                                        <div class="invest-data">
                                            <div class="invest-data-amount g-2">
                                                <div class="invest-data-history">
                                                    <div class="title">This Month</div>
                                                    <div class="amount">{{ number_format($bookingsThisMonth) }}</div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title">This Week</div>
                                                    <div class="amount">{{ number_format($bookingsThisWeek) }}</div>
                                                </div>
                                            </div>
                                            <div class="invest-data-ck">
                                                <canvas class="iv-data-chart" id="totalBooking"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="title">Rooms Available</h6></div>
                                            <div class="card-tools"><em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Room"></em></div>
                                        </div>
                                        <div class="card-amount"><span class="amount">{{ number_format($totalRooms) }}</span></div>
                                        <div class="invest-data">
                                            <div class="invest-data-amount g-2">
                                                <div class="invest-data-history">
                                                    <div class="title">Bookings (M)</div>
                                                    <div class="amount">{{ number_format($bookingsThisMonth) }}</div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title">Bookings (W)</div>
                                                    <div class="amount">{{ number_format($bookingsThisWeek) }}</div>
                                                </div>
                                            </div>
                                            <div class="invest-data-ck">
                                                <canvas class="iv-data-chart" id="totalRoom"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-bordered  card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="title">Revenue (Paid)</h6></div>
                                            <div class="card-tools"><em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total revenue from paid bookings"></em></div>
                                        </div>
                                        <div class="card-amount"><span class="amount">BDT {{ number_format($totalRevenue, 0) }}</span>
                                        </div>
                                        <p class="text-soft small mb-2">{{ $dateRangeLabel }}: <strong>BDT {{ number_format($revenueInRange, 0) }}</strong></p>
                                        <div class="invest-data">
                                            <div class="invest-data-amount g-2">
                                                <div class="invest-data-history">
                                                    <div class="title">This Month</div>
                                                    <div class="amount">BDT {{ number_format($revenueThisMonth, 0) }}</div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title">This Week</div>
                                                    <div class="amount">BDT {{ number_format($revenueThisWeek, 0) }}</div>
                                                </div>
                                            </div>
                                            <div class="invest-data-ck">
                                                <canvas class="iv-data-chart" id="totalExpenses"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6 col-xxl-3">
                                <div class="card card-bordered h-100">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Room Booking Chart</h6></div>
                                            <div class="card-tools">
                                                <div class="drodown"><a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>7 Days</span></a></li>
                                                            <li><a href="#"><span>15 Days</span></a></li>
                                                            <li><a href="#"><span>30 Days</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="traffic-channel">
                                            <div class="traffic-channel-doughnut-ck">
                                                <canvas class="analytics-doughnut" id="BookingData"></canvas>
                                            </div>
                                            <div class="traffic-channel-group g-2">
                                                <div class="traffic-channel-data">
                                                    <div class="title"><span class="dot dot-lg sq" data-bg="#9cabff"></span><span>Single</span></div>
                                                    <div class="amount">1913 <small>58.63%</small></div>
                                                </div>
                                                <div class="traffic-channel-data">
                                                    <div class="title"><span class="dot dot-lg sq" data-bg="#1ee0ac"></span><span>Double</span></div>
                                                    <div class="amount">859 <small>23.94%</small></div>
                                                </div>
                                                <div class="traffic-channel-data">
                                                    <div class="title"><span class="dot dot-lg sq" data-bg="#f9db7b"></span><span>Delux</span></div>
                                                    <div class="amount">482 <small>12.94%</small></div>
                                                </div>
                                                <div class="traffic-channel-data">
                                                    <div class="title"><span class="dot dot-lg sq" data-bg="#ffa353"></span><span>Suit</span></div>
                                                    <div class="amount">138 <small>4.49%</small></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 col-xxl-5">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner d-flex flex-column h-100">
                                        <div class="card-title-group mb-3">
                                            <div class="card-title me-1">
                                                <h6 class="title">Top Selected Package</h6>
                                                <p>In last 30 days top selected package.</p>
                                            </div>
                                            <div class="card-tools mt-n1 me-n1">
                                                <div class="drodown"><a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>7 Days</span></a></li>
                                                            <li><a href="#"><span>15 Days</span></a></li>
                                                            <li><a href="#"><span>30 Days</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-list gy-3">
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Strater Package</div>
                                                    <div class="progress-amount">58%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar" data-progress="58"></div>
                                                </div>
                                            </div>
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Honeymoon Package</div>
                                                    <div class="progress-amount">43%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-warning" data-progress="43"></div>
                                                </div>
                                            </div>
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Vacation Package</div>
                                                    <div class="progress-amount">33%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-azure" data-progress="33"></div>
                                                </div>
                                            </div>
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Continental Package</div>
                                                    <div class="progress-amount">29%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-pink" data-progress="29"></div>
                                                </div>
                                            </div>
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Spring Package</div>
                                                    <div class="progress-amount">18.49%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-orange" data-progress="18.49"></div>
                                                </div>
                                            </div>
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">All suite Package</div>
                                                    <div class="progress-amount">16%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-teal" data-progress="16"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--  -->
                            <div class="col-xl-12">
                                <div class="nk-content-inner">
                                    <div class="nk-content-body">
                                        <div class="nk-block">
                                            <div class="card card-bordered card-stretch">
                                                <div class="card-inner-group">
                                                    <div class="card-inner position-relative card-tools-toggle">
                                                        <div class="card-title-group">
                                                            <div class="card-tools">
                                                                <div class="form-inline flex-nowrap gx-3">
                                                                    <div class="form-wrap w-150px">
                                                                        <h6 class="title">Booking Lists</h6>
                                                                    </div>
                                                                    <a href="{{ route('super-admin.bookings.index') }}" class="btn btn-sm btn-primary">View All</a>

                                                                </div>
                                                            </div>
                                                            <div class="card-tools me-n1">
                                                                <ul class="btn-toolbar gx-1">
                                                                    <li><a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a></li>
                                                                    <li class="btn-toolbar-sep"></li>
                                                                    <li>
                                                                        <div class="toggle-wrap">
                                                                            <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                                                            <div class="toggle-content" data-content="cardTools">
                                                                                <ul class="btn-toolbar gx-1">
                                                                                    <li class="toggle-close"><a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a></li>
                                                                                    <li>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                                                <div class="dot dot-primary"></div>
                                                                                                <em class="icon ni ni-filter-alt"></em>
                                                                                            </a>
                                                                                            <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                                                                <div class="dropdown-head">
                                                                                                    <span class="sub-title dropdown-title">Filter Bookings</span>
                                                                                                    <div class="dropdown"><a href="#" class="btn btn-sm btn-icon"><em class="icon ni ni-more-h"></em></a></div>
                                                                                                </div>
                                                                                                <div class="dropdown-body dropdown-body-rg">
                                                                                                    <div class="row gx-6 gy-3">
                                                                                                        <div class="col-12">
                                                                                                            <div class="custom-control custom-control-sm custom-checkbox"><input type="checkbox" class="custom-control-input" id="hasEmail"><label class="custom-control-label" for="hasEmail"> Email Verified</label></div>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <div class="form-group">
                                                                                                                <label class="overline-title overline-title-alt">Status</label>
                                                                                                                <select class="form-select js-select2 js-select2-sm select2-hidden-accessible" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                                                                                                    <option value="any" data-select2-id="6">Any Status</option>
                                                                                                                    <option value="paid">Paid</option>
                                                                                                                    <option value="due">Due</option>
                                                                                                                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="5" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-5lmf-container"><span class="select2-selection__rendered" id="select2-5lmf-container" role="textbox" aria-readonly="true" title="Any Status">Any Status</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <div class="form-group">
                                                                                                                <label class="overline-title overline-title-alt">Room Type</label>
                                                                                                                <select class="form-select js-select2 js-select2-sm select2-hidden-accessible" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                                                                                                    <option value="any" data-select2-id="9">Any Type</option>
                                                                                                                    <option value="single">Single</option>
                                                                                                                    <option value="double">Double</option>
                                                                                                                    <option value="delux">Delux</option>
                                                                                                                    <option value="sdelux">Super Delux</option>
                                                                                                                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="8" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-4w51-container"><span class="select2-selection__rendered" id="select2-4w51-container" role="textbox" aria-readonly="true" title="Any Type">Any Type</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-12">
                                                                                                            <div class="form-group"><button type="button" class="btn btn-secondary">Filter</button></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="dropdown-foot between"><a class="clickable" href="#">Reset Filter</a><a href="#">Save Filter</a></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-setting"></em></a>
                                                                                            <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                                                <ul class="link-check">
                                                                                                    <li><span>Show</span></li>
                                                                                                    <li class="active"><a href="#">10</a></li>
                                                                                                    <li><a href="#">20</a></li>
                                                                                                    <li><a href="#">50</a></li>
                                                                                                </ul>
                                                                                                <ul class="link-check">
                                                                                                    <li><span>Order</span></li>
                                                                                                    <li class="active"><a href="#">DESC</a></li>
                                                                                                    <li><a href="#">ASC</a></li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="card-search search-wrap" data-search="search">
                                                            <div class="card-body">
                                                                <div class="search-content"><a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a><input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email"><button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-inner p-0">
                                                        <div class="nk-tb-list nk-tb-ulist">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col nk-tb-col-check">
                                                                    <div class="custom-control custom-control-sm custom-checkbox notext"><input type="checkbox" class="custom-control-input" id="uid"><label class="custom-control-label" for="uid"></label></div>
                                                                </div>
                                                                <div class="nk-tb-col"><span class="sub-text">ID</span></div>
                                                                <div class="nk-tb-col"><span class="sub-text">Customer</span></div>
                                                                <div class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Booking</span></div>
                                                                <div class="nk-tb-col tb-col-lg"><span class="sub-text">Room Type</span></div>
                                                                <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Mobile</span></div>
                                                                <div class="nk-tb-col tb-col-lg"><span class="sub-text">Arrive</span></div>
                                                                <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Depart</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Payment</span></div>
                                                                <div class="nk-tb-col nk-tb-col-tools text-end">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-bs-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                            <ul class="link-tidy sm no-bdr">
                                                                                <li>
                                                                                    <div class="custom-control custom-control-sm custom-checkbox checked"><input type="checkbox" class="custom-control-input" checked="" id="bo"><label class="custom-control-label" for="bo">Booking</label></div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="custom-control custom-control-sm custom-checkbox checked"><input type="checkbox" class="custom-control-input" checked="" id="ph"><label class="custom-control-label" for="ph">Phone</label></div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="custom-control custom-control-sm custom-checkbox"><input type="checkbox" class="custom-control-input" id="pay"><label class="custom-control-label" for="pay">Payment</label></div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @forelse($recentBookings as $booking)
                                                            @php
                                                                $firstRoom = is_array($booking->rooms_data) ? ($booking->rooms_data[0] ?? null) : null;
                                                                $roomName = $firstRoom['roomName'] ?? '-';
                                                                $statusClass = in_array($booking->booking_status ?? '', ['confirmed', 'staying']) ? 'success' : (($booking->booking_status ?? '') === 'cancelled' ? 'danger' : 'warning');
                                                                $payClass = ($booking->payment_status ?? '') === 'paid' ? 'success' : 'warning';
                                                                $initials = strtoupper(mb_substr($booking->guest_name ?? 'G', 0, 2));
                                                            @endphp
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col nk-tb-col-check">
                                                                    <div class="custom-control custom-control-sm custom-checkbox notext"><input type="checkbox" class="custom-control-input" id="uid-{{ $booking->id }}"><label class="custom-control-label" for="uid-{{ $booking->id }}"></label></div>
                                                                </div>
                                                                <div class="nk-tb-col"><span class="text-primary">{{ $booking->invoice_number }}</span></div>
                                                                <div class="nk-tb-col">
                                                                    <a href="{{ route('super-admin.bookings.show', $booking->id) }}">
                                                                        <div class="user-card">
                                                                            <div class="user-avatar bg-primary"><span>{{ $initials }}</span></div>
                                                                            <div class="user-info"><span class="tb-lead">{{ $booking->guest_name }}</span><span>{{ $booking->guest_email ?? '-' }}</span></div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-mb"><span>{{ $firstRoom['hotelName'] ?? '-' }}</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="tb-status text-{{ $statusClass }}">{{ ucfirst($booking->booking_status ?? 'pending') }}</span></div>
                                                                <div class="nk-tb-col tb-col-lg"><span>{{ $roomName }}</span></div>
                                                                <div class="nk-tb-col tb-col-xxl"><span>{{ $booking->guest_phone ?? '-' }}</span></div>
                                                                <div class="nk-tb-col tb-col-lg"><span>{{ $booking->checkin_date ? $booking->checkin_date->format('d M Y') : '-' }}</span></div>
                                                                <div class="nk-tb-col tb-col-xxl"><span>{{ $booking->checkout_date ? $booking->checkout_date->format('d M Y') : '-' }}</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="tb-status text-{{ $payClass }}">{{ ucfirst($booking->payment_status ?? 'unpaid') }}</span></div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li>
                                                                            <div class="drodown">
                                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                                    <ul class="link-list-opt no-bdr">
                                                                                        <li><a href="{{ route('booking.invoice', $booking->id) }}" target="_blank"><em class="icon ni ni-document-fill"></em><span>Invoice</span></a></li>
                                                                                        <li><a href="{{ route('super-admin.bookings.show', $booking->id) }}"><em class="icon ni ni-eye-fill"></em><span>View</span></a></li>
                                                                                        <li><a href="{{ route('super-admin.bookings.edit', $booking->id) }}"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            @empty
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col" style="padding: 20px; text-align: center;"><span class="text-soft">No bookings yet.</span></div>
                                                            </div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                    <div class="card-inner">
                                                        <div class="d-flex justify-content-center justify-content-md-start">
                                                            {{ $recentBookings->links('pagination::bootstrap-4') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->






                            <div class="col-md-6 col-xxl-3">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">New Customer</h6></div>
                                                <div class="card-tools"><a href="{{ route('super-admin.bookings.index') }}" class="link">View All</a></div>
                                            </div>
                                        </div>
                                        @forelse($newCustomers as $customer)
                                        @php
                                            $name = $customer->guest_name ?? 'Guest';
                                            $email = $customer->guest_email ?? '-';
                                            $initials = strtoupper(mb_substr($name, 0, 2));
                                            $colors = ['primary', 'pink', 'warning', 'success', 'danger'];
                                            $color = $colors[$loop->index % count($colors)] ?? 'primary';
                                        @endphp
                                        <div class="card-inner card-inner-md">
                                            <div class="user-card">
                                                <div class="user-avatar bg-{{ $color }}-dim"><span>{{ $initials }}</span></div>
                                                <div class="user-info"><span class="lead-text">{{ $name }}</span><span class="sub-text">{{ $email }}</span></div>
                                                <div class="user-action">
                                                    <div class="drodown"><a href="#" class="dropdown-toggle btn btn-icon btn-trigger me-n1" data-bs-toggle="dropdown" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{ route('super-admin.bookings.index') }}"><em class="icon ni ni-calendar"></em><span>View Bookings</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="card-inner card-inner-md">
                                            <p class="text-soft text-center mb-0">No customers yet.</p>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xxl-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner border-bottom">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Recent Activities</h6></div>
                                            <div class="card-tools">
                                                <ul class="card-tools-nav">
                                                    <li><a href="#"><span>Cancel</span></a></li>
                                                    <li class="active"><a href="#"><span>All</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nk-activity">
                                        @forelse($recentActivities as $activity)
                                        @php
                                            $colors = ['success', 'warning', 'azure', 'purple', 'pink'];
                                            $bg = $colors[$loop->index % count($colors)] ?? 'primary';
                                        @endphp
                                        <li class="nk-activity-item">
                                            <div class="nk-activity-media user-avatar bg-{{ $bg }}">{{ $activity->initials }}</div>
                                            <div class="nk-activity-data">
                                                <div class="label">{{ $activity->label }}</div>
                                                <span class="time">{{ $activity->time }}</span>
                                            </div>
                                        </li>
                                        @empty
                                        <li class="nk-activity-item">
                                            <div class="nk-activity-data">
                                                <div class="label text-soft">No recent activities.</div>
                                            </div>
                                        </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
