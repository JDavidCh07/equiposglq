<body>

	<style>
		.contenido-login {
			background-color: rgba(255, 255, 255, 0.7);
			/* Color de fondo semi-transparente */
			padding: 40px;
			border-radius: 16px;
			backdrop-filter: blur(10px);
			/* Efecto de desenfoque */
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			/* Sombra para destacar el efecto de vidrio */
			margin: 0 auto;
			/* Centrar el div horizontalmente */
			position: relative;

		}

		#username,
		#password {
			color: #073663;
		}

		.contenedor-login {
			display: flex;
			margin: auto;
			align-items: center;
			justify-content: center;
			height: 80vh;
		}
	</style>


	<div class="contenedor-login">
		<div class="contenido-login">
			<form class="form-login" autocomplete="off" method="POST" role="form" action="models/control.php">
				<img class="img2" src="img\logoynombre.png" alt="Logo Galqui">
				<h2 class="h2login">INICIO DE SESIÓN</h2>
				<div class="input-div nit">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<input type="text" name="username" autocomplete="off" placeholder="USUARIO" id="username" required>
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<input type="password" required="true" name="password" placeholder=" CONTRASEÑA" id="password" required>
					</div>
				</div>
				<?php
					$err = isset($_GET['err']) ? $_GET['err'] : NULL;
					if ($err == "s") {
				?>
					<div class="alert alert-danger" id="msg_error" role="alert" style="display: block; margin-top: 20px;">Datos
						Inválidos
					</div>
				<?php } ?>
				<button class="btn" name='login' type="submit">INGRESAR</button>
				<br><br>
				<!-- <a href="views/reg.php" class="forgot-password-link">Registrarse</a><br> -->
				<!-- <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="forgot-password-link">¿Olvidó su Contraseña?</a> -->
			</form>
		</div>
	</div>
</body>

<!-- Modal
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Recuperar contraseña</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="index.php" method="POST">
				<div class="modal-body">
					<input type="email" class="form-control form-control-sm" name="emaper" placeholder="Ingrese su e-mail" required>
					<input type="hidden" name="acte" value="chgPwd">
					<br><small><small><strong>Por favor revise su correo, ahí se le indicarán los pasos a seguir.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn bin-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button typer="submit" class="btn btn-primary">Enviar</button>
				</div>
			</form>
		</div>
	</div>
</div> -->