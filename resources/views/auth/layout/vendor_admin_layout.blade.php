<!DOCTYPE html>
<html lang="zxx" class="js">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />


<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="{{ asset('assets/super_admin') }}/images/favicon.png">
    <title>Eg Kom Vendor Management Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/super_admin') }}/assets/css/dashlitee1e3.css?ver=3.2.4">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/super_admin') }}/assets/css/themee1e3.css?ver=3.2.4">

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        // Wait for DOM to fully load
        document.addEventListener('DOMContentLoaded', function () {
            const editorIds = [
                'hotel-description',
                'default-textarea1',
                'ChildPolicy',
                'ChildPolicy1',
                'Instruction1',
                'location-direction',
                'location-direction1',
                'additional-policy',
                'pets-details2',
                'extra-bed-policy'
            ];

            // Store initialized editors to prevent re-initialization
            const initializedEditors = {};

            editorIds.forEach(id => {
                const el = document.querySelector(`#${id}`);

                // Check if element exists AND is visible
                if (el && isVisible(el)) {
                    initCKEditor(id, el);
                }
            });

            // Function to initialize CKEditor
            function initCKEditor(id, el) {
                if (initializedEditors[id]) return; // prevent duplicate init

                ClassicEditor
                    .create(el)
                    .then(editor => {
                        initializedEditors[id] = editor;
                    })
                    .catch(error => {
                        console.error(`Failed to initialize CKEditor for #${id}:`, error);
                    });
            }

            // Function to check if element is visible
            function isVisible(el) {
                return !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length);
            }

            // Example: When user toggles the "pets_allowed" dropdown (you can change this part)
            const petsAllowedField = document.querySelector('[name="pets_allowed"]');
            if (petsAllowedField) {
                petsAllowedField.addEventListener('change', function () {
                    const petsInput = document.getElementById('pets-input');
                    const petsTextarea = document.getElementById('pets-details2');

                    if (this.value === 'yes') {
                        petsInput.classList.remove('hidden');
                        initCKEditor('pets-details2', petsTextarea);
                    } else {
                        petsInput.classList.add('hidden');
                    }
                });
            }
        });
    </script>

</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">

