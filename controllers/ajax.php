<?php
require_once "controllers.php";
require_once "searchAjax.php";
require_once "../functions/functions.php";

//require_once "../models/models.php";

session_start();
class AjaxFunctions {
	public static function ChangeUserData($userIDtoChange) {
		MarbustController::AccountsGotoChangeUserDataController($userIDtoChange);
	}
	// Cuando el usuario busco algo de sus computadoras debe guardarse esa palabra en una variable de sesión, para luego enviar al controlador pdf
	public static function ConsultaforprintingMyComputers($querystring) {
		$_SESSION["ConsultaforprintingMyComputers"] = $querystring;
	}
	
	public static function ConsultaforprintingMyComputers2($querystring) {
		$_SESSION["ConsultaforprintingAllComputers2"] = $querystring;
	}
	public static function ConsultaforprintingMaintances($querystring) {
		$_SESSION["ConsultaforprintingMaintances"] = $querystring;
	}

	public static function ConsultaforprintingMyMaintances($querystring) {
		$_SESSION["ConsultaforprintingMyMaintances"] = $querystring;
	}
	
	public static function SearchUser($consult) {
		if ($consult == "") {
			$respuesta = DatosAjax::UserSearchDefault();
			foreach ($respuesta as $accountData) {
                    echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
                    echo '<p><b>Nombre:</b><br>'.$accountData["accountName"].'</p>';
                    echo '<p class="email-text"><b>Email:</b><br><a href="mailto:'.$accountData["accountEmail"].'">'.substr($accountData["accountEmail"], 0, 15).'******</a></p>';
                    echo '<p><b>Teléfono:</b><br><a href="tel:'.$accountData["accountPhone"].'">'.$accountData["accountPhone"].'</a></p>';
					echo '<p class="tac"><a onclick="AdminEditUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-user-edit"></i> Editar</a> | <a onclick="AdminChangePasswordUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-key"></i> Resetear</a> | <a onclick="AdminDeleteUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-user-times"></i> Eliminar</a></p>';
                    echo '</div>';
                }
		} else {
			
			$respuesta = DatosAjax::UserSearch($consult);
			if (empty($respuesta)) {
				echo "<h1 class='w100p mt15px'>No se han encontrado resultados</h1>";
			} else {
				$count = count($respuesta);
				foreach ($respuesta as $accountData) {
                    echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
                    echo '<p><b>Nombre:</b><br>'.$accountData["accountName"].'</p>';
                    echo '<p class="email-text"><b>Email:</b><br><a href="mailto:'.$accountData["accountEmail"].'">'.substr($accountData["accountEmail"], 0, 15).'******</a></p>';
                    echo '<p><b>Teléfono:</b><br><a href="tel:'.$accountData["accountPhone"].'">'.$accountData["accountPhone"].'</a></p>';
					echo '<p class="tac"><a onclick="AdminEditUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-user-edit"></i> Editar</a> | <a onclick="AdminChangePasswordUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-key"></i> Resetear</a> | <a onclick="AdminDeleteUser('.$accountData["MarbustAccountId"].')"><i class="fas fa-user-times"></i> Eliminar</a></p>';
                    echo '</div>';
                }
				echo '<div class="box-12 tac mt15px mb15px">Coincidencias: <b>'.$count.'</b></div>';
			}
			
		}
	}
	
