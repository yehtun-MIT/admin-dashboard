<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Myanmar Impact Service</title>

      {{-- Select 2 --}}
      <link rel="stylesheet" href="{{ asset('dashboard/vendors/libs/select2/select2.css') }}" />
    <!-- dashboard:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/images/favicon.png') }}">
  <link rel="stylesheet" href="{{   asset('dashboard/vendors/mdi/css/materialdesignicons.min.css')}}">


    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/rtl/theme-default.css') }}" />

    
    {{-- Datatables Css --}}
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />

  


    {{-- Bootstrap  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    {{-- custom --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/expense.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tree.css') }}">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        .select-2:disabled {
            background-color: #e9ecef !important;
        }
        
        .text-loading {
            color: #4B49AC !important ;
        }
    </style>
    @yield('styles')

</head>

<body>
       <!-- Spinner Start -->
       <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-loading" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ route('home') }}"><img
                        src="{{ asset('dashboard/images/logo.svg') }}" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img
                        src="{{ asset('dashboard/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize"
                    style="box-shadow: none">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                                aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="icon-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="ti-info-alt mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="ti-settings mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="ti-user mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                            id="profileDropdown">
                            <img src="{{ asset('dashboard/images/users/user.png') }}" alt="profile" />
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('admin.user_info.index') }}">
                                <i class="ti-settings text-primary"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ti-power-off text-primary"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            @include('partials.menu')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div>
                        @if (session('message'))
                            <div class="mb-2">
                                <div class="col-lg-12 alert alert-success alert-dismissible" role="alert">
                                    <strong>{{ session('message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                        style="color:black">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (session('wrong_message'))
                            <div class="mb-2">
                                <div class="col-lg-12 alert alert-danger alert-dismissible" role="alert">
                                    <strong>{{ session('wrong_message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if ($errors->count() > 0)
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dashboard/js/dashboard.js') }}"></script>
    <!-- plugins:js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Helpers -->
    <script src="{{ asset('dashboard/vendors/js/helpers.js') }}"></script>
    <script src="{{ asset('dashboard/js/config.js') }}"></script>
   

    {{-- JQuery --}}

    <script src="{{ asset('dashboard/vendors/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- inject:js -->
    <script src="{{ asset('dashboard/js/off-canvas.js') }}"></script>
    <script src="{{ asset('dashboard/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('dashboard/js/template.js') }}"></script>
    <script src="{{ asset('dashboard/js/settings.js') }}"></script>
    <script src="{{ asset('dashboard/js/todolist.js') }}"></script>
    <!-- endinject -->

    {{-- Datatable --}}
    <script src="{{ asset('dashboard/vendors/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/datatables-buttons/datatables-buttons.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/jszip/jszip.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/pdfmake/pdfmake.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/datatables-buttons/buttons.html5.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/libs/datatables-buttons/buttons.print.js') }}"></script>

    {{-- Select 2 --}}
    <script src="{{ asset('dashboard/vendors/libs/select2/select2.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('dashboard/js/main.js') }}"></script>

    {{-- <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>   --}}
    <script>
        function setNoti() {
            var count = localStorage.getItem('count');
            if (count > 0) {
                console.log(count);
                $('#noti').attr('hidden', false);
            } else {
                $('#noti').attr('hidden', true);
            }
            $('#noti').text(count);
        }
        setNoti();
        $('.follow-up').on('click', function() {

            localStorage.setItem('count', 0);
            setNoti();
        })


        $(() => {

            $('.select-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })
            $('.deselect-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
            $('.select2').select2();
            //csv modal
            let csvModal = new bootstrap.Modal(document.getElementById('csvImportModal'));
            $("button[data-toggle='modal']").on('click', () => {
                csvModal.show();
            })

            $("button[data-dismiss='modal']").on('click', () => {
                csvModal.hide();
            })
        });
    </script>
    @yield('scripts')

</body>

</html>
