<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Platform Doi Masuk | KPP Pratama Gorontalo</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/logo-dm.png">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<style type="text/css">
		//
		// Pages: Login & Register
		//

		.login-logo,
		.register-logo {
			font-size: 2.1rem;
			font-weight: 300;
			margin-bottom: .9rem;
			text-align: center;

			a {
				color: $gray-700;
			}
		}

		.login-page,
		.register-page {
			align-items: center;
			background-image: url('../assets/img/bg.png');
			/* Full height */
			height: 100%;

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			display: flex;
			height: 100vh;
			justify-content: center;
		}

		.login-box,
		.register-box {
			width: 360px;
			margin-left: 45%;

			@media (max-width: map-get($grid-breakpoints, sm)) {
				margin-top: 20px;
				width: 90%;
			}
		}

		.login-card-body,
		.register-card-body {
			background: $white;
			border-top: 0;
			color: #666;
			padding: 20px;

			.input-group {
				.form-control {
					border-right: 0;

					&:focus {
						box-shadow: none;

						&~.input-group-append .input-group-text {
							border-color: $input-focus-border-color;
						}
					}

					&.is-valid {
						&:focus {
							box-shadow: none;
						}

						&~.input-group-append .input-group-text {
							border-color: $success;
						}
					}

					&.is-invalid {
						&:focus {
							box-shadow: none;
						}

						&~.input-group-append .input-group-text {
							border-color: $danger;
						}
					}
				}

				.input-group-text {
					background-color: transparent;
					border-bottom-right-radius: $border-radius;
					border-left: 0;
					border-top-right-radius: $border-radius;
					color: #777;
					transition: $input-transition;
				}
			}
		}

		.login-box-msg,
		.register-box-msg {
			margin: 0;
			padding: 0 20px 20px;
			text-align: center;
		}

		.social-auth-links {
			margin: 10px 0;
		}

		.center {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 100%;
		}
	</style>
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- <div class="login-logo" style="margin-top: -25%">
			<a href="<?//= site_url() ?>">KPP Pratama <b>Gorontalo</b></a><br>
			<a href="<?//= site_url() ?>">Login <b>Keuangan</b></a>
		</div> -->
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<img src="<?= base_url('assets/img/platdm_new.png'); ?>" alt="" class="center"><br>
				<!-- <p class="login-box-msg">Sign in to start your session</p> -->

				<form action="<?= site_url('auth/process') ?>" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Masukkan NIP / Username" name="nip" autofocus>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="Password" name="password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
						</div>
						<!-- /.col -->
						<div class="col-6">
							<div class="icheck-primary">
								<!-- <input type="checkbox" id="remember">
								<label for="remember">
									Remember Me
								</label> -->
							</div>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>

</body>

</html>