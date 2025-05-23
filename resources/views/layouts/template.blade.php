<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? config('app.name') }}</title>
    <!-- <link rel="shortcut icon" href="assets/images/favicon.png" /> -->
    <link rel="shortcut icon" href="{{ asset('favicon2.ico') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }} ">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/jquery-steps/jquery.steps.css') }} ">

    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendors/dropzone/dropzone.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}"> -->
</head>

<body>
    <div class="main-wrapper">
        @include('layouts/sidebar')

        <div class="page-wrapper">
            @include('layouts/navbar')

            <div class="page-content">
                @yield('content')
            </div>

            @include('layouts/footer')
        </div>
    </div>

    <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-steps/jquery.steps.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/vendors/dropzone/dropzone.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script> -->
    <script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script> -->

    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/wizard.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/typeahead.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/tags-input.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/dropzone.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/dropify.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/datepicker.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/timepicker.js') }}"></script> -->

    <!-- Custom Style -->
    <style>
        #profile_photo_preview {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        .small-icon {
            width: 14px;
            height: 14px;
        }
    </style>

    {{-- Custom Style - Loader --}}
    <style>
        #fullPageLoader {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(255,255,255,0.85);
            justify-content: center;
            align-items: center;
            transition: background 0.3s;
        }
        #fullPageLoader.active {
            display: flex;
        }
    </style>

    {{-- Page : Loader --}}
    <div id="fullPageLoader">
        <div class="loader-anim"></div>
        <div class="loader-text">Loading, please wait...</div>
    </div>

    <!-- Custom Script - Profile Photo Preview -->
    <script>
        //
        document.addEventListener('DOMContentLoaded', function() {
            var profilePhotoInput = document.getElementById('profile_photo');
            if (profilePhotoInput) {
                profilePhotoInput.addEventListener('change', function(event) {
                    const reader = new FileReader();
                    reader.onload = function() {
                        const output = document.getElementById('profile_photo_preview');
                        output.src = reader.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                });
            }
        });
    </script>

    {{-- Custom Script - Loader --}}
    @push('scripts')
    <script>
        $(document).on('submit', 'form', function() {
            $('#fullPageLoader').addClass('active');
        });
    </script>
    @endpush

    @stack('scripts')
</body>
</html>
