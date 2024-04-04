<div class="myaccount">
	<div class="myaccount-setting-flex">
		<div class="left">
			<h1 class="tal">Marbust Computers&reg;</h1>
			<p class="lh2em fs20px fs-m-19px fs-p-18px">Tu ID de <strong>Marbust Accounts&reg;</strong> es: <strong><?php echo $_SESSION['userData']['MarbustAccountId'];?></strong></p>
			<?php
        if (isset($_SESSION["MENSAJECAMBIODATOS"])) {
            echo $_SESSION["MENSAJECAMBIODATOS"];
			unset($_SESSION["MENSAJECAMBIODATOS"]);
        }
			if (isset($_SESSION["MENSAJEREGISTRACIONPC"])) {
            echo $_SESSION["MENSAJEREGISTRACIONPC"];
				unset($_SESSION["MENSAJEREGISTRACIONPC"]);
        }
			if (isset($_SESSION["MENSAJEREGISTRACIONMaintance"])) {
            echo $_SESSION["MENSAJEREGISTRACIONMaintance"];
				unset($_SESSION["MENSAJEREGISTRACIONMaintance"]);
        }
			unset($_SESSION["MENSAJEREGISTRACIONTech"]);
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
			if (isset($_SESSION["ConsultaforprintingMaintances"])) {
				unset($_SESSION["ConsultaforprintingMaintances"]);
			}
			if (isset($_SESSION["ConsultaforprintingMyMaintances"])) {
				unset($_SESSION["ConsultaforprintingMyMaintances"]);
			}
			if (isset($_SESSION["SelectedUserMaintanceid"])){
				unset($_SESSION["SelectedUserMaintanceid"]);
			}
			if (isset($_SESSION["SelectedComputerid"])) {
			unset($_SESSION["ConsultaforprintingMyMaintances"]);
		}
    ?>
		</div>
		<div class="right">
			<a href="dashboard" class="btn-center"><i class="fas fa-home"></i> Dashboard</a>
		</div>
	</div>



</div>
<div class="my-account-options">
	<div class="maor">
		<div class="maor-tittle flex-s-b">
			<h2>Mis Computadoras</h2>
			<a href="computers-my-computers">Ver <i class="fas fa-search"></i></a>
		</div>
		<div class="maor-body">
			<?php
			MarbustController::GetTotalUserComputersController();
			echo '<p><b><i class="fas fa-network-wired"></i> Computadoras Registradas: </b><br>'.$_SESSION['TotalCurrentUserComputers'].'</p>';
			?>
			<p><b><i class="fas fa-cog"></i> Opciones: </b><br><a href="computers-register-my-computer">Registrar nueva <i class="fas fa-plus-circle"></i></a></p>
			<?php
        if ($_SESSION['SUPERADMIN'] == TRUE) {
        echo "<p><b>Función del Sistema: </b><br>Super Administrador</p>";
		echo '<p><a href="computers-register-user-computer">Registrar Computadora de Cliente <i class="fas fa-plus-circle"></i></a></p>';
        }
        if ($_SESSION["AUTECH"] == TRUE && $_SESSION['SUPERADMIN'] == FALSE) {
            echo "<p><b>Función del Sistema: </b><br>Técnico</p>";
		echo '<p><a href="computers-register-user-computer">Registrar Computadora de Cliente <i class="fas fa-plus-circle"></i></a></p>';
        }
        ?>
		</div>
	</div>
	<?php
	 if ($_SESSION['SUPERADMIN'] == TRUE) { 
	
	MarbustController::GetTotalCountAllUsersANDMaintancesComputersController();
	echo '<div class="maor">
	<div class="maor-tittle">
	<h2 class="tal">Administración</h2>
	</div>
	<div class="maor-body">
	<p><b>Computadoras Registradas: </b><br>'.$_SESSION['TotalCountUsersComputers'].'</p>
	<p><b>Mantenimientos Registrados: </b><br>'.$_SESSION['TotalCountUsersMaintances'].'</p>
	<p><b>Funciones: </b></br><a href="computers-all-computers">Ver todas las Computadoras <i class="fas fa-laptop"></i></a></br><a href="computers-maintances">Ver todos los Mantenimientos <i class="fas fa-headset"></i></a></br><a href="computers-register-type-maintances">Registrar tipo de Mantenimiento <i class="fas fa-project-diagram"></i></a></br><a href="computers-register-tech">Registrar técnico <i class="fas fa-users-cog"></i></a></p>
	</div>
	</div>
	';
}
	?>
	<div class="maor">
		<div class="maor-tittle flex-s-b">
			<h2>Mis Mantenimientos</h2>
			<a href="computers-my-maintances">Ver <i class="fas fa-search"></i></a>
		</div>
		<div class="maor-body">
			<?php
			MarbustController::GetMyMaintancesController();
			echo '<p><b><i class="fas fa-headset"></i></a> Mantenimientos Registrados: </b><br>'.$_SESSION['TotalCurrentUserCountMaintances'].'</p>';
			if ($_SESSION['TotalCurrentUserComputers'] != 0) {
				echo '<p><b><i class="fas fa-phone-volume"></i> Próximo mantenimiento:</b></p>
				<p><i class="fas fa-desktop"></i> '.$_SESSION['nextComputerName'].'</p>
				<p><i class="far fa-calendar-alt"></i> '.$_SESSION['nextComputerDate'].'</p>';
			}
			if ($_SESSION['SUPERADMIN'] == TRUE) {
        echo "<p><b>Función del Sistema: </b><br>Super Administrador</p>";
		echo '<p><a href="computers-pre-register-maintance">Registrar Mantenimiento de Cliente <i class="fas fa-plus-circle"></i></a></p>';
        }
            if ($_SESSION["AUTECH"] == TRUE && $_SESSION['SUPERADMIN'] == FALSE) {
            echo "<p><b>Función del Sistema: </b><br>Técnico</p>";
		echo '<p><a href="computers-pre-register-maintance">Registrar Mantenimiento de Cliente <i class="fas fa-plus-circle"></i></a></p>';
        }
			?>
		</div>
	</div>
</div>
