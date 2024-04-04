<?php
function getTemplate() {
	$template = '<header>
	<img src="pages/common-img/marbust-h-logo.png" class="top-logo">
	</header>
	<hr>
	<h1>Mis Computadoras</h1>
	<p>Estimado/s <strong>'.$_SESSION['userData']['accountName'].'</strong> estas son las computadoras registradas en tu cuenta de <strong>Marbust Accounts®</strong> de acuerdo a la frase "'.$_SESSION["ConsultaforprintingMyComputers"].'" como tu busqueda personalizada:</p>
	<div class="table-container">
	<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Próximo Mantenimiento</th>
				</tr>
			</thead>
			<tbody>';
	PDFController::GetMyComputersControllerByQuery($_SESSION["ConsultaforprintingMyComputers"]);
                foreach ($_SESSION['myComputersData'] as $accountData) {
					$year = $accountData["maintancenextYear"];
                    $month = $accountData["maintancenextMonth"];
                    $month = functions::MesName($month);
                    $day = $accountData["maintancenextDay"];
                    $template = $template.'<tr>';
                    $template = $template.'<td>'.$accountData["maintancecomputerId"].'</td>';
                    $template = $template.'<td>'.$accountData["maintancecomputerName"].'</td>';
                    $template = $template.'<td>'.$month.' '.$day.', '.$year.'</td>';
                    $template = $template.'</tr>';
                }
	$template = $template.'</table>';
	$template = $template.'</div>
	<footer>
	<hr>
	<p>Report generated by: <a href="https://accounts.marbust.com">Marbust Accounts® System</a><br>At: '.date('d-m-y h:i:s').'<br>&copy; '.date("Y").' <strong>Marbust Technology Company</strong> - All Rights Reserved</p>
	</footer>';
	
	return $template;
}


	?>