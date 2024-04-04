<?php
require_once "../models/dbconnection.php";
class Datos extends Connection {
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
	
	public static function GetMyComputersModelByQuery($userId, $consult) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_customerscomputers WHERE MarbustAccountId = :MarbustAccountId AND (maintancecomputerName LIKE "%'.$consult.'%" OR maintancenextYear LIKE "%'.$consult.'%" OR maintancenextYear LIKE "%'.$consult.'%" OR maintancenextMonth LIKE "%'.$consult.'%" OR maintancenextDay LIKE "%'.$consult.'%") ORDER BY maintancenextYear ASC, maintancenextMonth ASC, maintancenextDay ASC';
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
        ORDER BY maintancenextYear ASC, maintancenextMonth ASC, maintancenextDay ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	
	public static function GetAllComputersModelByQuery($consult) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_customerscomputers 
        JOIN marbust_accounts
            ON marbustcomputers_customerscomputers.MarbustAccountId = marbust_accounts.MarbustAccountId
			WHERE accountName LIKE "%'.$consult.'%" OR accountEmail LIKE "%'.$consult.'%" OR accountPhone LIKE "%'.$consult.'%" OR maintancecomputerName LIKE "%'.$consult.'%" OR maintancenextYear LIKE "%'.$consult.'%" OR maintancenextYear LIKE "%'.$consult.'%" OR maintancenextMonth LIKE "%'.$consult.'%" OR maintancenextDay LIKE "%'.$consult.'%" ORDER BY maintancenextYear ASC, maintancenextMonth ASC, maintancenextDay ASC';
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

    public static function GetAllMaintancesModelByQuery($consult) {
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
			WHERE maintanceId LIKE "%'.$consult.'%" OR accountName LIKE "%'.$consult.'%" OR maintancecomputerName LIKE "%'.$consult.'%" OR maintancedoneYear LIKE "%'.$consult.'%" OR maintancedoneMonth LIKE "%'.$consult.'%" OR maintancedoneDay LIKE "%'.$consult.'%" OR maintanceDescription LIKE "%'.$consult.'%" OR maintancetypeName LIKE "%'.$consult.'%"
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
    
    public static function GetMyMaintancesModelByQuery($userId, $consult) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_maintances
        JOIN marbustcomputers_customerscomputers
            ON marbustcomputers_maintances.maintancecomputerId = marbustcomputers_customerscomputers.maintancecomputerId
        JOIN marbustcomputers_types
             ON marbustcomputers_maintances.maintancetypeId = marbustcomputers_types.maintancetypeId
        JOIN marbustcomputers_techs
             ON marbustcomputers_maintances.maintancetechId = marbustcomputers_techs.maintancetechId
       WHERE marbustcomputers_maintances.MarbustAccountId = :MarbustAccountId
       AND (maintanceId LIKE "%'.$consult.'%" OR maintancecomputerName LIKE "%'.$consult.'%" OR maintancedoneYear LIKE "%'.$consult.'%" OR maintancedoneMonth LIKE "%'.$consult.'%" OR maintancedoneDay LIKE "%'.$consult.'%" OR maintanceDescription LIKE "%'.$consult.'%" OR maintancetypeName LIKE "%'.$consult.'%") 
	   ORDER BY maintanceId DESC';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':MarbustAccountId', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }

    public static function GetMaintanceData($maintanceid) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_maintances
        JOIN marbust_accounts
             ON marbustcomputers_maintances.MarbustAccountId = marbust_accounts.MarbustAccountId
        JOIN marbustcomputers_customerscomputers
            ON marbustcomputers_maintances.maintancecomputerId = marbustcomputers_customerscomputers.maintancecomputerId
        JOIN marbustcomputers_types
             ON marbustcomputers_maintances.maintancetypeId = marbustcomputers_types.maintancetypeId
        
       WHERE marbustcomputers_maintances.maintanceId = :maintanceId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':maintanceId', $maintanceid, PDO::PARAM_STR);
        $stmt->execute();
        $accountsData = $stmt->fetch(PDO::FETCH_ASSOC);
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData; 
    }

}

?>