<div class="nk-app-root">
    <div class="nk-main ">
        <div class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu">
            <div class="nk-sidebar-element nk-sidebar-head">
                <div class="nk-menu-trigger"><a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-sidebar-brand">
                    <a href="{{ route('vendor-admin.dashboard') }}" class="logo-link nk-sidebar-logo"><img class="logo-light logo-img" src="{{ asset('assets/super_admin') }}/images/logo.png" srcset="{{ asset('assets/super_admin') }}/demo1/images/logo2x.png 2x" alt="logo"><img class="logo-dark logo-img" src="{{ asset('assets/super_admin') }}/images/logo-dark.png" srcset="/demo1/images/logo-dark2x.png 2x" alt="logo-dark"></a>
                </div>
            </div>

            @include('auth.layout.partial.vendor_admin_nav')

        </div>


        <div class="nk-wrap ">
            <div class="nk-header nk-header-fixed">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ms-n1"><a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a></div>
                        <div class="nk-header-brand d-xl-none">
                            <a href="https://dashlite.net/demo1/index.html" class="logo-link"><img class="logo-light logo-img" src="../images/logo.png" srcset="/demo1/images/logo2x.png 2x" alt="logo"><img class="logo-dark logo-img" src="../images/logo-dark.png" srcset="/demo1/images/logo-dark2x.png 2x" alt="logo-dark"></a>
                        </div>
                        <div class="nk-header-news d-none d-xl-block">
                            <div class="nk-news-list">
                                <a class="nk-news-item" href="#">
                                    <div class="nk-news-icon"><em class="icon ni ni-card-view"></em></div>
                                    <div class="nk-news-text">
                                        <p>Do you know the latest update of 2024? <span> A overview of our is now available on YouTube</span></p><em class="icon ni ni-external"></em></div>
                                </a>
                            </div>
                        </div>
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">

                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm"><em class="icon ni ni-user-alt"></em></div>
                                            <div class="user-info d-none d-md-block">
                                                <div class="user-status">Vendor</div>
                                                <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar"><span> {{ strtoupper(substr(Auth::user()->contact_person_name, 0, 2)) }}</span></div>
                                                <div class="user-info"><span class="lead-text">{{ Auth::user()->contact_person_name }}</span><span class="sub-text">{{ Auth::user()->email }}</span></div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                {{--                                                <li><a href="#"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>--}}
                                                <li><a href="{{ route('vendor-admin.accountSettings') }}"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                <li><a href="{{ route('vendor-admin.activityLog') }}"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <form action="{{ route('vendor-admin.logout') }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-link"><em class="icon ni ni-signout"></em><span>Sign out</span></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @yield('mainbody')

            <div class="nk-footer">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> &copy; 2024 Egkom. All Rights Reserved.</div>
                        <div class="nk-footer-links">
                            <ul class="nav nav-sm">
                                <p class="footer-copytext"> <a href="https://www.esoft.com.bd/" target="_blank"> Software Developed by :</a> <span style="font-family:cursive">e-<span style="color:red">S</span>oft</span></p>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="region">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h5 class="title mb-4">Select Your Country</h5>
                <div class="nk-country-region">
                    <ul class="country-list text-center gy-2">
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/arg.png" alt="" class="country-flag"><span class="country-name">Argentina</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/aus.png" alt="" class="country-flag"><span class="country-name">Australia</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/bangladesh.png" alt="" class="country-flag"><span class="country-name">Bangladesh</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/canada.png" alt="" class="country-flag"><span class="country-name">Canada <small>(English)</small></span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/china.png" alt="" class="country-flag"><span class="country-name">Centrafricaine</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/china.png" alt="" class="country-flag"><span class="country-name">China</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/flags/french.png" alt="" class="country-flag"><span class="country-name">France</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/germany.png" alt="" class="country-flag"><span class="country-name">Germany</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/iran.png" alt="" class="country-flag"><span class="country-name">Iran</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/italy.png" alt="" class="country-flag"><span class="country-name">Italy</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/mexico.png" alt="" class="country-flag"><span class="country-name">México</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/philipine.png" alt="" class="country-flag"><span class="country-name">Philippines</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/portugal.png" alt="" class="country-flag"><span class="country-name">Portugal</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/s-africa.png" alt="" class="country-flag"><span class="country-name">South Africa</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/spanish.png" alt="" class="country-flag"><span class="country-name">Spain</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/switzerland.png" alt="" class="country-flag"><span class="country-name">Switzerland</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}images/flags/uk.png" alt="" class="country-flag"><span class="country-name">United Kingdom</span></a>
                        </li>
                        <li>
                            <a href="#" class="country-item"><img src="{{ asset('assets/super_admin') }}/images/flags/english.png" alt="" class="country-flag"><span class="country-name">United State</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="nk-demo-panel nk-demo-panel-2x toggle-slide toggle-slide-right" data-content="demoML" data-toggle-overlay="true" data-toggle-body="true" data-toggle-screen="any">
    <div class="nk-demo-head">
        <h6 class="mb-0">Switch Demo Layout</h6><a class="nk-demo-close toggle btn btn-icon btn-trigger revarse mr-n2" data-target="demoML" href="#"><em class="icon ni ni-cross"></em></a></div>
    <div class="nk-demo-list" data-simplebar>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo1/index.html">
                <div class="nk-demo-image bg-blue"><img class="bg-purple" src="{{ asset('assets/super_admin') }}/images/landing/layout-1d.jpg" srcset="https://dashlite.net/images/landing/layout-1d2x.jpg 2x" alt="Demo Layout 1"></div><span class="nk-demo-title"><strong>Demo Layout 1</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo2/index.html">
                <div class="nk-demo-image bg-purple"><img src="{{ asset('assets/super_admin') }}/images/landing/layout-2d.jpg" srcset="https://dashlite.net/images/landing/layout-2d2x.jpg 2x" alt="Demo Layout 2"></div><span class="nk-demo-title"><strong>Demo Layout 2</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo3/index.html">
                <div class="nk-demo-image bg-success"><img src="{{ asset('assets/super_admin') }}/images/landing/layout-3d.jpg" srcset="https://dashlite.net/images/landing/layout-3d2x.jpg 2x" alt="Demo Layout 3"></div><span class="nk-demo-title"><strong>Demo Layout 3</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo4/index.html">
                <div class="nk-demo-image bg-indigo"><img src="{{ asset('assets/super_admin') }}/images/landing/layout-4d.jpg" srcset="https://dashlite.net/images/landing/layout-4d2x.jpg 2x" alt="Demo Layout 4"></div><span class="nk-demo-title"><strong>Demo Layout 4</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo5/index.html">
                <div class="nk-demo-image bg-orange"><img src="{{ asset('assets/super_admin') }}/images/landing/layout-5d.jpg" srcset="https://dashlite.net/images/landing/layout-5d2x.jpg 2x" alt="Demo Layout 5"></div><span class="nk-demo-title"><strong>Demo Layout 5</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo6/index.html">
                <div class="nk-demo-image bg-purple"><img src="{{ asset('assets/super_admin') }}/images/landing/layout-6d.jpg" srcset="https://dashlite.net/images/landing/layout-6d2x.jpg 2x" alt="Demo Layout 6"></div><span class="nk-demo-title"><strong>Demo Layout 6</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo7/index.html">
                <div class="nk-demo-image bg-teal"><img src="{{ asset('assets/super_admin') }}/images/landing/layout-7d.jpg" srcset="https://dashlite.net/images/landing/layout-7d2x.jpg 2x" alt="Demo Layout 7"></div><span class="nk-demo-title"><strong>Demo Layout 7</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo8/index.html">
                <div class="nk-demo-image bg-azure"><img src="{{ asset('assets/super_admin') }}/images/landing/layout-8d.jpg" srcset="https://dashlite.net/images/landing/layout-8d2x.jpg 2x" alt="Demo Layout 8"></div><span class="nk-demo-title"><strong>Demo Layout 8</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo9/index.html">
                <div class="nk-demo-image bg-pink"><img src="{{ asset('assets/super_admin') }}/images/landing/layout-9d.jpg" srcset="https://dashlite.net/images/landing/layout-9d2x.jpg 2x" alt="Demo Layout 9"></div><span class="nk-demo-title"><strong>Demo Layout 9</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/landing/index.html">
                <div class="nk-demo-image bg-red"><img src="{{ asset('assets/super_admin') }}/images/landing/main-landing.jpg" srcset="https://dashlite.net/images/landing/main-landing2x.jpg 2x" alt="Landing Page"></div><span class="nk-demo-title"><strong>Landing Page</strong> <span class="badge badge-danger ml-1">Free</span></span>
            </a>
        </div>
    </div>
