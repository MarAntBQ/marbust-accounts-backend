<?php

class Connection {

    /*Conection to the Data Base*/

    public static function MarbustDBConnect() {
       /*Data Base connections
        -------------Marbust Server Settings--------------*/
        $server = 'localhost';
        $dbname = 'DATABASENAME';
        $username = 'databaseusername';
        $password = 'password';
        /*---------------------------------------------------------*/

        $dsn = "mysql:host=$server;dbname=$dbname";
        $options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

        // Create the actual connection object and assign it to a variable
        try {
            $link = new PDO( $dsn, $username, $password, $options );
            //echo 'The connection with your data base was successfully';
            //exit;

            return $link;

        } catch( PDOException $e ) {
            header( 'Location: error-500' );
            exit;
        }
    }
    //MarbustMoneyConnect();
}
?>