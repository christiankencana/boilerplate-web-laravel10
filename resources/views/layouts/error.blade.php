<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ $title ?? config('app.name') }}</title>

	<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }} ">
	<link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }} ">
	<link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }} ">
	<link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }} ">
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }} " />
</head>

<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">
				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ asset('assets/vendors/core/core.js') }} "></script>
	<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }} "></script>
	<script src="{{ asset('assets/js/template.js') }} "></script>
</body>

</html>