</div>
<div class="nk-demo-panel nk-demo-panel-2x toggle-slide toggle-slide-right" data-content="demoUC" data-toggle-overlay="true" data-toggle-body="true" data-toggle-screen="any">
    <div class="nk-demo-head">
        <h6 class="mb-0">Use Case Concept</h6><a class="nk-demo-close toggle btn btn-icon btn-trigger revarse mr-n2" data-target="demoUC" href="#"><em class="icon ni ni-cross"></em></a></div>
    <div class="nk-demo-list" data-simplebar>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo9/copywriter/index.html">
                <div class="nk-demo-image bg-indigo"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-ai-copywriter.jpg" srcset="https://dashlite.net/images/landing/demo-ai-copywriter2x.jpg 2x" alt="ai-copywriter"></div><span class="nk-demo-title"><em class="text-primary">Demo9</em><br><strong>Ai Copywriter Panel</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo7/pharmacy/index.html">
                <div class="nk-demo-image bg-warning"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-pharmacy.jpg" srcset="https://dashlite.net/images/landing/demo-pharmacy2x.jpg 2x" alt="pharmacy"></div><span class="nk-demo-title"><em class="text-primary">Demo7</em><br><strong>Pharmacy Management Panel</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo5/loan/index.html">
                <div class="nk-demo-image bg-purple"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-loan.jpg" srcset="https://dashlite.net/images/landing/demo-loan2x.jpg 2x" alt="loan"></div><span class="nk-demo-title"><em class="text-primary">Demo5</em><br><strong>Loan Management Panel</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo2/ecommerce/index.html">
                <div class="nk-demo-image bg-dark"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-ecommerce.jpg" srcset="https://dashlite.net/images/landing/demo-ecommerce2x.jpg 2x" alt="Ecommerce"></div><span class="nk-demo-title"><em class="text-primary">Demo2</em><br><strong>E-Commerce Panel</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo2/lms/index.html">
                <div class="nk-demo-image bg-danger"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-lms.jpg" srcset="https://dashlite.net/images/landing/demo-lms2x.jpg 2x" alt="LMS"></div><span class="nk-demo-title"><em class="text-primary">Demo2</em><br><strong>LMS / Learning Management System</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo1/crm/index.html">
                <div class="nk-demo-image bg-info"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-crm.jpg" srcset="https://dashlite.net/images/landing/demo-crm2x.jpg 2x" alt="CRM / Customer Relationship"></div><span class="nk-demo-title"><em class="text-primary">Demo1</em><br><strong>CRM / Customer Relationship Management</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo7/hospital/index.html">
                <div class="nk-demo-image bg-indigo"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-hospital.jpg" srcset="https://dashlite.net/images/landing/demo-hospital2x.jpg 2x" alt="Hospital Managemen"></div><span class="nk-demo-title"><em class="text-primary">Demo7</em><br><strong>Hospital Management</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="index.html">
                <div class="nk-demo-image bg-pink"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-hotel.jpg" srcset="https://dashlite.net/images/landing/demo-hotel2x.jpg 2x" alt="Hotel Managemen"></div><span class="nk-demo-title"><em class="text-primary">Demo1</em><br><strong>Hotel Management</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo3/cms/index.html">
                <div class="nk-demo-image bg-dark"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-cms.jpg" srcset="https://dashlite.net/images/landing/demo-cms2x.jpg 2x" alt="cms"></div><span class="nk-demo-title"><em class="text-primary">Demo3</em><br><strong>CMS Panel</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo5/crypto/index.html">
                <div class="nk-demo-image bg-warning"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-buysell.jpg" srcset="https://dashlite.net/images/landing/demo-buysell2x.jpg 2x" alt="Crypto BuySell / Wallet"></div><span class="nk-demo-title"><em class="text-primary">Demo5</em><br><strong>Crypto BuySell Panel</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo6/invest/index.html">
                <div class="nk-demo-image bg-indigo"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-invest.jpg" srcset="https://dashlite.net/images/landing/demo-invest2x.jpg 2x" alt="HYIP / Investment"></div><span class="nk-demo-title"><em class="text-primary">Demo6</em><br><strong>HYIP / Investment Panel</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo3/apps/file-manager.html">
                <div class="nk-demo-image bg-purple"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-file-manager.jpg" srcset="https://dashlite.net/images/landing/demo-file-manager2x.jpg 2x" alt="File Manager"></div><span class="nk-demo-title"><em class="text-primary">Demo3</em><br><strong>Apps - File Manager</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo4/subscription/index.html">
                <div class="nk-demo-image bg-primary"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-subscription.jpg" srcset="https://dashlite.net/images/landing/demo-subscription2x.jpg 2x" alt="SAAS / Subscription"></div><span class="nk-demo-title"><em class="text-primary">Demo4</em><br><strong>SAAS / Subscription Panel</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/covid/index.html">
                <div class="nk-demo-image bg-danger"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-covid19.jpg" srcset="https://dashlite.net/images/landing/demo-covid192x.jpg 2x" alt="Covid Situation"></div><span class="nk-demo-title"><em class="text-primary">Covid</em><br><strong>Coronavirus Situation</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo3/apps/messages.html">
                <div class="nk-demo-image bg-success"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-messages.jpg" srcset="https://dashlite.net/images/landing/demo-messages2x.jpg 2x" alt="Messages"></div><span class="nk-demo-title"><em class="text-primary">Demo3</em><br><strong>Apps - Messages</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo3/apps/mailbox.html">
                <div class="nk-demo-image bg-purple"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-inbox.jpg" srcset="https://dashlite.net/images/landing/demo-inbox2x.jpg 2x" alt="Inbox"></div><span class="nk-demo-title"><em class="text-primary">Demo3</em><br><strong>Apps - Mailbox</strong></span></a>
        </div>
        <div class="nk-demo-item">
            <a href="https://dashlite.net/demo3/apps/chats.html">
                <div class="nk-demo-image bg-purple"><img src="{{ asset('assets/super_admin') }}/images/landing/demo-chats.jpg" srcset="https://dashlite.net/images/landing/demo-chats2x.jpg 2x" alt="Chats / Messenger"></div><span class="nk-demo-title"><em class="text-primary">Demo3</em><br><strong>Apps - Chats</strong></span></a>
        </div>
    </div>
