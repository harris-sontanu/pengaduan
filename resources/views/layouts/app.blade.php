<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-static">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', config('app.name'))</title>

    <!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ url('favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ url('favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ url('favicon/site.webmanifest') }}">
	<!-- /favicon -->

	<!-- Global stylesheets -->
	<link href="{{ asset('web/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('web/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('web/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('web/css/style.css') }}" rel="stylesheet" type="text/css">
    @isset ($styles)
        @foreach ($styles as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css">
        @endforeach
    @endisset
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('web/demo/demo_configurator.js') }}"></script>
	<script src="{{ asset('web/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('web/js/jquery/jquery.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	@isset($vendors)
        @foreach ($vendors as $vendor)
            <script src="{{ asset($vendor) }}"></script>
        @endforeach
    @endisset

	<script src="{{ asset('web/js/app.js') }}"></script>
    @yield('script')
	<!-- /theme JS files -->

	<script>
		$(function() {
			var $window = $(window),
				$html = $('#sidebar-main');

			function resize() {
				if ($window.width() > 960 && $window.width() < 1600) {
					return $html.addClass('sidebar-main-resized');
				}

				$html.removeClass('sidebar-main-resized');
			}

			$window
				.resize(resize)
				.trigger('resize');

			$('#search-dropdown').on('keyup change', function() {
				let search 	= $(this).val(),
					dom		= $('#search-dropdown-results');

				if (search.length > 0) {
					$(this).dropdown('show');

					$.get('/legislation/search', {search: search})
					.done(function(html){
						dom.html(html);
					});
				}
			})

			$('body').click(function() {
				$('#search-dropdown').dropdown('hide');
			})

		});
	</script>

</head>

<body>

    @include('layouts.navbar')

    <!-- Page content -->
	<div class="page-content">

        @include('layouts.sidebar')

        <!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

                @include('layouts.header')

				@yield('content')

				@include('layouts.footer')

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

    @yield('modal')

</body>
</html>
