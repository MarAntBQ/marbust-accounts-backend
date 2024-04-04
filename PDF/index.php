<?php
session_start();
require_once "controllers/controllers.php";
require_once "models/models.php";
require_once "../functions/functions.php";
if ( isset( $_GET["path"] ) ) {
    //Si ha declarado ruta
    if ( isset( $_SESSION['loggedin'] ) ) {

    } else {
        $_SESSION['loggedin'] = FALSE;
    }
    if ( $_SESSION['loggedin'] == TRUE ) {
        //Si ha iniciado sesión
        if ( $_SESSION['SUPERADMIN'] == TRUE ) {
            //Si es super admin
            switch ( $_GET["path"] ) {
                case "all-users":
                include "pages/all-users/index.php";
                break;
                case "my-computers-report":
                include "pages/my-computers-report/index.php";
                break;
                case "my-maintances-report":
                include "pages/my-maintances-report/index.php";
                break;
                case "my-maintances-report-by-query":
                if ( isset( $_SESSION["ConsultaforprintingMyMaintances"] ) ) {
                    include "pages/my-maintances-report-by-query/index.php";
                    break;
                } else {
                    header( "Location: ../computers-my-maintances" );
                    exit;
                }
                case "all-computers-report":
                include "pages/all-computers-report/index.php";
                break;
                case "all-maintances-report":
                include "pages/all-maintances-report/index.php";
                break;
                case "my-computers-report-by-query":
                if ( isset( $_SESSION["ConsultaforprintingMyComputers"] ) ) {
                    include "pages/my-computers-report-by-query/index.php";
                    break;
                } else {
                    header( "Location: ../computers-my-computers" );
                    exit;
                }
                case "all-computers-report-by-query":
                if ( isset( $_SESSION["ConsultaforprintingAllComputers2"] ) ) {
                    include "pages/all-computers-report-by-query/index.php";
                    break;
                } else {
                    header( "Location: ../computers-all-computers" );
                    exit;
                }
                case "all-maintances-report-by-query":
                if ( isset( $_SESSION["ConsultaforprintingMaintances"] ) ) {
                    include "pages/all-maintances-report-by-query/index.php";
                    break;
                } else {
                    header( "Location: ../computers-maintances" );
                    exit;
                }
                case "maintance-report":
                    if ( isset( $_SESSION["SelectedUserMaintanceid"] ) ) {
                        include "pages/maintance-report/index.php";
                        break;
                    } else {
                        header( "Location: ../computers" );
                        exit;
                }
                default:
                header( "Location: ../dashboard" );
            }
        } else {
            //Usuario Normal
            switch ( $_GET["path"] ) {
                case "my-computers-report":
                include "pages/my-computers-report/index.php";
                break;
                case "my-maintances-report":
                include "pages/my-maintances-report/index.php";
                break;
                case "my-maintances-report-by-query":
                if ( isset( $_SESSION["ConsultaforprintingMyMaintances"] ) ) {
                    include "pages/my-maintances-report-by-query/index.php";
                    break;
                } else {
                    header( "Location: ../computers-my-maintances" );
                    exit;
                }
                case "my-computers-report-by-query":
                if ( isset( $_SESSION["ConsultaforprintingMyComputers"] ) ) {
                    include "pages/my-computers-report-by-query/index.php";
                    break;
                } else {
                    header( "Location: ../computers-my-computers" );
                    exit;
                }
                case "maintance-report":
                if ( isset( $_SESSION["SelectedUserMaintanceid"] ) ) {
                    $GetMaintanceData = Datos::GetMaintanceData( $_SESSION["SelectedUserMaintanceid"] );
                    if ( $GetMaintanceData["MarbustAccountId"] == $_SESSION['userData']['MarbustAccountId'] ) {
                        include "pages/maintance-report/index.php";
                    } else {
                        header( "Location: ../computers" );
                        exit;
                    }
                    break;
                } else {
                    header( "Location: ../computers" );
                    exit;
                }
                default:
                header( "Location: ../dashboard" );
            }
        }

    } else {
        //Si ha declarado ruta pero no ha iniciado sesión
        header( "Location: ../dashboard" );
    }
} else {
    //Si no ha declarado la ruta por defecto enviarlo al Dashboard
    header( "Location: ../dashboard" );
}

?>