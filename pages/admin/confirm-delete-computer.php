<?php
if (isset($_SESSION["SelectedComputerid"])) {
 	MarbustController::DeleteComputerController($_SESSION["SelectedComputerid"]);
} else {
	 header( "Location: computers-all-computers" );
     exit;
}

?>