</div>
<div class="nk-demo-panel toggle-slide toggle-slide-right" data-content="settingPanel" data-toggle-overlay="true" data-toggle-body="true" data-toggle-screen="any">
    <div class="nk-demo-head">
        <h6 class="mb-0">Preview Settings</h6><a class="nk-demo-close toggle btn btn-icon btn-trigger revarse mr-n2" data-target="settingPanel" href="#"><em class="icon ni ni-cross"></em></a></div>
    <div class="nk-opt-panel" data-simplebar>
        <div class="nk-opt-set">
            <div class="nk-opt-set-title">Direction Change</div>
            <div class="nk-opt-list col-2x">
                <div class="nk-opt-item only-text active" data-key="dir" data-update="ltr"><span class="nk-opt-item-bg"><span class="nk-opt-item-name">LTR Mode</span></span>
                </div>
                <div class="nk-opt-item only-text" data-key="dir" data-update="rtl"><span class="nk-opt-item-bg"><span class="nk-opt-item-name">RTL Mode</span></span>
                </div>
            </div>
        </div>
        <div class="nk-opt-set">
            <div class="nk-opt-set-title">Main UI Style</div>
            <div class="nk-opt-list col-2x">
                <div class="nk-opt-item only-text active" data-key="style" data-update="ui-default"><span class="nk-opt-item-bg"><span class="nk-opt-item-name">Default</span></span>
                </div>
                <div class="nk-opt-item only-text" data-key="style" data-update="ui-clean"><span class="nk-opt-item-bg"><span class="nk-opt-item-name">Clean</span></span>
                </div>
                <div class="nk-opt-item only-text" data-key="style" data-update="ui-shady"><span class="nk-opt-item-bg"><span class="nk-opt-item-name">Shady</span></span>
                </div>
                <div class="nk-opt-item only-text" data-key="style" data-update="ui-softy"><span class="nk-opt-item-bg"><span class="nk-opt-item-name">Softy</span></span>
                </div>
            </div>
        </div>
        <div class="nk-opt-set nk-opt-set-aside">
            <div class="nk-opt-set-title">Sidebar Style</div>
            <div class="nk-opt-list col-4x">
                <div class="nk-opt-item" data-key="aside" data-update="is-light"><span class="nk-opt-item-bg is-light"><span class="bg-lighter"></span></span><span class="nk-opt-item-name">White</span></div>
                <div class="nk-opt-item" data-key="aside" data-update="is-default"><span class="nk-opt-item-bg is-light"><span class="bg-light"></span></span><span class="nk-opt-item-name">Light</span></div>
                <div class="nk-opt-item active" data-key="aside" data-update="is-dark"><span class="nk-opt-item-bg"><span class="bg-dark"></span></span><span class="nk-opt-item-name">Dark</span></div>
                <div class="nk-opt-item" data-key="aside" data-update="is-theme"><span class="nk-opt-item-bg"><span class="bg-theme"></span></span><span class="nk-opt-item-name">Theme</span></div>
            </div>
        </div>
        <div class="nk-opt-set nk-opt-set-header">
            <div class="nk-opt-set-title">Header Style</div>
            <div class="nk-opt-list col-4x">
                <div class="nk-opt-item active" data-key="header" data-update="is-light"><span class="nk-opt-item-bg is-light"><span class="bg-lighter"></span></span><span class="nk-opt-item-name">White</span></div>
                <div class="nk-opt-item" data-key="header" data-update="is-default"><span class="nk-opt-item-bg is-light"><span class="bg-light"></span></span><span class="nk-opt-item-name">Light</span></div>
                <div class="nk-opt-item" data-key="header" data-update="is-dark"><span class="nk-opt-item-bg"><span class="bg-dark"></span></span><span class="nk-opt-item-name">Dark</span></div>
                <div class="nk-opt-item" data-key="header" data-update="is-theme"><span class="nk-opt-item-bg"><span class="bg-theme"></span></span><span class="nk-opt-item-name">Theme</span></div>
            </div>
        </div>
        <div class="nk-opt-set nk-opt-set-skin">
            <div class="nk-opt-set-title">Primary Skin</div>
            <div class="nk-opt-list">
                <div class="nk-opt-item active" data-key="skin" data-update="default"><span class="nk-opt-item-bg"><span class="skin-default"></span></span><span class="nk-opt-item-name">Default</span></div>
                <div class="nk-opt-item" data-key="skin" data-update="blue"><span class="nk-opt-item-bg"><span class="skin-blue"></span></span><span class="nk-opt-item-name">Blue</span></div>
                <div class="nk-opt-item" data-key="skin" data-update="egyptian"><span class="nk-opt-item-bg"><span class="skin-egyptian"></span></span><span class="nk-opt-item-name">Egyptian</span></div>
                <div class="nk-opt-item" data-key="skin" data-update="purple"><span class="nk-opt-item-bg"><span class="skin-purple"></span></span><span class="nk-opt-item-name">Purple</span></div>
                <div class="nk-opt-item" data-key="skin" data-update="green"><span class="nk-opt-item-bg"><span class="skin-green"></span></span><span class="nk-opt-item-name">Green</span></div>
                <div class="nk-opt-item" data-key="skin" data-update="red"><span class="nk-opt-item-bg"><span class="skin-red"></span></span><span class="nk-opt-item-name">Red</span></div>
            </div>
        </div>
        <div class="nk-opt-set">
            <div class="nk-opt-set-title">Skin Mode</div>
            <div class="nk-opt-list col-2x">
                <div class="nk-opt-item active" data-key="mode" data-update="light-mode"><span class="nk-opt-item-bg is-light"><span class="theme-light"></span></span><span class="nk-opt-item-name">Light Skin</span></div>
                <div class="nk-opt-item" data-key="mode" data-update="dark-mode"><span class="nk-opt-item-bg"><span class="theme-dark"></span></span><span class="nk-opt-item-name">Dark Skin</span></div>
            </div>
        </div>
        <div class="nk-opt-reset"><a href="#" class="reset-opt-setting">Reset Setting</a></div>
    </div>
</div>


<a class="pmo-st pmo-dark" target="_blank" href="https://softnio.com/get-early-access/">
    <div class="pmo-st-img"><img src="{{ asset('assets/super_admin') }}/images/landing/promo-investorm.png" alt="Investorm"></div>
    <div class="pmo-st-text">Looking for Advanced
        <br> Investment Platform?</div>
</a>



<script src="{{ asset('assets/super_admin') }}/assets/js/bundlee1e3.js?ver=3.2.4"></script>
<script src="{{ asset('assets/super_admin') }}/assets/js/scriptse1e3.js?ver=3.2.4"></script>
<script src="{{ asset('assets/super_admin') }}/assets/js/demo-settingse1e3.js?ver=3.2.4"></script>
<script src="{{ asset('assets/super_admin') }}/assets/js/charts/chart-hotele1e3.js?ver=3.2.4"></script>


</body>

</html>
