<!doctype html>
<html lang="en" dir="ltr">
    <head>
        @php
            $logo_fav = App\Models\LogoFavicon::first();
        @endphp
        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Noa – Bootstrap 5 Admin & Dashboard Template">
        <meta name="author" content="Spruko Technologies Private Limited">
        <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

        <!-- FAVICON -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset($logo_fav->favicon??null) }}" />

        <!-- TITLE -->
        <title>Dashboard | Login</title>

        <!-- BOOTSTRAP CSS -->
        <link id="style" href="{{asset('assets/backend')}}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

        <!-- STYLE CSS -->
        <link href="{{asset('assets/backend')}}/css/style.css" rel="stylesheet"/>
        <link href="{{asset('assets/backend')}}/css/skin-modes.css" rel="stylesheet" />

        <!--- FONT-ICONS CSS -->
        <link href="{{asset('assets/backend')}}/css/icons.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- INTERNAL Switcher css -->
        <link href="{{asset('assets/backend')}}/switcher/css/switcher.css" rel="stylesheet" />
        <link href="{{asset('assets/backend')}}/switcher/demo.css" rel="stylesheet" />
    </head>

	<body class="ltr login-img">
		<!-- GLOABAL LOADER -->
		<div id="global-loader">
			<img src="https://php.spruko.com/noa/noa/assets/images/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- /GLOABAL LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div>
				<!-- CONTAINER OPEN -->
				<div class="col col-login mx-auto text-center">
					<a href="{{ route('admin.dashboard') }}" class="text-center">
						<img src="{{ asset($logo_fav->logo??null) }}" class="header-brand-img" alt="logo" style="width: 200px; height: auto; max-height: 80px;">
					</a>
				</div>
				<div class="container-login100">
					<div class="wrap-login100 p-0">
						<div class="card-body">
							<form action="{{ route('admin.login') }}" method="POST" class="login100-form validate-form">
                                @csrf
								<span class="login100-form-title">
									Login
								</span>
								<div class="wrap-input100 validate-input" data-bs-validate = "Valid email is required: ex@abc.xyz">
									<input class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="zmdi zmdi-email" aria-hidden="true"></i>
									</span>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
								</div>
								<div class="wrap-input100 validate-input" data-bs-validate = "Password is required">
									<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="zmdi zmdi-lock" aria-hidden="true"></i>
									</span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
								</div>
                                <button type="submit" class="login100-form-btn btn-primary">
                                    Login
                                </button>
							</form>
						</div>
						<div class="card-footer">
							<div class="d-flex justify-content-center my-3">
								<a href="javascript:void(0)" class="social-login  text-center me-4">
									<i class="fa-brands fa-google-plus-g fa-fw"></i>
								</a>
								<a href="javascript:void(0)" class="social-login  text-center me-4">
									<i class="fa-brands fa-facebook fa-fw"></i>
								</a>
								<a href="javascript:void(0)" class="social-login  text-center">
									<i class="fa-brands fa-x-twitter fa-fw"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- CONTAINER CLOSED -->
			</div>
		</div>
		<!-- End PAGE -->

		<!-- BACKGROUND-IMAGE CLOSED -->


        <!-- JQUERY JS -->
        <script src="{{asset('assets/backend')}}/js/jquery.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="{{asset('assets/backend')}}/plugins/bootstrap/js/popper.min.js"></script>
        <script src="{{asset('assets/backend')}}/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="{{asset('assets/backend')}}/plugins/p-scroll/perfect-scrollbar.js"></script>

        <!-- STICKY JS -->
        <script src="{{asset('assets/backend')}}/js/sticky.js"></script>

        <!-- COLOR THEME JS -->
        <script src="{{asset('assets/backend')}}/js/themeColors.js"></script>

        <!-- CUSTOM JS -->
        <script src="{{asset('assets/backend')}}/js/custom.js"></script>

        <!-- SWITCHER JS -->
        <script src="{{asset('assets/backend')}}/switcher/js/switcher.js"></script>
	</body>
</html>
