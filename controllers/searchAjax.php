<?php
require_once "../models/dbconnection.php";


class DatosAjax extends Connection {
	
	public static function UserSearch($consult) {
		$db = Connection::MarbustDBConnect();
        $sql = 'SELECT accountName, MarbustAccountId, accountEmail, accountPhone FROM marbust_accounts WHERE accountName LIKE "%'.$consult.'%" OR accountEmail LIKE "%'.$consult.'%" OR accountPhone LIKE "%'.$consult.'%"';
        $stmt = $db->prepare($sql);
        $stmt->execute();
       $accountsData = $stmt->fetchAll();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	public static function UserSearchDefault() {
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
	
	public static function GetMyComputersModelDefault($userId) {
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

    public static function GetMyMaintancesModelDefault($id) {
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

    public static function GetMyMaintancesModel($userId, $consult) {
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
	
	public static function GetMyComputersModel($userId, $consult) {
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
	
	public static function GetAllComputersModelDefault() {
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
	
	public static function GetAllMaintancesModelDefault() {
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
	
	public static function GetAllMaintancesModel($consult) {
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
	
	public static function GetAllComputersModel($consult) {
        $db = Connection::MarbustDBConnect();
        $sql = 'SELECT * FROM marbustcomputers_customerscomputers 
        JOIN marbust_accounts
            ON marbustcomputers_customerscomputers.MarbustAccountId = marbust_accounts.MarbustAccountId
			WHERE accountName LIKE "%'.$consult.'%" OR accountEmail LIKE "%'.$consult.'%" OR accountPhone LIKE "%'.$consult.'%" OR maintancecomputerName LIKE "%'.$consult.'%" OR maintancenextYear LIKE "%'.$consult.'%" OR maintancenextMonth LIKE "%'.$consult.'%" OR maintancenextDay LIKE "%'.$consult.'%" ORDER BY maintancenextYear ASC, maintancenextMonth ASC, maintancenextDay ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $accountsData = $stmt->fetchAll(); 
        // Close the database interaction
        $stmt->closeCursor();
        
        // Return the indication of success (rows changed)
        return $accountsData;
    }
	
	
}



?>
