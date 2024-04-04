<div class="myaccount">
	<div class="myaccount-setting-flex">
		<div class="left">
			<h1 class="tal"><?php echo $_SESSION['userData']['accountName'];?></h1>
			<p class="lh2em fs20px fs-m-19px fs-p-18px">Tu ID de <strong>Marbust Accounts&reg;</strong> es: <strong><?php echo $_SESSION['userData']['MarbustAccountId'];?></strong></p>
			<?php
        if (isset($_SESSION["MENSAJECAMBIODATOS"])) {
            echo $_SESSION["MENSAJECAMBIODATOS"];
        }
        unset($_SESSION["MENSAJECAMBIODATOS"]);
			if (isset($_SESSION['USERIDTOCHANGE']) || isset($_SESSION['USERTOCHANGE'])) {
				unset($_SESSION['USERIDTOCHANGE']);
				unset($_SESSION['USERTOCHANGE']);
			}
			if (isset($_SESSION["ConsultaforprintingMyComputers"])) {
				unset($_SESSION["ConsultaforprintingMyComputers"]);
			}
			if (isset($_SESSION["ConsultaforprintingAllComputers2"])) {
				unset($_SESSION["ConsultaforprintingAllComputers2"]);
			}
    ?>
		</div>
		<div class="right">
			<a href="logout" class="btn-center">Cerrar Sesión</a>
		</div>
	</div>



</div>
<div class="my-account-options">
	<div class="maor">
		<div class="maor-tittle flex-s-b">
			<h2>Cuenta</h2>
			<a href="change-my-info">Cambiar <i class="fas fa-edit"></i></a>
		</div>
		<div class="maor-body">
			<p><b>E-mail: </b><br><?php echo substr($_SESSION['userData']['accountEmail'], 0, 15);?>*********</p>
			<p><b>Teléfono: </b><br><?php echo $_SESSION['userData']['accountPhone'];?></p>
			<?php
        if ($_SESSION['SUPERADMIN'] == TRUE) {
        echo "<p><b>Función del Sistema: </b><br>Super Administrador</p>";
        }
        ?>
		</div>
	</div>
	<?php
	 if ($_SESSION['SUPERADMIN'] == TRUE) { 
	
	MarbustController::GetTotalAccountsController();
	echo '<div class="maor">
	<div class="maor-tittle">
	<h2 class="tal">Administración</h2>
	</div>
	<div class="maor-body">
	<p><b>Usuarios Registrados: </b><br>'.$_SESSION['totalMarbustAccounts'].'</p>
	<p><b>Funciones: </b><br><a href="users">Ver usuarios <i class="fas fa-users"></i></a></br><a href="PDF/all-users" target="_blank">Imprimir Lista de usuarios <i class="fas fa-print"></i></a></p>
	</div>
	</div>
	';
		 }
	?>
	<div class="maor">
		<div class="maor-tittle flex-s-b">
			<h2>Seguridad</h2>
			<a href="change-my-password">Cambiar <i class="fas fa-edit"></i></a>
		</div>
		<div class="maor-body">
			<p><b>Tipo: </b><br>Password</p>
			<p><b>2-Steps: </b><br>Disable under Development</p>
		</div>
	</div>
	<div class="maor">
		<div class="maor-tittle flex-s-b">
			<h2>Servicios</h2>
		</div>
		<div class="maor-body">
			<p><b>Haz clic en la imagen correspondiente para acceder al panel del servicio:</b></p>
			<div class="flex-hc">
				<a href="computers" class="box-3 box-i-4 box-m-6 box-p-9 hover-shadow"><img src="img/pages/system/myaccount/computers.png" alt="Computers Service" class="dblock w100p"></a>
				<!--<a href="hosting" class="box-3 box-i-4 box-m-6 box-p-9 hover-shadow"><img src="img/pages/system/myaccount/mbhostcloud.png" alt="MBHostCloud Service" class="dblock w100p"></a>-->
			</div>
		</div>
	</div>
</div>
