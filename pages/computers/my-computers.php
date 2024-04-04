<div class="section my-computers">
	<h1>Mis Computadoras</h1>
	<p class="tac"><b>Computadoras Registradas: </b><?php MarbustController::GetTotalUserComputersController(); echo $_SESSION['TotalCurrentUserComputers'];?></p>
	<input type="text" placeholder="Buscar" id="SearchEachUserComputers" class="dblock mauto m10px">
	<div class="flex-hc table" id="resultados">
		<?php
			if (isset($_SESSION["ConsultaforprintingMyComputers"])) {
				unset($_SESSION["ConsultaforprintingMyComputers"]);
			}
		if (isset($_SESSION["ConsultaforprintingMyMaintances"])) {
				unset($_SESSION["ConsultaforprintingMyMaintances"]);
			}
		if (isset($_SESSION["SelectedComputerid"])) {
			unset($_SESSION["SelectedComputerid"]);
		}
                MarbustController::GetMyComputersController();
				foreach ($_SESSION['myComputersData'] as $accountData) {
					//$accountData["maintancecomputerId"] <- Variable for ID
					echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
					echo '<p><b>Nombre de Computadora:</b><br>'.$accountData["maintancecomputerName"].'</p>';
                    $year = $accountData["maintancenextYear"];
                    $month = $accountData["maintancenextMonth"];
                    $month = functions::MesName($month);
                    $day = $accountData["maintancenextDay"];
					echo '<p><b>Fecha de próximo Mantenimiento:</b><br>'.$month.' '.$day.', '.$year.'</p>';
					echo '<p class="tac"><a onclick="MyComputersEdit('.$accountData["maintancecomputerId"].')"><i class="fas fa-pen-square"></i> Editar</a></p>';
					echo '</div>';
                }
                /*foreach ($_SESSION['myComputersData'] as $accountData) {
                    echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
                    echo '<p><b>Nombre:</b><br>'.$accountData["accountName"].'</p>';
                    echo '<p class="email-text"><b>Email:</b><br><a href="mailto:'.$accountData["accountEmail"].'">'.substr($accountData["accountEmail"], 0, 15).'******</a></p>';
                    echo '<p><b>Teléfono:</b><br><a href="tel:'.$accountData["accountPhone"].'">'.$accountData["accountPhone"].'</a></p>';
					echo '<p class="tac"><a onclick="AdminEditUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-user-edit"></i> Editar</a> | <a onclick="AdminChangePasswordUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-key"></i> Resetear</a> | <a onclick="AdminDeleteUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-user-times"></i> Eliminar</a></p>';
                    echo '</div>';
                }*/
               
                 ?>
		<div class="box-12 tac mt15px mb15px results-row">
			<div class="options-flex">
				<a href="PDF/my-computers-report" class="printbtn" target="_blank"><i class="fas fa-print"></i></a>
			</div>
		</div>
	</div>
</div>
<script src="js/ajax-my-computers.js"></script>
