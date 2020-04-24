<!DOCTYPE html>
<html lang="en">
<head>
	<title>P-Quick | Log In</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
		body {
			background: #F5F7FA;		
		}	
		.panel-default>.panel-heading {
			color: #fff;
			background: linear-gradient(to right,#00A5A8 0,#4DCBCD 100%) !important;
		}
		.btn-primary {
			border-color: #00A5A8!important;
			background-color: #00B5B8!important;
			color: #FFF;
		}

		.box-login{
			position: fixed;
			top: 50%;
			left: 50%;
			/* bring your own prefixes */
			transform: translate(-50%, -50%);
		}
	</style>
</head>
<body>
	<div class="app-content content container-fluid">
		<div class="content-wrapper">

			<div class="col-xl-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="container">
							<div class="row">
								<div class="col-md-4 box-login">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3 class="panel-title">Please sign in</h3>
										</div>
										<div class="panel-body">
											<fieldset>
												<div class="form-group">
													<input class="form-control" placeholder="E-mail" name="email" type="text">
												</div>
												<div class="form-group">
													<input class="form-control" placeholder="Password" name="password" type="password" value="">
												</div>
												<div class="checkbox">
													<label>
														<input name="remember" type="checkbox" value="Remember Me"> Remember Me
													</label>
												</div>
												<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
												<p class="pull-right"><a href="forgot.php">Forgot Password?</a></p>
											</fieldset>


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
</body>
</html>
