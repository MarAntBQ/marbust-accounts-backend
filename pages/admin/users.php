<div class="section admin-users">
	<h1>Ver usuarios</h1>
	<p class="tac"><b>Usuarios Registrados: </b><?php MarbustController::GetTotalAccountsController(); echo $_SESSION['totalMarbustAccounts'];?></p>
	<input type="text" placeholder="Buscar" id="SearchUser" class="dblock mauto m10px">
	<?php
		if (isset($_SESSION["MENSAJECAMBIODATOSUSUARIO"])) {
			echo $_SESSION["MENSAJECAMBIODATOSUSUARIO"];
			unset($_SESSION["MENSAJECAMBIODATOSUSUARIO"]);
		}
	if (isset($_SESSION['USERIDTOCHANGE']) || isset($_SESSION['USERTOCHANGE'])) {
				unset($_SESSION['USERIDTOCHANGE']);
				unset($_SESSION['USERTOCHANGE']);
			}
		?>

	<div class="flex-hc table" id="resultados">
		<?php
                MarbustController::GetAllAccountsController();
                foreach ($_SESSION['accountsData'] as $accountData) {
                    echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
                    echo '<p><b>Nombre:</b><br>'.$accountData["accountName"].'</p>';
                    echo '<p class="email-text"><b>Email:</b><br><a href="mailto:'.$accountData["accountEmail"].'">'.substr($accountData["accountEmail"], 0, 15).'******</a></p>';
                    echo '<p><b>Teléfono:</b><br><a href="tel:'.$accountData["accountPhone"].'">'.$accountData["accountPhone"].'</a></p>';
					echo '<p class="tac"><a onclick="AdminEditUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-user-edit"></i> Editar</a> | <a onclick="AdminChangePasswordUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-key"></i> Resetear</a> | <a onclick="AdminDeleteUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-user-times"></i> Eliminar</a></p>';
                    echo '</div>';
                }
               
                 ?>
	</div>
</div>
<script src="js/ajax-admin-users.js"></script>
