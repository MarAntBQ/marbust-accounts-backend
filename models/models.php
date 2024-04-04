<?php
require_once "models/dbconnection.php";

class Datos extends Connection {
    /*Accounts Registration*/
    public static function AccountsRegistrationsModel($name, $email, $phone, $password) {
        $db = Connection::MarbustDBConnect();
        $sql = 'INSERT INTO marbust_accounts (accountName, accountEmail, accountPhone, accountPassword) VALUES (:accountName, :accountEmail, :accountPhone, :accountPassword)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':accountName', $name, PDO::PARAM_STR);
        $stmt->bindValue(':accountEmail', $email, PDO::PARAM_STR);
        $stmt->bindValue(':accountPhone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':accountPassword', $password, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
    public static function checkExistingEmail($email) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT accountEmail FROM marbust_accounts WHERE accountEmail = :email';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchEmail)){
         return 0;
        } else {
         return 1;
        }
    }
    public static function checkExistingPhone($phone) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT accountPhone FROM marbust_accounts WHERE accountPhone = :phone';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->execute();
        $matchPhone = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchPhone)){
         return 0;
        } else {
         return 1;
        }
    }
    
    public static function checkExistingId($idtotransfer) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT MarbustAccountId FROM marbust_accounts WHERE MarbustAccountId = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $idtotransfer, PDO::PARAM_STR);
        $stmt->execute();
        $matchId = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchId)){
         return 0;
        } else {
         return 1;
        }
    }
    
    public static function getUser($email) {
    $db = Connection::MarbustDBConnect();
    $sql = 'SELECT MarbustAccountId, accountName, accountEmail, accountPhone, accountPassword FROM marbust_accounts WHERE accountEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userData;
    }
    
    public static function AccountsChangeDataModel($id, $name, $email, $phone) {
        $db = Connection::MarbustDBConnect();
        $sql = 'UPDATE marbust_accounts SET accountName = :accountName, accountEmail = :accountEmail, accountPhone = :accountPhone WHERE MarbustAccountId = :MarbustAccountId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':accountName', $name, PDO::PARAM_STR);
        $stmt->bindValue(':accountEmail', $email, PDO::PARAM_STR);
        $stmt->bindValue(':accountPhone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':MarbustAccountId', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
    
    public static function getUserInfo($id) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbust_accounts WHERE MarbustAccountId = :MarbustAccountId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $id, PDO::PARAM_INT);
        $stmt->execute();
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $userInfo;
    }
	
    public static function AccountsChangePasswordModel($id, $password) {
        $db = Connection::MarbustDBConnect();
        $sql = 'UPDATE marbust_accounts SET accountPassword = :accountPassword WHERE MarbustAccountId = :MarbustAccountId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':accountPassword', $password, PDO::PARAM_STR);
        $stmt->bindValue(':MarbustAccountId', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
    
    public static function GetAllAccountsModel() {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbust_accounts ORDER BY MarbustAccountId ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	
	public static function GetAllAccountsModelOBN() {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbust_accounts ORDER BY accountName ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	
	public static function GetTotalAccountsModel() {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT COUNT(*) FROM marbust_accounts';
        $stmt = $db->prepare($sql);
        $stmt->execute();
       	$total = $stmt->fetchColumn();
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $total;
    }
	
	public static function DeleteUserModel($userIDtoDelete) {
    $db = Connection::MarbustDBConnect();
    $sql = 'DELETE FROM marbust_accounts WHERE MarbustAccountId = :MarbustAccountId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':MarbustAccountId', $userIDtoDelete, PDO::PARAM_STR);
    $stmt->execute();
	$rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
    }
	
	public static function DeleteComputerModel($ComputerIDtoDelete) {
    $db = Connection::MarbustDBConnect();
    $sql = 'DELETE FROM marbustcomputers_customerscomputers WHERE maintancecomputerId = :maintancecomputerId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':maintancecomputerId', $ComputerIDtoDelete, PDO::PARAM_STR);
    $stmt->execute();
	$rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
    }

    public static function DeleteMaintanceModel( $MaintanceIDtoDelete ) {
        $db = Connection::MarbustDBConnect();
        $sql = 'DELETE FROM marbustcomputers_maintances WHERE maintanceId = :maintanceId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintanceId', $MaintanceIDtoDelete, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
        }
	
	//Marbust Computers Models
	public static function GetTotalUserComputersModel($id) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT COUNT(*) FROM marbustcomputers_customerscomputers WHERE MarbustAccountId = :MarbustAccountId';
        $stmt = $db->prepare($sql);
		$stmt->bindValue(':MarbustAccountId', $id, PDO::PARAM_STR);
        $stmt->execute();
       	$total = $stmt->fetchColumn();
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $total;
    }
	public static function GetTotalCountComputersModel() {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT COUNT(*) FROM marbustcomputers_customerscomputers';
        $stmt = $db->prepare($sql);
        $stmt->execute();
       	$total = $stmt->fetchColumn();
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $total;
    }
	
	public static function GetTotalCountComputersMaintancesModel() {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT COUNT(*) FROM marbustcomputers_maintances';
        $stmt = $db->prepare($sql);
        $stmt->execute();
       	$total = $stmt->fetchColumn();
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $total;
    }
	
	public static function GetMyComputersModel($userId) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_customerscomputers WHERE MarbustAccountId = :MarbustAccountId ORDER BY maintancenextYear ASC, maintancenextMonth ASC, maintancenextDay ASC';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	
	public static function GetAllComputersModel() {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_customerscomputers 
        JOIN marbust_accounts
            ON marbustcomputers_customerscomputers.MarbustAccountId = marbust_accounts.MarbustAccountId
        ORDER BY maintancenextYear DESC, maintancenextMonth DESC, maintancenextDay DESC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
    
    public static function GetAllMaintancesModel() {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_maintances
        JOIN marbust_accounts
             ON marbustcomputers_maintances.MarbustAccountId = marbust_accounts.MarbustAccountId
        JOIN marbustcomputers_customerscomputers
            ON marbustcomputers_maintances.maintancecomputerId = marbustcomputers_customerscomputers.maintancecomputerId
        JOIN marbustcomputers_types
             ON marbustcomputers_maintances.maintancetypeId = marbustcomputers_types.maintancetypeId
        JOIN marbustcomputers_techs
             ON marbustcomputers_maintances.maintancetechId = marbustcomputers_techs.maintancetechId
       ORDER BY maintanceId DESC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	
	public static function GetSpecificTechNameModel($techId) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_techs
        JOIN marbust_accounts
             ON marbustcomputers_techs.MarbustAccountId = marbust_accounts.MarbustAccountId
             WHERE maintancetechId = :maintancetechId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintancetechId', $techId, PDO::PARAM_STR);
        $stmt->execute();
        $accountsData = $stmt->fetch(PDO::FETCH_ASSOC); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	
	public static function GetMyMaintancesCountModel($id) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT COUNT(*) FROM marbustcomputers_maintances WHERE MarbustAccountId = :MarbustAccountId';
        $stmt = $db->prepare($sql);
		$stmt->bindValue(':MarbustAccountId', $id, PDO::PARAM_STR);
        $stmt->execute();
       	$total = $stmt->fetchColumn();
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $total;
    }
	
	public static function GetMyMaintancesModel($id) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_maintances
        JOIN marbustcomputers_customerscomputers
            ON marbustcomputers_maintances.maintancecomputerId = marbustcomputers_customerscomputers.maintancecomputerId
        JOIN marbustcomputers_types
             ON marbustcomputers_maintances.maintancetypeId = marbustcomputers_types.maintancetypeId
        JOIN marbustcomputers_techs
             ON marbustcomputers_maintances.maintancetechId = marbustcomputers_techs.maintancetechId
       WHERE marbustcomputers_maintances.MarbustAccountId = :MarbustAccountId
	   ORDER BY maintanceId DESC';
        $stmt = $db->prepare($sql);
		$stmt->bindValue(':MarbustAccountId', $id, PDO::PARAM_STR);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
  
	public static function checkExistingPC($ComputerName) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT maintancecomputerName FROM marbustcomputers_customerscomputers WHERE maintancecomputerName = :maintancecomputerName';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintancecomputerName', $ComputerName, PDO::PARAM_STR);
        $stmt->execute();
        $matchPC = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchPC)){
         return 0;
        } else {
         return 1;
        }
    }
	
	public static function PCRegistrationModel($MarbustAccountId, $ComputerName, $day, $month, $year) {
        $db = Connection::MarbustDBConnect();
        $sql = 'INSERT INTO marbustcomputers_customerscomputers (MarbustAccountId, maintancecomputerName, 	maintancenextDay, maintancenextMonth, maintancenextYear) VALUES (:MarbustAccountId, :maintancecomputerName, :maintancenextDay, :maintancenextMonth, :maintancenextYear)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $MarbustAccountId, PDO::PARAM_STR);
        $stmt->bindValue(':maintancecomputerName', $ComputerName, PDO::PARAM_STR);
        $stmt->bindValue(':maintancenextDay', $day, PDO::PARAM_STR);
        $stmt->bindValue(':maintancenextMonth', $month, PDO::PARAM_STR);
        $stmt->bindValue(':maintancenextYear', $year, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
	
	public static function checkMaintanceType($KindName) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT maintancetypeName FROM marbustcomputers_types WHERE maintancetypeName = :maintancetypeName';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintancetypeName', $KindName, PDO::PARAM_STR);
        $stmt->execute();
        $matchMaintance = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchMaintance)){
         return 0;
        } else {
         return 1;
        }
    }
	
	public static function MaintanceTypeRegistryModel($KindName, $points, $time) {
        $db = Connection::MarbustDBConnect();
        $sql = 'INSERT INTO marbustcomputers_types (maintancetypeName, maintancetypePoints,  maintancetypeextraTime) VALUES (:maintancetypeName, :maintancetypePoints, :maintancetypeextraTime)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintancetypeName', $KindName, PDO::PARAM_STR);
        $stmt->bindValue(':maintancetypePoints', $points, PDO::PARAM_STR);
        $stmt->bindValue(':maintancetypeextraTime', $time, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
	
	public static function checkExistingTechAccount($idtoverify) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT MarbustAccountId FROM marbustcomputers_techs WHERE MarbustAccountId = :MarbustAccountId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $idtoverify, PDO::PARAM_STR);
        $stmt->execute();
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchEmail)){
         return 0;
        } else {
         return 1;
        }
    }
	
	public static function getTechInfo($userId) {
    $db = Connection::MarbustDBConnect();
    $sql = 'SELECT * FROM marbustcomputers_techs WHERE MarbustAccountId = :MarbustAccountId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':MarbustAccountId', $userId, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userData;
    }
	
	public static function MaintanceTechRegistryModel($MarbustAccountId, $active) {
        $db = Connection::MarbustDBConnect();
        $sql = 'INSERT INTO marbustcomputers_techs (MarbustAccountId, maintancetechActive) VALUES (:MarbustAccountId, :maintancetechActive)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $MarbustAccountId, PDO::PARAM_STR);
        $stmt->bindValue(':maintancetechActive', $active, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
	
	public static function checkExistingComputersAccount($idtoverify) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT MarbustAccountId FROM marbustcomputers_customerscomputers WHERE MarbustAccountId = :MarbustAccountId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $idtoverify, PDO::PARAM_STR);
        $stmt->execute();
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchEmail)){
         return 0;
        } else {
         return 1;
        }
    }
	
	public static function getUserName($id) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT accountName, accountEmail FROM marbust_accounts WHERE MarbustAccountId = :MarbustAccountId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $id, PDO::PARAM_INT);
        $stmt->execute();
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $userInfo;
    }
	
	public static function GetCustomerComputersModel($userId) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_customerscomputers WHERE MarbustAccountId = :MarbustAccountId ORDER BY maintancecomputerName ASC';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	
	public static function GetMaintancesKindsModel() {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_types ORDER BY maintancetypeName ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	
	public static function MonthsforNextMaintanceModel($KindId) {
    $db = Connection::MarbustDBConnect();
    $sql = 'SELECT maintancetypeextraTime FROM marbustcomputers_types WHERE maintancetypeId = :maintancetypeId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':maintancetypeId', $KindId, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userData;
    }
    
    public static function MaintanceUpdateNextDateModel($ComputerId, $month, $day, $year) {
        $db = Connection::MarbustDBConnect();
        $sql = 'UPDATE marbustcomputers_customerscomputers SET maintancenextMonth = :maintancenextMonth, maintancenextDay = :maintancenextDay, maintancenextYear = :maintancenextYear WHERE maintancecomputerId = :maintancecomputerId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintancenextMonth', $month, PDO::PARAM_STR);
        $stmt->bindValue(':maintancenextDay', $day, PDO::PARAM_STR);
        $stmt->bindValue(':maintancenextYear', $year, PDO::PARAM_STR);
        $stmt->bindValue(':maintancecomputerId', $ComputerId, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
	
	public static function MaintanceRegistryModel($MarbustAccountId, $TechId, $ComputerId, $KindId, $day, $month, $year, $description, $promotion) {
        $db = Connection::MarbustDBConnect();
        $sql = 'INSERT INTO marbustcomputers_maintances (MarbustAccountId, maintancecomputerId, maintancedoneDay, maintancedoneMonth, maintancedoneYear, maintanceDescription, maintancetypeId, maintancePromo, maintancetechId) VALUES (:MarbustAccountId, :maintancecomputerId, :maintancedoneDay, :maintancedoneMonth, :maintancedoneYear, :maintanceDescription, :maintancetypeId, :maintancePromo, :maintancetechId)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $MarbustAccountId, PDO::PARAM_STR);
        $stmt->bindValue(':maintancetechId', $TechId, PDO::PARAM_STR);
        $stmt->bindValue(':maintancecomputerId', $ComputerId, PDO::PARAM_STR);
        $stmt->bindValue(':maintancetypeId', $KindId, PDO::PARAM_STR);
        $stmt->bindValue(':maintancedoneDay', $day, PDO::PARAM_STR);
        $stmt->bindValue(':maintancedoneMonth', $month, PDO::PARAM_STR);
        $stmt->bindValue(':maintancedoneYear', $year, PDO::PARAM_STR);
        $stmt->bindValue(':maintanceDescription', $description, PDO::PARAM_STR);
        $stmt->bindValue(':maintancePromo', $promotion, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
    
	public static function MaintanceEditModel($MaintanceId, $description) {
        $db = Connection::MarbustDBConnect();
        $sql = 'UPDATE marbustcomputers_maintances SET maintanceDescription = :maintanceDescription WHERE maintanceId = :maintanceId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintanceDescription', $description, PDO::PARAM_STR);
        $stmt->bindValue(':maintanceId', $MaintanceId, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
	public static function GetComputerData($ComputerId) {
		$db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_customerscomputers WHERE maintancecomputerId = :maintancecomputerId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintancecomputerId', $ComputerId, PDO::PARAM_STR);
        $stmt->execute();
        $accountsData = $stmt->fetch(PDO::FETCH_ASSOC);
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData; 
	}
	
	public static function GetSpecificMaintanceModel($MaintanceId) {
		    $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_maintances
        JOIN marbust_accounts
             ON marbustcomputers_maintances.MarbustAccountId = marbust_accounts.MarbustAccountId
        JOIN marbustcomputers_customerscomputers
            ON marbustcomputers_maintances.maintancecomputerId = marbustcomputers_customerscomputers.maintancecomputerId
        JOIN marbustcomputers_types
             ON marbustcomputers_maintances.maintancetypeId = marbustcomputers_types.maintancetypeId
       WHERE marbustcomputers_maintances.maintanceId =:maintanceId';
        $stmt = $db->prepare($sql);
		$stmt->bindValue(':maintanceId', $MaintanceId, PDO::PARAM_STR);
        $stmt->execute();
        $accountsData = $stmt->fetch(PDO::FETCH_ASSOC); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    
	}
	
	
	public static function PCChangeNameModel($selectedComputerIDtoChange, $ComputerName) {
        $db = Connection::MarbustDBConnect();
        $sql = 'UPDATE marbustcomputers_customerscomputers SET maintancecomputerName = :maintancecomputerName WHERE maintancecomputerId = :maintancecomputerId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintancecomputerId', $selectedComputerIDtoChange, PDO::PARAM_STR);
        $stmt->bindValue(':maintancecomputerName', $ComputerName, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
    
}