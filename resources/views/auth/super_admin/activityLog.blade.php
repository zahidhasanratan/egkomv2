@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Account Activity</h4>
                                                <div class="nk-block-des">
                                                    <p>Here is your last 20 login activities log. <span class="text-soft">
                             <em class="icon ni ni-info text-danger"></em>
                           </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside">
                                                    <em class="icon ni ni-menu-alt-r"></em>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block card card-bordered">
                                        <table class="table table-ulogs">
                                            <thead class="table-light">
                                            <tr>
                                                <th class="tb-col-os">
                           <span class="overline-title">Browser <span class="d-sm-none">/ IP</span>
                           </span>
                                                </th>
                                                <th class="tb-col-ip">
                                                    <span class="overline-title">IP</span>
                                                </th>
                                                <th class="tb-col-time">
                                                    <span class="overline-title">Time</span>
                                                </th>
                                                <th class="tb-col-time">
                                                    <span class="overline-title">Activity</span>
                                                </th>
                                                <th class="tb-col-action">
                                                    <span class="overline-title">&nbsp;</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach ($activityLogs as $log)
                                                <tr>
                                                    <!-- Browser -->
                                                    <td class="tb-col-os">{{ $log->browser }} on {{ $log->os }}</td>

                                                    <!-- IP Address -->
                                                    <td class="tb-col-ip">
                                                        <span class="sub-text">{{ $log->ip_address }}</span>
                                                    </td>

                                                    <!-- Activity Time -->
                                                    <td class="tb-col-time">
                                                        <span class="sub-text">{{ \Carbon\Carbon::parse($log->activity_time)->format('h:i A') }}</span>
                                                    </td>

                                                    <!-- Activity -->
                                                    <td class="tb-col-time">
                    <span class="sub-text">
                        <span class="badge
                            @if ($log->activity == 'Logged In') bg-success
                            @elseif ($log->activity == 'Logged Out') bg-danger
                            @else bg-warning
                            @endif ms-0">
                            {{ $log->activity }}
                        </span>
                    </span>
                                                    </td>


                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar="init">


                                       @include('auth.layout.partial.activity_navbar')


                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