	public static function SearchEachUserComputers($consult) {
		if (isset($_SESSION["ConsultaforprintingMyComputers"])) {
				unset($_SESSION["ConsultaforprintingMyComputers"]);
			}
		if ($consult == "") {
			$respuesta = DatosAjax::GetMyComputersModelDefault($_SESSION['userData']['MarbustAccountId']);
			foreach ($respuesta as $accountData) {
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
			echo '<div class="box-12 tac mt15px mb15px results-row">
			<div class="options-flex">
				<a href="PDF/my-computers-report" class="printbtn" target="_blank"><i class="fas fa-print"></i></a>
			</div>
		</div>';
		} else {
			
			$respuesta = DatosAjax::GetMyComputersModel($_SESSION['userData']['MarbustAccountId'], $consult);
			if (empty($respuesta)) {
				echo "<h1 class='w100p mt15px'>No se han encontrado resultados</h1>";
			} else {
				$count = count($respuesta);
				foreach ($respuesta as $accountData) {
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
				echo '
				<div class="box-12 tac mt15px mb15px results-row">
			<div class="options-flex">
				<a class="printbtn" onclick="printQuery(';
				echo "'".$consult."'";
				echo ')"><i class="fas fa-print"></i></a>
			</div>
			<p>Coincidencias: <b>'.$count.'</b></p>
			</div>';
			}
			
		}
	}
	
	public static function SearchAllComputers($consult) {
		if (isset($_SESSION["ConsultaforprintingAllComputers2"])) {
				unset($_SESSION["ConsultaforprintingAllComputers2"]);
			}
		if ($consult == "") {
			$respuesta = DatosAjax::GetAllComputersModelDefault();
			foreach ($respuesta as $accountData) {
					//$accountData["maintancecomputerId"] <- Variable for ID
					echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
					 echo '<p><b>Cliente:</b><br>'.$accountData["accountName"].'</p>';
					echo '<p><b>Nombre de Computadora:</b><br>'.$accountData["maintancecomputerName"].'</p>';
                    $year = $accountData["maintancenextYear"];
                    $month = $accountData["maintancenextMonth"];
                    $month = functions::MesName($month);
                    $day = $accountData["maintancenextDay"];
					echo '<p><b>Fecha de próximo Mantenimiento:</b><br>'.$month.' '.$day.', '.$year.'</p>';
					echo '<p class="email-text"><b>Email:</b><br><a href="mailto:'.$accountData["accountEmail"].'">'.substr($accountData["accountEmail"], 0, 15).'******</a></p>';
                    echo '<p><b>Teléfono:</b><br><a href="tel:'.$accountData["accountPhone"].'">'.$accountData["accountPhone"].'</a></p>';
					echo '<p class="tac"><a onclick="AdminComputersEdit('.$accountData["maintancecomputerId"].')"><i class="fas fa-pen-square"></i> Editar</a> | <a onclick="AdminDeleteComputer('.$accountData["maintancecomputerId"].')"><i class="fas fa-trash-alt"></i> Eliminar</a></p>';
					echo '</div>';
                }
			echo '<div class="box-12 tac mt15px mb15px results-row">
			<div class="options-flex">
				<a href="PDF/all-computers-report" class="printbtn" target="_blank"><i class="fas fa-print"></i></a>
			</div>
		</div>';
		} else {
			
			$respuesta = DatosAjax::GetAllComputersModel($consult);
			if (empty($respuesta)) {
				echo "<h1 class='w100p mt15px'>No se han encontrado resultados</h1>";
			} else {
				$count = count($respuesta);
				foreach ($respuesta as $accountData) {
                    //$accountData["maintancecomputerId"] <- Variable for ID
					echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
					 echo '<p><b>Cliente:</b><br>'.$accountData["accountName"].'</p>';
					echo '<p><b>Nombre de Computadora:</b><br>'.$accountData["maintancecomputerName"].'</p>';
                    $year = $accountData["maintancenextYear"];
                    $month = $accountData["maintancenextMonth"];
                    $month = functions::MesName($month);
                    $day = $accountData["maintancenextDay"];
					echo '<p><b>Fecha de próximo Mantenimiento:</b><br>'.$month.' '.$day.', '.$year.'</p>';
					echo '<p class="email-text"><b>Email:</b><br><a href="mailto:'.$accountData["accountEmail"].'">'.substr($accountData["accountEmail"], 0, 15).'******</a></p>';
                    echo '<p><b>Teléfono:</b><br><a href="tel:'.$accountData["accountPhone"].'">'.$accountData["accountPhone"].'</a></p>';
					echo '<p class="tac"><a onclick="AdminComputersEdit('.$accountData["maintancecomputerId"].')"><i class="fas fa-pen-square"></i> Editar</a> | <a onclick="AdminDeleteComputer('.$accountData["maintancecomputerId"].')"><i class="fas fa-trash-alt"></i> Eliminar</a></p>';
					echo '</div>';
                }
				echo '
				<div class="box-12 tac mt15px mb15px results-row">
			<div class="options-flex">
				<a class="printbtn" onclick="printQuery2(';
				echo "'".$consult."'";
				echo ')"><i class="fas fa-print"></i></a>
			</div>
			<p>Coincidencias: <b>'.$count.'</b></p>
			</div>';
			}
			
		}
	}
	
	public static function SearchAllMaintances($consult) {
		if (isset($_SESSION["ConsultaforprintingAllMaintances"])) {
				unset($_SESSION["ConsultaforprintingAllMaintances"]);
			}
		if ($consult == "") {
			$respuesta = DatosAjax::GetAllMaintancesModelDefault();
			foreach ($respuesta as $maintanceData) {
					//$accountData["maintancecomputerId"] <- Variable for ID
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
					$techName = DatosAjax::GetSpecificTechNameModel($maintanceData["maintancetechId"]);
					echo '<p><b>Técnico:</b><br>'.$techName["accountName"].'</p>';
					echo '<p class="tac"><a onclick="AdminMaintanceInfo('.$maintanceData["maintanceId"].')"><i class="fas fa-project-diagram"></i> Información</a> | <a onclick="AdminMaintanceEdit('.$maintanceData["maintanceId"].')"><i class="fas fa-pen-square"></i> Editar</a> | <a onclick="AdminMaintanceDelete('.$maintanceData["maintanceId"].')"><i class="fas fa-trash-alt"></i> Eliminar</a></p>';
					echo '</div>';
                }
			echo '<div class="box-12 tac mt15px mb15px results-row">
			<div class="options-flex">
				<a href="PDF/all-maintances-report" class="printbtn" target="_blank"><i class="fas fa-print"></i></a>
			</div>
		</div>';
		} else {
			
			$respuesta = DatosAjax::GetAllMaintancesModel($consult);
			//var_dump($respuesta);
			if (empty($respuesta)) {
				echo "<h1 class='w100p mt15px'>No se han encontrado resultados</h1>";
			} else {
				$count = count($respuesta);
				foreach ($respuesta as $maintanceData) {
                    //$accountData["maintancecomputerId"] <- Variable for ID
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
					$techName = DatosAjax::GetSpecificTechNameModel($maintanceData["maintancetechId"]);
					echo '<p><b>Técnico:</b><br>'.$techName["accountName"].'</p>';
					echo '<p class="tac"><a onclick="AdminMaintanceInfo('.$maintanceData["maintanceId"].')"><i class="fas fa-project-diagram"></i> Información</a> | <a onclick="AdminMaintanceEdit('.$maintanceData["maintanceId"].')"><i class="fas fa-pen-square"></i> Editar</a> | <a onclick="AdminMaintanceDelete('.$maintanceData["maintanceId"].')"><i class="fas fa-trash-alt"></i> Eliminar</a></p>';
					echo '</div>';
                }
				echo '
				<div class="box-12 tac mt15px mb15px results-row">
			<div class="options-flex">
				<a class="printbtn" onclick="printQuery3(';
				echo "'".$consult."'";
				echo ')"><i class="fas fa-print"></i></a>
			</div>
			<p>Coincidencias: <b>'.$count.'</b></p>
			</div>';
			}
			
		}
	}
	
	public static function SearchMyMaintances($consult) {
		if (isset($_SESSION["ConsultaforprintingMyMaintances"])) {
				unset($_SESSION["ConsultaforprintingMyMaintances"]);
			}
			if ($consult == "") {
				$respuesta = DatosAjax::GetMyMaintancesModelDefault($_SESSION['userData']['MarbustAccountId']);
				foreach ($respuesta as $maintanceData) {
					echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
					echo '<p><b>ID:</b><br>'.$maintanceData["maintanceId"].'</p>';
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
					$techName = DatosAjax::GetSpecificTechNameModel($maintanceData["maintancetechId"]);
					echo '<p><b>Técnico:</b><br>'.$techName["accountName"].'</p>';
					echo '<p class="tac"><a onclick="UserMaintanceInfo('.$maintanceData["maintanceId"].')"><i class="fas fa-project-diagram"></i> Información</a></p>';
					echo '</div>';
					}
				echo '<div class="box-12 tac mt15px mb15px results-row">
				<div class="options-flex">
					<a href="PDF/my-maintances-report" class="printbtn" target="_blank"><i class="fas fa-print"></i></a>
				</div>
			</div>';
			} else {
				
				$respuesta = DatosAjax::GetMyMaintancesModel($_SESSION['userData']['MarbustAccountId'], $consult);
				if (empty($respuesta)) {
					echo "<h1 class='w100p mt15px'>No se han encontrado resultados</h1>";
				} else {
					$count = count($respuesta);
					foreach ($respuesta as $maintanceData) {
						echo '<div class="lh15em card box-4 box-m-6 box-p-10">';
						echo '<p><b>ID:</b><br>'.$maintanceData["maintanceId"].'</p>';
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
						$techName = DatosAjax::GetSpecificTechNameModel($maintanceData["maintancetechId"]);
						echo '<p><b>Técnico:</b><br>'.$techName["accountName"].'</p>';
						echo '<p class="tac"><a onclick="UserMaintanceInfo('.$maintanceData["maintanceId"].')"><i class="fas fa-project-diagram"></i> Información</a></p>';
						echo '</div>';
					}
					echo '
					<div class="box-12 tac mt15px mb15px results-row">
				<div class="options-flex">
					<a class="printbtn" onclick="printQuery4(';
					echo "'".$consult."'";
					echo ')"><i class="fas fa-print"></i></a>
				</div>
				<p>Coincidencias: <b>'.$count.'</b></p>
				</div>';
				}
				
			}
	}
	

}

//Objeto de AJAX
if (isset($_POST["SelectedUserid"])) {
	AjaxFunctions::ChangeUserData($_POST["SelectedUserid"]);
}

//Objeto de AJAX
if (isset($_POST["SearchUser"])) {
	$string = filter_input( INPUT_POST, 'SearchUser', FILTER_SANITIZE_STRING );
	/*var_dump($_POST["SearchUser"]);
	exit;*/
	AjaxFunctions::SearchUser($string);
}

//Busqueda de computadoras de usuario individual
if (isset($_POST["SearchEachUserComputers"])) {
	$string = filter_input( INPUT_POST, 'SearchEachUserComputers', FILTER_SANITIZE_STRING );
	/*var_dump($_POST["SearchUser"]);
	exit;*/
	AjaxFunctions::SearchEachUserComputers($string);
}

//Busqueda de computadoras de Admin
if (isset($_POST["SearchAllComputers"])) {
	$string = filter_input( INPUT_POST, 'SearchAllComputers', FILTER_SANITIZE_STRING );
	/*var_dump($_POST["SearchUser"]);
	exit;*/
	AjaxFunctions::SearchAllComputers($string);
}

if (isset($_POST["SearchAllMaintances"])) {
	$string = filter_input( INPUT_POST, 'SearchAllMaintances', FILTER_SANITIZE_STRING );
	/*var_dump($_POST["SearchUser"]);
	exit;*/
	AjaxFunctions::SearchAllMaintances($string);
}

if (isset($_POST["SearchMyMaintances"])) {
	$string = filter_input( INPUT_POST, 'SearchMyMaintances', FILTER_SANITIZE_STRING );
	/*var_dump($_POST["SearchUser"]);
	exit;*/
	AjaxFunctions::SearchMyMaintances($string);
}

if (isset($_POST["ConsultaforprintingMyComputers"])) {
	AjaxFunctions::ConsultaforprintingMyComputers($_POST["ConsultaforprintingMyComputers"]);
}

if (isset($_POST["ConsultaforprintingMyComputers2"])) {
	AjaxFunctions::ConsultaforprintingMyComputers2($_POST["ConsultaforprintingMyComputers2"]);
}

if (isset($_POST["ConsultaforprintingAllMaintances"])) {
	AjaxFunctions::ConsultaforprintingMaintances($_POST["ConsultaforprintingAllMaintances"]);
}

if (isset($_POST["ConsultaforprintingMyMaintances"])) {
	AjaxFunctions::ConsultaforprintingMyMaintances($_POST["ConsultaforprintingMyMaintances"]);
}

if (isset($_POST["SelectedUserMaintanceid"])) {
	$_SESSION["SelectedUserMaintanceid"] = $_POST["SelectedUserMaintanceid"];
}

if (isset($_POST["SelectedComputerid"])) {
	$_SESSION["SelectedComputerid"] = $_POST["SelectedComputerid"];
}


?>