<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>

	<script src="https://use.fontawesome.com/4a3b3d9687.js"></script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Free Bulma template</title>
	<link rel="stylesheet" href="http://tendederodeluna.com/css/css/bulma.min.css" />

</head>

<body>
	<section class="hero is-success"  style="background-color:#ff5679;">
		<div class="hero-body">
			<div class="container has-text-centered">
				<div class="column is-4 is-offset-4">
					<h3 class="title" style="color:White;">Acceder</h3>
					<hr class="login-hr">
					<div class="box" style="background-color:#ff5679;">
						<figure class="avatar">
							<img src="http://tendederodeluna.com/images/logo_tendedero_recortado_v2.png">
						</figure>
						<form>
							<div class="field">
								<div class="control has-icons-left">
									<input class="input is-large" type="user" placeholder="Usuario" autofocus="" required>
										<span class="icon is-small is-left">
		                  <i class="fa fa-user"></i>
		                </span>
								</div>
							</div>

							<div class="field">
								<div class="control has-icons-left">
									<input class="input is-large" type="password" placeholder="********" required>
									<span class="icon is-small is-left">
										<i class="fa fa-lock"></i>
									</span>
								</div>
							</div>
							<button class="button is-block is-info is-large is-fullwidth">Acceder <i class="fa fa-sign-in" aria-hidden="true"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script async type="text/javascript" src="../js/bulma.js"></script>
</body>
</html>
