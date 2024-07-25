<body id="body-pd">
	<div class="l-navbar scroll" id="nav-bar">
		<header class="header" id="header">
			<?php if ($_SESSION["idpef"]) { ?>
				<div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i></div>
			<?php } ?>
			<div>
				<a href="pmod.php">
					<img class="logocabe" id="pc" src="img/logoynombre.png" alt="Logo GALQUI SAS">
					<img class="logocabe" id="mov" src="img/logo.png" alt="Logo GALQUI SAS">
				</a>
			</div>
			<div class="imgnomper">
				<a href="" style="display: grid; grid-template-columns: max-content max-content; color: #073663;">
					<div class="headernom">
						<small>
							<?php echo (function($name) { return explode(" ", $name)[0]; })($_SESSION["nomper"]) . " " . (function($surname) { return explode(" ", $surname)[0]; })($_SESSION["apeper"]);?>
						<br>
						<small><small><?= $_SESSION["cargo"]; ?></small></small></small>
					</div>
					<i class="fa fa-solid fa-user fa-2x"></i>
				</a>
				<a href="views/vsal.php" style="display: grid; grid-template-columns: max-content max-content; color: #ffffff; margin-left: 10px;">
					<i class="fa fa-solid fa-right-from-bracket fa-2x iconi"></i>
				</a>
			</div>
		</header>
		<?php require_once("views/vmen.php"); ?>
	</div>
</body>