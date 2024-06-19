<!DOCTYPE html>
<html lang="en">
<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Noa – PHP Bootstrap 5 Admin & Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/backend')}}/images/brand/favicon.ico"/>

		<!-- TITLE -->
		<title> Dashboard | @yield('title') </title>

        <!-- STYLE -->
        @include('backend.layouts.include.style')
        <!-- /STYLE -->

	</head>

	<body class="ltr app sidebar-mini light-mode">

		<!-- SWITCHER -->
        @include('backend.layouts.include.switcher')
   		<!-- END SWITCHER -->

		<!-- GLOBAL-LOADER -->
		@include('backend.layouts.include.loader')
		<!-- /GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

				<!-- APP-HEADER -->
                @include('backend.layouts.include.header')
				<!-- /APP-HEADER -->

				<!--APP-SIDEBAR-->
                @include('backend.layouts.include.sidebar')
				<!--/APP-SIDEBAR-->



				<!--APP-CONTENT OPEN-->
				{{-- @include('backend.layouts.include.app_content') --}}
                <div class="app-content main-content mt-0">
                    <div class="side-app">
                        <!-- CONTAINER -->
                        <div class="main-container container-fluid">
                            @yield('backend_content')
                        </div>
                    </div>
                </div>

			</div>

			<!--TASK MODAL-->
            @include('backend.layouts.include.task_modal')
            <!--TASK MODAL ENDS-->

			<!-- COUNTRY-SELECTOR MODAL-->
            @include('backend.layouts.include.country_selector')
			<!-- /COUNTRY-SELECTOR MODAL-->

			<!-- FOOTER -->

			@include('backend.layouts.include.footer')

			<!-- FOOTER END -->

		</div>

		<!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

		<!-- SCRIPT -->
        @include('backend.layouts.include.script')
		<!-- /SCRIPT -->
	</body>

</html>
