<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="shortcut icon" href="../../../favicon2.ico" />

    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400&display=swap" rel="stylesheet">
</head>

<style>
    .auth-left-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .custom-logo {
        max-width: 100px;
    }

    .custom-title {
        font-family: 'Lora', serif;
        font-size: 1.75rem;
        color: #2c3e50;
    }
</style>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">

                                <div class="col-md-3 pr-md-0">
                                    <div class="auth-left-wrapper">
                                        <img src="{{ asset('../logo.png') }}" alt="logo"
                                            class="custom-logo pl-3 ml-3">
                                    </div>
                                </div>
                                <div class="col-md-9 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <h3 class="text-center d-block mb-2 custom-title">
                                            {{ config('app.name') }}
                                        </h3>
                                        @yield('content')
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
</body>
</html>
