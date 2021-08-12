<!-- cabezote -->
<header class="main-header ">

	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="home" class="logo coloraside">

		<!-- logo mini -->
		<span class="logo-mini">

			<img src="views/img/template/icono-blanco.png" class="img-responsive" style="padding:10px">

		</span>

		<!-- logo normal -->

		<span class="logo-lg">

			<img src="views/img/template/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px">

		</span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top coloraside" role="navigation">

		<!-- Botón de navegación -->

		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

			<span class="sr-only">Toggle navigation</span>

		</a>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">

				<li class="dropdown user user-menu">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php
						if ($_SESSION["picture"] != "") {
							echo '<img src="'.$_SESSION["picture"].'" class="user-image">';
						}else{
							echo '<img src="views/img/users/default/anonymous.png" class="user-image">';

						}
						?>

						<span class="hidden-xs"><?php echo $_SESSION["name"]; ?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu coloraside ">

						<li class="user-body ">

							<div class="pull-right col-xs-12 ">

								<a href="exit" class="btn btn-primary btn-block btn-flat btn-salir" style="color:#fff!important;background-color: #0D1117 !important">Salir</a>

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

</header>