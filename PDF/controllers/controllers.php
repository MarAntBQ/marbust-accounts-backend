<?php
class PDFController {
	public static function GetAllAccountsController() {
        $accountsData = Datos::GetAllAccountsModel();
        /*echo $accountsData[0]['accountId'];
        exit;
        */
        $_SESSION['accountsData'] = $accountsData;
        /*var_dump( $_SESSION['accountsData'] );
        exit;
        */
    }
	public static function GetMyComputersController() {
        $userId = $_SESSION['userData']['MarbustAccountId'];
        $myComputersData = Datos::GetMyComputersModel($userId);
        $_SESSION['myComputersData'] = $myComputersData;
    }
    public static function GetMyMaintancesController() {
        $userId = $_SESSION['userData']['MarbustAccountId'];
        $myComputersData = Datos::GetMyMaintancesModel($userId);
        $_SESSION['myMaintancesData'] = $myComputersData;
    }
	public static function GetMyComputersControllerByQuery($consult) {
        $userId = $_SESSION['userData']['MarbustAccountId'];
        $myComputersData = Datos::GetMyComputersModelByQuery($userId, $consult);
        $_SESSION['myComputersData'] = $myComputersData;
    }
	public static function GetAllComputersController() {
       $_SESSION['AllComputersData'] = Datos::GetAllComputersModel();
    }
	public static function GetAllComputersControllerByQuery($consult) {
       $_SESSION['AllComputersDataQ'] = Datos::GetAllComputersModelByQuery($consult);
    }
	
	public static function GetAllMaintancesController() {
        $_SESSION['AllMaintancesData'] = Datos::GetAllMaintancesModel();
    }

    public static function GetAllMaintancesControllerByQuery($consult) {
        $_SESSION['AllMaintancesDataQ'] = Datos::GetAllMaintancesModelByQuery($consult);
     }
     public static function GetMyMaintancesControllerByQuery($consult) {
        $userId = $_SESSION['userData']['MarbustAccountId'];
        $_SESSION['myMaintancesDataQ'] = Datos::GetMyMaintancesModelByQuery($userId, $consult);
     }
}

?>