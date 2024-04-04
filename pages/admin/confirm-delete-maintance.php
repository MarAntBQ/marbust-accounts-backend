<?php
if (isset($_SESSION["SelectedUserMaintanceid"])) {
 	MarbustController::DeleteMaintanceController($_SESSION["SelectedUserMaintanceid"]);
} else {
	 header( "Location: computers-maintances" );
     exit;
}

?>