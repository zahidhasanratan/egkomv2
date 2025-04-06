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
                                                <h5 class="nk-block-title">Security Settings</h5>
                                                <span>These settings are helps you keep your account secure.</span>
                                                <span class="text-success">
                        <em class="icon ni ni-shield-check"></em>
                      </span>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside">
                                                    <em class="icon ni ni-menu-alt-r"></em>
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="nk-block">
                                        <div class="card card-bordered">
                                            <div class="card-inner-group">
                                                <div class="card-inner">
                                                    <div class="between-center flex-wrap g-3">
                                                        <div class="nk-block-text">
                                                            <h6>Change Password</h6>
                                                            <p>Set a unique password to protect your account.</p>
                                                        </div>
                                                        <div class="nk-block-actions flex-shrink-sm-0">
                                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                                <li class="order-md-last">
                                                                    <a href="#" id="change-password-btn" class="btn btn-primary">Change Password</a>
                                                                </li>
                                                                <li>
                                                                    <em class="text-soft text-date fs-12px">
                                                                        Last changed: <span>@if(Auth::guard('vendor')->user()->updated_at)
                                                                                {{ \Carbon\Carbon::parse(Auth::guard('vendor')->user()->updated_at)->format('M d, Y') }}
                                                                            @else
                                                                                Never
                                                                            @endif</span>
                                                                    </em>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <!-- Password Update Form (Initially Hidden) -->
                                                    <div id="password-update-form" class="mt-3" style="display: none;">


                                                        <form action="{{ route('vendor-admin.update-password') }}" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="new-password">New Password:</label>
                                                                <input type="password" id="new-password" name="password" class="form-control" placeholder="Enter new password" required>

                                                            </div>

                                                            <div class="form-group mt-2">
                                                                <label for="confirm-password">Confirm Password:</label>
                                                                <input type="password" id="confirm-password" name="password_confirmation" class="form-control" placeholder="Confirm new password" required>

                                                            </div>

                                                            <div class="form-group mt-2">
                                                                <button type="submit" class="btn btn-success">Update Password</button>
                                                                <button type="button" id="cancel-btn" class="btn btn-secondary">Cancel</button>
                                                            </div>
                                                        </form>


                                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                                        <script>
                                                            // Check if there is a success message in the session
                                                            @if(session('success'))
                                                            // If the message exists, show a success alert
                                                            Swal.fire({
                                                                icon: 'success',
                                                                title: 'Success',
                                                                text: '{{ session('success') }}',
                                                                showConfirmButton: false,
                                                                timer: 3000
                                                            });
                                                            @endif

                                                            // Check if there is a danger message in the session
                                                            @if(session('danger'))
                                                            // If the message exists, show a danger alert
                                                            Swal.fire({
                                                                icon: 'error',  // Use 'error' for danger messages
                                                                title: 'Error',
                                                                text: '{{ session('danger') }}',  // Danger message from session
                                                                showConfirmButton: false,
                                                                timer: 3000
                                                            });
                                                            @endif
                                                        </script>


                                                    </div>
                                                </div>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function () {
                                                        const changePasswordBtn = document.getElementById("change-password-btn");
                                                        const passwordUpdateForm = document.getElementById("password-update-form");
                                                        const cancelBtn = document.getElementById("cancel-btn");

                                                        // Show the password update form
                                                        changePasswordBtn.addEventListener("click", function (e) {
                                                            e.preventDefault();
                                                            passwordUpdateForm.style.display = "block";
                                                            changePasswordBtn.style.display = "none"; // Hide the "Change Password" button
                                                        });

                                                        // Hide the password update form and reset visibility
                                                        cancelBtn.addEventListener("click", function () {
                                                            passwordUpdateForm.style.display = "none";
                                                            changePasswordBtn.style.display = "inline-block";
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar="init">

                                        @include('auth.layout.partial.vendor_activity_navbar')

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
