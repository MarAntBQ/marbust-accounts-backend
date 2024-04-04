<?php
function getTemplate() {
	$template = '<header>
	<img src="pages/common-img/marbust-h-logo.png" class="top-logo">
	</header>
	<hr>
	<h1>Todas las Computadoras</h1>
	<p>Estimado/s <strong>'.$_SESSION['userData']['accountName'].'</strong> estas son las computadoras registradas en tu Sistema de <strong>Marbust Accounts®:</strong></p>
	<div class="table-container">
	<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Cliente</th>
					<th>Computadora</th>
					<th>Próximo Mantenimiento</th>
					<th>Email</th>
					<th>Teléfono</th>
				</tr>
			</thead>
			<tbody>';
	PDFController::GetAllComputersController();
                foreach ($_SESSION['AllComputersData'] as $accountData) {
					$year = $accountData["maintancenextYear"];
                    $month = $accountData["maintancenextMonth"];
                    $month = functions::MesName($month);
                    $day = $accountData["maintancenextDay"];
                    $template = $template.'<tr>';
                    $template = $template.'<td>'.$accountData["maintancecomputerId"].'</td>';
                    $template = $template.'<td>'.$accountData["accountName"].'</td>';
                    $template = $template.'<td>'.$accountData["maintancecomputerName"].'</td>';
                    $template = $template.'<td>'.$month.' '.$day.', '.$year.'</td>';
                    $template = $template.'<td>'.$accountData["accountEmail"].'</td>';
                    $template = $template.'<td>'.$accountData["accountPhone"].'</td>';
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