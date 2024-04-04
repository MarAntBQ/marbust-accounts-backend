<?php
function getTemplate() {
	$template = '<header>
	<img src="pages/common-img/marbust-h-logo.png" class="top-logo">
	</header>
	<hr>
	<h1>Todos los Mantenimientos</h1>
	<p>Estimado/s <strong>'.$_SESSION['userData']['accountName'].'</strong> estos son los mantenimientos registrados en tu Sistema de <strong>Marbust Accounts®:</strong></p>
	<div class="table-container">
	<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Cliente</th>
					<th>Computadora</th>
					<th>Fecha</th>
					<th>Tipo</th>
					<th>Técnico</th>
				</tr>
			</thead>
			<tbody>';
	PDFController::GetAllMaintancesController();
                foreach ($_SESSION['AllMaintancesData'] as $maintanceData) {
					$year = $maintanceData["maintancedoneYear"];
                    $month = $maintanceData["maintancedoneMonth"];
                    $month = functions::MesName($month);
                    $day = $maintanceData["maintancedoneDay"];
                    $template = $template.'<tr>';
                    $template = $template.'<td>'.$maintanceData["maintanceId"].'</td>';
                    $template = $template.'<td>'.$maintanceData["accountName"].'</td>';
                    $template = $template.'<td>'.$maintanceData["maintancecomputerName"].'</td>';
                    $template = $template.'<td>'.$month.' '.$day.', '.$year.'</td>';
                    $template = $template.'<td>'.$maintanceData["maintancetypeName"].'</td>';
					$techName = Datos::GetSpecificTechNameModel($maintanceData["maintancetechId"]);
                    $template = $template.'<td>'.$techName["accountName"].'</td>';
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