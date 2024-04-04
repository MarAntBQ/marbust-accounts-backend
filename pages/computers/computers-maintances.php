<div class="section my-computers">
	<h1>Todas los mantenimientos</h1>
	<p class="tac"><b>Mantenimientos Registrados: </b><?php MarbustController::GetTotalCountAllUsersANDMaintancesComputersController(); echo $_SESSION['TotalCountUsersMaintances'];?></p>
	<input type="text" placeholder="Buscar" id="SearchAllMaintances" class="dblock mauto m10px">
	<div class="flex-hc table" id="resultados">
		<?php
			if (isset($_SESSION["ConsultaforprintingMaintances"])) {
				unset($_SESSION["ConsultaforprintingMaintances"]);
			}
		if (isset($_SESSION["SelectedUserMaintanceid"])){
				unset($_SESSION["SelectedUserMaintanceid"]);
			}
			if (isset($_SESSION["MENSAJECAMBIODATOSPC"])) {
				echo $_SESSION["MENSAJECAMBIODATOSPC"];
				unset($_SESSION["MENSAJECAMBIODATOSPC"]);
			}
               MarbustController::GetAllMaintancesController();
				foreach ($_SESSION['AllMaintancesData'] as $maintanceData) {
					echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
					echo '<p><b>ID:</b><br>'.$maintanceData["maintanceId"].'</p>';
					echo '<p><b>Cliente:</b><br>'.$maintanceData["accountName"].'</p>';
					echo '<p><b>Nombre de Computadora:</b><br>'.$maintanceData["maintancecomputerName"].'</p>';
                    $year = $maintanceData["maintancedoneYear"];
                    $month = $maintanceData["maintancedoneMonth"];
                    $month = functions::MesName($month);
                    $day = $maintanceData["maintancedoneDay"];
					echo '<p><b>Fecha:</b><br>'.$month.' '.$day.', '.$year.'</p>';
					echo '<p><b>Tipo:</b><br>'.$maintanceData["maintancetypeName"].'</p>';
					$promo = $maintanceData["maintancePromo"];
                    if ($promo == "1") {
                        $promo = "Si";
                    } else {
                        $promo = "No";
                    }
					echo '<p><b>Promoción:</b><br>'.$promo.'</p>';
					$techName = Datos::GetSpecificTechNameModel($maintanceData["maintancetechId"]);
					echo '<p><b>Técnico:</b><br>'.$techName["accountName"].'</p>';
					echo '<p class="tac"><a onclick="AdminMaintanceInfo('.$maintanceData["maintanceId"].')"><i class="fas fa-project-diagram"></i> Información</a> | <a onclick="AdminMaintanceEdit('.$maintanceData["maintanceId"].')"><i class="fas fa-pen-square"></i> Editar</a> | <a onclick="AdminMaintanceDelete('.$maintanceData["maintanceId"].')"><i class="fas fa-trash-alt"></i> Eliminar</a></p>';
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
				<a href="PDF/all-maintances-report" class="printbtn" target="_blank"><i class="fas fa-print"></i></a>
			</div>
		</div>
	</div>
</div>
<script src="js/ajax-maintances.js"></script>
