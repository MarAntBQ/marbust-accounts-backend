<?php

class Templatectr {
    public static function getPageNames() {
        if ( isset( $_GET["path"] ) ) {
            //If it's a path declared
            if ( isset( $_SESSION['loggedin'] ) ) {

            } else {
                $_SESSION['loggedin'] = FALSE;
            }
            if ( $_SESSION['loggedin'] == TRUE ) {
				//if it's logged
            MarbustController::AccountsActiveSessionController();
            if ( $_SESSION['SUPERADMIN'] == TRUE ) {
                switch ( $_GET["path"] ) {
                    //If it's super admin
                        case "dashboard":
                        $GLOBALS["Page-Name"] = "Mi Cuenta | ".$_SESSION['userData']['accountName'];
                        $GLOBALS["Page-Location"] = "pages/system/my-account.php";
                        break;
						case "my-info":
                        $GLOBALS["Page-Name"] = "Mi Info";
                        $GLOBALS["Page-Location"] = "pages/system/my-info.php";
                        break;
                        case "logout":
                        $GLOBALS["Page-Name"] = "Cerrar Sesión";
                        $GLOBALS["Page-Location"] = "pages/system/logout.php";
                        break;
                        case "users":
                        $GLOBALS["Page-Name"] = "Ver usuarios";
                        $GLOBALS["Page-Location"] = "pages/admin/users.php";
                        break;
                        case "change-user-data":
                        if ( isset( $_SESSION['USERIDTOCHANGE'] ) || isset( $_SESSION['USERTOCHANGE'] ) ) {
                            $GLOBALS["Page-Name"] = "Cambiar Datos del Usuario";
                            $GLOBALS["Page-Location"] = "pages/admin/change-user-data.php";
                            break;
                        } else {
                            header( "Location: users" );
                            exit;
                        }

                        case "change-my-info":
                        $GLOBALS["Page-Name"] = "Cambiar mis Datos";
                        $GLOBALS["Page-Location"] = "pages/system/change-my-info.php";
                        break;
                        case "change-my-password":
                        $GLOBALS["Page-Name"] = "Cambiar mi Password";
                        $GLOBALS["Page-Location"] = "pages/system/change-my-password.php";
                        break;
                        case "change-user-password":
                        if ( isset( $_SESSION['USERIDTOCHANGE'] ) || isset( $_SESSION['USERTOCHANGE'] ) ) {
                            $GLOBALS["Page-Name"] = "Cambiar Password de Usuario";
                            $GLOBALS["Page-Location"] = "pages/admin/change-user-password.php";
                            break;
                        } else {
                            header( "Location: users" );
                            exit;
                        }
                        case "confirm-delete-user":
                        if ( isset( $_SESSION['USERIDTOCHANGE'] ) || isset( $_SESSION['USERTOCHANGE'] ) ) {
                            $GLOBALS["Page-Name"] = "Eliminar usuario";
                            $GLOBALS["Page-Location"] = "pages/admin/confirm-delete-user.php";
                            break;
                        } else {
                            header( "Location: users" );
                            exit;
                        }
						//Cases for Marbust Computers
						case "computers":
                        $GLOBALS["Page-Name"] = "Marbust Computers&reg; | Mi Cuenta";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-dashboard.php";
                        break;
						case "computers-my-computers":
                        $GLOBALS["Page-Name"] = "Mis Computadoras";
                        $GLOBALS["Page-Location"] = "pages/computers/my-computers.php";
                        break;
						case "computers-all-computers":
                        $GLOBALS["Page-Name"] = "Todas las Computadoras";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-all-computers.php";
                        break;
						case "computers-maintances":
                        $GLOBALS["Page-Name"] = "Todas los Mantenimientos";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-maintances.php";
                        break;
						case "computers-my-maintances":
                        $GLOBALS["Page-Name"] = "Todos mis Mantenimientos";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-my-maintances.php";
                        break;
						case "computers-register-my-computer":
                        $GLOBALS["Page-Name"] = "Registrar mi Computadora";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-register-my-computer.php";
                        break;
						case "computers-register-user-computer":
                        $GLOBALS["Page-Name"] = "Registrar Computadora de Cliente";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-register-user-computer.php";
                        break;
						case "computers-register-type-maintances":
                        $GLOBALS["Page-Name"] = "Registrar tipo de Mantenimiento";
                        $GLOBALS["Page-Location"] = "pages/computers/register-type-maintances.php";
                        break;
						case "computers-register-tech":
                        $GLOBALS["Page-Name"] = "Registrar Técnico";
                        $GLOBALS["Page-Location"] = "pages/computers/register-tech.php";
                        break;
						case "computers-pre-register-maintance":
                        $GLOBALS["Page-Name"] = "Registrar Mantenimiento | Parte 1";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-pre-register-maintance.php";
                        break;
						case "computers-register-maintance":
						if (isset($_SESSION["CurrentCustomerIdMaintance"])) {
							$GLOBALS["Page-Name"] = "Registrar Mantenimiento | Parte 2";
                        	$GLOBALS["Page-Location"] = "pages/computers/computers-register-maintance.php";
							break;
						} else {
							header( "Location: computers-pre-register-maintance" );
                            exit;
						}
                        case "change-computer-data":
						if ($_SESSION["SelectedComputerid"]) {
							 $GLOBALS["Page-Name"] = "Cambiar nombre de Computadora";
							$GLOBALS["Page-Location"] = "pages/computers/change-computer-data.php";
                        	break;
						} else {
							header( "Location: computers" );
                            exit;
						}
						case "confirm-delete-computer":
                        if ( isset( $_SESSION["SelectedComputerid"] ) || isset( $_SESSION['COMPUTERTOCHANGE'] ) ) {
                            $GLOBALS["Page-Name"] = "Eliminar Computadora";
                            $GLOBALS["Page-Location"] = "pages/admin/confirm-delete-computer.php";
                            break;
                        } else {
                            header( "Location: computers-all-computers" );
                            exit;
                        }
                        case "confirm-delete-maintance":
                            if ( isset( $_SESSION["SelectedUserMaintanceid"] ) ) {
                                $GLOBALS["Page-Name"] = "Eliminar Mantenimiento";
                                $GLOBALS["Page-Location"] = "pages/admin/confirm-delete-maintance.php";
                                break;
                            } else {
                                header( "Location: computers-maintances" );
                                exit;
                        }
						case "edit-maintance-info":
						if ($_SESSION["SelectedUserMaintanceid"]) {
							 $GLOBALS["Page-Name"] = "Cambiar Mantenimiento";
							$GLOBALS["Page-Location"] = "pages/computers/edit-maintance-info.php";
                        	break;
						} else {
							header( "Location: computers-maintances" );
                            exit;
						}
                        default:
                        header( "Location: dashboard" );
                    }
                } else {
					//If it's normal user
                    switch ( $_GET["path"] ) {
                        case "dashboard":
                        $GLOBALS["Page-Name"] = "Mi Cuenta | ".$_SESSION['userData']['accountName'];
                        $GLOBALS["Page-Location"] = "pages/system/my-account.php";
                        break;
                        case "logout":
                        $GLOBALS["Page-Name"] = "Cerrar Sesión";
                        $GLOBALS["Page-Location"] = "pages/system/logout.php";
                        break;
                        case "change-my-info":
                        $GLOBALS["Page-Name"] = "Cambiar mis Datos";
                        $GLOBALS["Page-Location"] = "pages/system/change-my-info.php";
                        break;
                        case "change-my-password":
                        $GLOBALS["Page-Name"] = "Cambiar mi Password";
                        $GLOBALS["Page-Location"] = "pages/system/change-my-password.php";
                        break;
                        //Cases for Marbust Computers
                        case "computers":
                        $GLOBALS["Page-Name"] = "Marbust Computers&reg; | Mi Cuenta";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-dashboard.php";
                        break;
                        case "computers-my-computers":
                        $GLOBALS["Page-Name"] = "Mis Computadoras";
                        $GLOBALS["Page-Location"] = "pages/computers/my-computers.php";
                        break;
                        case "computers-my-maintances":
                        $GLOBALS["Page-Name"] = "Todos mis Mantenimientos";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-my-maintances.php";
                        break;
                        case "computers-register-my-computer":
                        $GLOBALS["Page-Name"] = "Registrar mi Computadora";
                        $GLOBALS["Page-Location"] = "pages/computers/computers-register-my-computer.php";
                        break;
                        case "computers-register-user-computer":
                        if ( $_SESSION["AUTECH"] == TRUE ) {
                            $GLOBALS["Page-Name"] = "Registrar Computadora de Cliente";
                            $GLOBALS["Page-Location"] = "pages/computers/computers-register-user-computer.php";
                        } else {
                            header( "Location: computers" );
                            exit;
                        }
                        break;
                        case "computers-pre-register-maintance":
                        if ( $_SESSION["AUTECH"] == TRUE ) {
                            $GLOBALS["Page-Name"] = "Registrar Mantenimiento | Parte 1";
                            $GLOBALS["Page-Location"] = "pages/computers/computers-pre-register-maintance.php";
                            break;
                        } else {
                            header( "Location: computers" );
                            exit;
                        }
                        case "computers-register-maintance":
                        if ( $_SESSION["AUTECH"] == TRUE ) {
                            if ( isset( $_SESSION["CurrentCustomerIdMaintance"] ) ) {
                                $GLOBALS["Page-Name"] = "Registrar Mantenimiento | Parte 2";
                                $GLOBALS["Page-Location"] = "pages/computers/computers-register-maintance.php";
                                break;
                            } else {
                                header( "Location: computers-pre-register-maintance" );
                                exit;
                            }
                        } else {
                            header( "Location: computers" );
                            exit;
                        }
                        case "change-computer-data":
                        if ( $_SESSION["SelectedComputerid"] ) {
                            $GetComputerData = Datos::GetComputerData( $_SESSION["SelectedComputerid"] );
                            if ( $GetComputerData["MarbustAccountId"] == $_SESSION['userData']['MarbustAccountId'] ) {
                                $GLOBALS["Page-Name"] = "Cambiar nombre de Computadora";
                                $GLOBALS["Page-Location"] = "pages/computers/change-computer-data.php";
                                break;
                            } else {
                                header( "Location: computers" );
                                exit;
                            }
                        } else {
                            header( "Location: computers" );
                            exit;
                        }
                        default:
                        header( "Location: dashboard" );
                    }
                }

            } else {
                //If it's not logged but has a path
                if ( $_GET["path"] == "login" ) {

                } else {
                    $_SESSION['POSTLOGINNURL'] = $_GET["path"];
                }

                switch ( $_GET["path"] ) {

                    case "register":
					if (isset($_SESSION['POSTLOGINNURL'])) {
						unset($_SESSION['POSTLOGINNURL']);
					}
                    $GLOBALS["Page-Name"] = "Registrar una cuenta";
                    $GLOBALS["Page-Location"] = "pages/system/register.php";
                    break;
                    case "login":
                    $GLOBALS["Page-Name"] = "Inicio de Sesión";
                    $GLOBALS["Page-Location"] = "pages/system/login.php";
                    break;
                    default:
                    header( "Location: login" );
                }
            }

        } else {
            //The user enter in the system for default without setting a path
            //Here analyze the logged
            if ( isset( $_SESSION['loggedin'] ) ) {

            } else {
                $_SESSION['loggedin'] = FALSE;
            }
            if ( $_SESSION['loggedin'] == TRUE ) {
                MarbustController::AccountsActiveSessionController();
                //if it's logged the user will enter into the path option in the top
                header( "Location: dashboard" );
            } else {
                //if it's not logged the user will enter into the path option in the top
                header( "Location: login" );
            }
        }
        $GLOBALS["Facebook-Link"] = "https://facebook.com/MarbustTechnologyCompany";
        $GLOBALS["Twitter-Link"] = "https://twitter.com/MarbustTech";
        $GLOBALS["WhatsApp-Link"] = "https://api.whatsapp.com/send?phone=593982345160&text=%C2%A1Hola,%20te%20visito%20desde%20el%20sitio%20web%20de%20*Marbust%20Technology%20Company*%20%C2%A1Me%20gustar%C3%ADa%20tus%20servicios%20o%20productos!";
        $GLOBALS["Instagram-Link"] = "https://instagram.com/marbusttechnology";
        $GLOBALS["Youtube-Link"] = "https://www.youtube.com/channel/UCdVLdxEW8STQq-IP8HTndag/";
        $GLOBALS["Email-Link"] = "mailto:supportcenter@marbust.com";
    }
}

class MarbustController {
    /*Accounts Registrations*/

    public static function AccountsRegistrationsController() {
        if ( isset( $_POST["controller-action"] ) ) {
            $controller_action = $_POST["controller-action"];
            if ( $controller_action == "register" ) {
                $nombres = filter_input( INPUT_POST, 'accountName', FILTER_SANITIZE_STRING );
                $apellidos = filter_input( INPUT_POST, 'accountLastName', FILTER_SANITIZE_STRING );
                $_SESSION["RegisterName"] = $nombres;
                $_SESSION["RegisterLastName"] = $apellidos;
                $email = filter_input( INPUT_POST, 'accountEmail', FILTER_VALIDATE_EMAIL );
                $email = functions::checkEmail( $email );
                $existingEmail = Datos::checkExistingEmail( $email );
                if ( $email == "supportcenter@marbust.com" || $email == "supportcenter@marbust.xyz" || $email == "ceo@marbust.com" ) {
                    $_SESSION["MENSAJEREGISTRACION"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que es denegado el uso de dicho email por privilegios del Sistema.</p>';
                    header( "Location: register" );
                    exit;
                }
                if ( $existingEmail ) {
                    $_SESSION["MENSAJEREGISTRACION"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que ya existe una cuenta en el Sistema Registrada con ese email.</p>';
                    header( "Location: register" );
                    exit;
                }
                $_SESSION["RegisterEmail"] = $email;
                $password = filter_input( INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING );
                $phone = filter_input( INPUT_POST, 'accountPhone', FILTER_SANITIZE_STRING );
                $existingPhone = Datos::checkExistingPhone( $phone );
                if ( $existingPhone ) {
                    $_SESSION["MENSAJEREGISTRACION"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que ya existe una cuenta en el Sistema Registrada con ese numero celular.</p>';
                    header( "Location: register" );
                    exit;
                }

                if ( empty( $nombres ) || empty( $apellidos ) || empty( $email ) || empty( $phone ) || empty( $password ) ) {
                    $_SESSION["MENSAJEREGISTRACION"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header( "Location: register" );
                    exit;

                }
                $rightphone = functions::validate_mobile( $phone );
                if ( $rightphone == 0 ) {
                    $_SESSION["MENSAJEREGISTRACION"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que el numero de telefono ingresado no es correcto</p>';
                    header( "Location: register" );
                    exit;
                }
                $_SESSION["RegisterPhone"] = $phone;
                $hashedPassword = password_hash( $password, PASSWORD_DEFAULT );
                //send to the model
                $name = $nombres.' '.$apellidos;
                $respuesta = Datos::AccountsRegistrationsModel( $name, $email, $phone, $hashedPassword );
                if ( $respuesta === 1 ) {
                    $_SESSION["MENSAJEREGISTRACION"] = '<p class = "tac fs18px lh2em mb15px">Gracias por registrar al Usuario '.$name.', ahora puede él o ella iniciar sesión</p>';
                    header( "Location: login" );
                    exit;
                } else {
                    $_SESSION["MENSAJEREGISTRACION"] =  '<p class = "tac fs18px lh2em mb15px">El Registro ha fallado.</p>';
                    header( "Location: register" );
                    exit;

                }
            }
        }
    }

    public static function AccountsLoginController() {
        if ( isset( $_POST["controller-action"] ) ) {
            $controller_action = $_POST["controller-action"];
            if ( $controller_action == "login" ) {

                if ( ( $_POST["accountEmail"] == "create@marbust.com" ) && ( $_POST["accountPassword"] == "PASSWORD" ) ) {
                    $password = filter_input( INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING );
                    $hashedPassword = password_hash( $password, PASSWORD_DEFAULT );
                    $respuesta = Datos::AccountsRegistrationsModel( "Marbust Technology Company", "supportcenter@marbust.com", "0982345160", $hashedPassword );
                    if ( $respuesta === 1 ) {
                        //$_SESSION["MENSAJEREGISTRACION"] = '<p class = "tac fs18px lh2em mb15px marbust-money-msgs">Gracias por registrar al Usuario '.$name.', ahora puedes iniciar sesión</p>';
                        $_SESSION["MENSAJELOGIN"] = '<p class = "tac fs18px lh2em mb15px">Super Administrador la Creación de tu Usuario ha sido correcta</p>';
                        header( "Location: login" );
                        exit;
                    } else {
                        $_SESSION["MENSAJEREGISTRACION"] =  '<p class = "tac fs18px lh2em mb15px">El Registro ha fallado.</p>';
                        header( "Location: login" );
                        exit;

                    }
                }
                $email = filter_input( INPUT_POST, 'accountEmail', FILTER_VALIDATE_EMAIL );
                $email = functions::checkEmail( $email );
                $password = filter_input( INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING );
                if ( empty( $email ) || empty( $password ) ) {
                    $_SESSION["MENSAJELOGIN"] =  '<p class = "tac fs18px lh2em mb15px">El Inicio de Sesión no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header( "Location: login" );
                    exit;

                }
                $existingEmail = Datos::checkExistingEmail( $email );
                if ( !$existingEmail ) {
                    $_SESSION["MENSAJELOGIN"] =  '<p class = "tac fs18px lh2em mb15px">El Inicio de Sesión no puede continuar debido a que no existe una cuenta en el Sistema Registrada con ese email.</p>';
                    header( "Location: login" );
                    exit;
                }
                $_SESSION["LoginEmail"] = $email;
                $userData = Datos::getUser( $email );
                /*var_dump( $userData );
                exit;
                */
                /*echo $userData['accountPassword'];
                exit;
                */
                $hashCheck = password_verify( $password, $userData['accountPassword'] );
                /*echo $hashCheck;
                exit;
                */
                if ( !$hashCheck ) {
                    $_SESSION["MENSAJELOGIN"] =  '<p class = "tac fs18px lh2em mb15px">El Inicio de Sesión no puede continuar debido a que la contraseña ingresada es incorrecta.</p>';
                    header( "Location: login" );
                    exit;
                }
                $_SESSION['SUPERADMIN'] = FALSE;
                // Sesión Iniciada Correctamente
                $_SESSION['loggedin'] = TRUE;
                // Eliminar la Contraseña del Array
                array_pop( $userData );
                $_SESSION['userData'] = $userData;
				$verExistingAccount = Datos::checkExistingTechAccount($_SESSION['userData']['MarbustAccountId']);
                $_SESSION["AUTECH"] = FALSE;
                $_SESSION["TECHID"] = 0;
                 if($verExistingAccount == 1){
                     $authorizedTech = Datos::getTechInfo($_SESSION['userData']['MarbustAccountId']);
                     $validationTech = $authorizedTech["maintancetechActive"];
                     if ($validationTech == "1") {
                         $_SESSION["AUTECH"] = TRUE;
                         $_SESSION["TECHID"] = $authorizedTech["maintancetechId"];
                        /* echo $_SESSION["TECHID"];
                         exit;*/
                     }
                }
                if ( $userData['accountEmail'] == "supportcenter@marbust.com" ) {
                    $_SESSION['SUPERADMIN'] = TRUE;
                }

                if ( isset( $_SESSION['POSTLOGINNURL'] ) ) {
                    $afterurl = $_SESSION['POSTLOGINNURL'];
                    unset( $_SESSION['POSTLOGINNURL'] );
                    header( "Location: $afterurl" );
                    exit;
                } else {
                    header( "Location: dashboard" );
                    exit;
                }
            }
        }
    }

    public static function AccountsLogoutController() {
        unset( $_SESSION['loggedin'] );
        unset( $_SESSION['userData'] );
        session_destroy();
        header( "Location: login" );
        exit;
    }

    public static function AccountsGotoChangeUserDataController( $userIDtoChange ) {
        $_SESSION['USERIDTOCHANGE'] = $userIDtoChange;

    }

    public static function AccountsChangeUserDataController( $userIDtoChange ) {
        $usertoChange = Datos::getUserInfo( $userIDtoChange );
        array_pop( $usertoChange );
        $_SESSION['USERTOCHANGE'] = $usertoChange;
        if ( isset( $_POST["controller-action"] ) ) {
            $controller_action = $_POST["controller-action"];
            if ( $controller_action == "changeUserData" ) {
                $name = filter_input( INPUT_POST, 'accountName', FILTER_SANITIZE_STRING );
                $_SESSION["ChangeName"] = $name;
                $email = filter_input( INPUT_POST, 'accountEmail', FILTER_SANITIZE_STRING );
                if ( $_SESSION['USERTOCHANGE']['accountEmail'] == $email ) {

                } else {
                    $email = functions::checkEmail( $email );
                    $existingEmail = Datos::checkExistingEmail( $email );
                    if ( $existingEmail ) {
                        $_SESSION["MENSAJECAMBIODATOSUSUARIO"] =  '<p class = "fs18px lh2em mb15px tac">El Cambio no puede continuar debido a que ya existe una cuenta en el Sistema Registrada con ese email.</p>';
                        header( "Location: change-user-data" );
                        exit;
                    }
                    $_SESSION["ChangeEmail"] = $email;
                }
                if ( $email == "supportcenter@marbust.com" || $email == "supportcenter@marbust.xyz" || $email == "ceo@marbust.com" ) {
                    $_SESSION["MENSAJECAMBIODATOSUSUARIO"] =  '<p class = "fs18px lh2em mb15px tac">El cambio no puede continuar debido a que es denegado el uso de dicho email por privilegios del Sistema.</p>';
                    header( "Location: change-user-data" );
                    exit;
                }
                $phone = filter_input( INPUT_POST, 'accountPhone', FILTER_SANITIZE_STRING );
                if ( $_SESSION['USERTOCHANGE']['accountPhone'] == $phone ) {

                } else {
                    $existingPhone = Datos::checkExistingPhone( $phone );
                    if ( $existingPhone ) {
                        $_SESSION["MENSAJECAMBIODATOSUSUARIO"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio no puede continuar debido a que ya existe una cuenta en el Sistema Registrada con ese numero celular.</p>';
                        header( "Location: change-user-data" );
                        exit;
                    }

                }

                if ( empty( $name ) || empty( $email ) || empty( $phone ) ) {
                    $_SESSION["MENSAJECAMBIODATOSUSUARIO"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header( "Location: change-user-data" );
                    exit;

                }
                $rightphone = functions::validate_mobile( $phone );
                if ( $rightphone == 0 ) {
                    $_SESSION["MENSAJECAMBIODATOSUSUARIO"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que el numero de teléfono ingresado no es correcto</p>';
                    header( "Location: change-user-data" );
                    exit;
                }
                $_SESSION["ChangePhone"] = $phone;
                $respuesta = Datos::AccountsChangeDataModel( $_SESSION['USERTOCHANGE']['MarbustAccountId'], $name, $email, $phone );
                if ( $respuesta === 1 ) {
                    $_SESSION["MENSAJECAMBIODATOSUSUARIO"] = '<p class = "fs18px lh2em mb15px tac">Gracias por actualizar al Usuario <strong>'.$name.'</strong>, ahora él o ella puede usar los nuevos datos</p>';
                    unset( $_SESSION['USERIDTOCHANGE'] );
                    unset( $_SESSION['USERTOCHANGE'] );
                    unset ( $_SESSION["ChangeEmail"] );
                    unset ( $_SESSION["ChangeName"] );
                    unset ( $_SESSION["ChangePhone"] );
                    header( "Location: users" );
                    exit;
                } else {
                    $_SESSION["MENSAJECAMBIODATOSUSUARIO"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio ha fallado.</p>';
                    header( "Location: change-user-data" );
                    exit;

                }

            }
        }
    }
	
	public static function AccountsChangeComputerDataController( $selectedComputerIDtoChange ) {
        $computertoChange = Datos::GetComputerData( $selectedComputerIDtoChange );
        $_SESSION['COMPUTERTOCHANGE'] = $computertoChange;
        if ( isset( $_POST["controller-action"] ) ) {
            $controller_action = $_POST["controller-action"];
            if ( $controller_action == "changeComputerData" ) {
                $ComputerName = filter_input(INPUT_POST, 'maintancecomputerName', FILTER_SANITIZE_STRING);
                $_SESSION["maintancecomputerName"] = $ComputerName;
                if (empty($ComputerName)) {
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header("Location: change-computer-data");
                    exit; 
                }
                $verExistingPC = Datos::checkExistingPC($ComputerName);
                 /*echo $verExistingAccount;
                 exit;*/
                 if($verExistingPC){
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que existe una computadora Registrada con ese Nombre.</p>';
                     header("Location: change-computer-data");
                     exit;
                }
                $respuesta = Datos::PCChangeNameModel($selectedComputerIDtoChange, $ComputerName);
                    if ($respuesta === 1) {
                        $_SESSION["MENSAJEREGISTRACIONPC"] = '<p class = "fs18px lh2em mb15px">La actualización de nombre ha finalizado con éxito a: '.$ComputerName.'</p>';
                        unset($_SESSION["SelectedComputerid"]);
                        unset($_SESSION['COMPUTERTOCHANGE']);
                        unset($_SESSION["maintancecomputerName"]);
                        header("Location: computers");
                        exit;
                    } else {
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio ha fallado.</p>';
                    header("Location: change-computer-data");
                    exit; 
                    }
        }
		}
		
    }

    public static function AccountsChangeDataController() {
        if ( isset( $_POST["controller-action"] ) ) {
            $controller_action = $_POST["controller-action"];
            if ( $controller_action == "changeData" ) {
                $name = filter_input( INPUT_POST, 'accountName', FILTER_SANITIZE_STRING );
                $_SESSION["ChangeName"] = $name;
                $email = filter_input( INPUT_POST, 'accountEmail', FILTER_SANITIZE_STRING );
                if ( $_SESSION['userData']['accountEmail'] == $email ) {

                } else {
                    $email = functions::checkEmail( $email );
                    $existingEmail = Datos::checkExistingEmail( $email );
                    if ( $existingEmail ) {
                        $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "fs18px lh2em mb15px">El Cambio no puede continuar debido a que ya existe una cuenta en el Sistema Registrada con ese email.</p>';
                        header( "Location: change-my-info" );
                        exit;
                    }
                    $_SESSION["ChangeEmail"] = $email;
                }
                if ( $email == "supportcenter@marbust.com" || $email == "supportcenter@marbust.xyz" || $email == "ceo@marbust.com" ) {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "fs18px lh2em mb15px">El cambio no puede continuar debido a que es denegado el uso de dicho email por privilegios del Sistema.</p>';
                    header( "Location: change-my-info" );
                    exit;
                }
                $phone = filter_input( INPUT_POST, 'accountPhone', FILTER_SANITIZE_STRING );
                if ( $_SESSION['userData']['accountPhone'] == $phone ) {

                } else {
                    $existingPhone = Datos::checkExistingPhone( $phone );
                    if ( $existingPhone ) {
                        $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio no puede continuar debido a que ya existe una cuenta en el Sistema Registrada con ese numero celular.</p>';
                        header( "Location: change-my-info" );
                        exit;
                    }

                }

                if ( empty( $name ) || empty( $email ) || empty( $phone ) ) {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header( "Location: change-my-info" );
                    exit;

                }
                $rightphone = functions::validate_mobile( $phone );
                if ( $rightphone == 0 ) {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que el numero de telefono ingresado no es correcto</p>';
                    header( "Location: change-my-info" );
                    exit;
                }
                $_SESSION["ChangePhone"] = $phone;
                $respuesta = Datos::AccountsChangeDataModel( $_SESSION['userData']['MarbustAccountId'], $name, $email, $phone );
                if ( $respuesta === 1 ) {
                    $_SESSION["MENSAJECAMBIODATOS"] = '<p class = "fs18px lh2em mb15px">Gracias por actualizar su Usuario <strong>'.$name.'</strong>, ahora puede usar los nuevos datos</p>';
                    $_SESSION['userData']['accountName'] = $name;
                    $_SESSION['userData']['accountEmail'] = $email;
                    $_SESSION['userData']['accountPhone'] = $phone;
                    header( "Location: dashboard" );
                    exit;
                } else {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio ha fallado.</p>';
                    header( "Location: change-my-info" );
                    exit;

                }

            }
        }
    }

    public static function AccountsChangePasswordController() {
        if ( isset( $_POST["controller-action"] ) ) {
            $controller_action = $_POST["controller-action"];
            if ( $controller_action == "changePassword" ) {

                $password = filter_input( INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING );
                if ( empty( $password ) ) {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header( "Location: change-my-password" );
                    exit;

                }
                $UserInfo = Datos::getUserInfo( $_SESSION['userData']['MarbustAccountId'] );
                $hashCheck = password_verify( $password, $UserInfo['accountPassword'] );
                if ( $hashCheck ) {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio no puede continuar debido a que esta usando la misma contraseña ingresada.</p>';
                    header( "Location: change-my-password" );
                    exit;

                }
                $hashedPassword = password_hash( $password, PASSWORD_DEFAULT );
                $respuesta = Datos::AccountsChangePasswordModel( $_SESSION['userData']['MarbustAccountId'], $hashedPassword );
                if ( $respuesta === 1 ) {
                    $_SESSION["MENSAJECAMBIODATOS"] = '<p class = "fs18px lh2em mb15px">Gracias por actualizar su Contraseña '.$_SESSION['userData']['accountName'].', ahora puede usarla en su proximo inicio de Sesión</p>';
                    header( "Location: dashboard" );
                    exit;
                } else {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio ha fallado.</p>';
                    header( "Location: change-my-password" );
                    exit;

                }

            }
        }
    }

    public static function AccountsChangePasswordUserController( $userIDtoChange ) {
        $usertoChange = Datos::getUserInfo( $userIDtoChange );
        array_pop( $usertoChange );
        $_SESSION['USERTOCHANGE'] = $usertoChange;
        if ( isset( $_POST["controller-action"] ) ) {
            $controller_action = $_POST["controller-action"];
            if ( $controller_action == "changeUserPassword" ) {
                $id = $userIDtoChange;
                $password = filter_input( INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING );
                if ( empty( $password ) || empty( $id ) ) {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header( "Location: change-user-password" );
                    exit;

                }
                $UserInfo = Datos::getUserInfo( $id );
                $hashCheck = password_verify( $password, $UserInfo['accountPassword'] );
                if ( $hashCheck ) {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio no puede continuar debido a que esta usando la misma contraseña registrada en el Sistema.</p>';
                    header( "Location: change-user-password" );
                    exit;

                }
                $hashedPassword = password_hash( $password, PASSWORD_DEFAULT );
                $respuesta = Datos::AccountsChangePasswordModel( $id, $hashedPassword );
                if ( $respuesta === 1 ) {
                    $_SESSION["MENSAJECAMBIODATOSUSUARIO"] = '<p class = "tac fs18px lh2em mb15px">Gracias por actualizar la Contraseña del Usuario: <strong>'.$UserInfo['accountName'].'</strong>, informele a él o ella que ahora puede usarla en su proximo inicio de Sesión</p>';
                    unset( $_SESSION['USERIDTOCHANGE'] );
                    unset( $_SESSION['USERTOCHANGE'] );
                    header( "Location: users" );
                    exit;
                } else {
                    $_SESSION["MENSAJECAMBIODATOS"] =  '<p class = "tac fs18px lh2em mb15px">El Cambio ha fallado.</p>';
                    header( "Location: change-user-password" );
                    exit;

                }

            }
        }
    }

    public static function AccountsActiveSessionController() {
		//Analize
		if (isset($_SESSION['userData']['MarbustAccountId'])) {
			$id = $_SESSION['userData']['MarbustAccountId'];
        	$existingId = Datos::checkExistingId( $id );
        	if ( $existingId == 0 ) {
            header( "Location: logout" );
            exit;
			}
		} else {
			header( "Location: logout" );
            exit;
		}
    }

    public static function GetAllAccountsController() {
        $_SESSION['accountsData'] = Datos::GetAllAccountsModel();
    }
	public static function GetAllAccountsControllerOrderByName() {
        $_SESSION['accountsDataOBN'] = Datos::GetAllAccountsModelOBN();
    }

    public static function GetTotalAccountsController() {
        $accounts = Datos::GetTotalAccountsModel();
        /*echo $accountsData[0]['accountId'];
        exit;
        */
        $_SESSION['totalMarbustAccounts'] = $accounts;
        /*var_dump( $_SESSION['accountsData'] );
        exit;
        */
    }

    public static function DeleteUserController( $userIDtoDelete ) {
        $usertoChange = Datos::getUserInfo( $userIDtoDelete );
        array_pop( $usertoChange );
        $_SESSION['USERTOCHANGE'] = $usertoChange;
        //var_dump( $_SESSION['USERTOCHANGE'] );
        //
        $respuesta = Datos::DeleteUserModel( $userIDtoDelete );
        if ( $respuesta === 1 ) {
            $_SESSION["MENSAJECAMBIODATOSUSUARIO"] = '<p class = "tac fs18px lh2em mb15px w100p">El Usuario: <strong>'.$_SESSION['USERTOCHANGE']['accountName'].'</strong>, ha sido eliminado correctamente, en conjunto con todos los datos relacionados al mismo</p>';
            unset( $_SESSION['USERIDTOCHANGE'] );
            unset( $_SESSION['USERTOCHANGE'] );
            header( "Location: users" );
            exit;
        } else {
            $_SESSION["MENSAJECAMBIODATOSUSUARIO"] =  '<p class = "tac fs18px lh2em mb15px w100p">El proceso ha fallado.</p>';
            unset( $_SESSION['USERIDTOCHANGE'] );
            unset( $_SESSION['USERTOCHANGE'] );
                header( "Location: users" );
                exit;

            }
        }
	
	public static function DeleteComputerController( $ComputerIDtoDelete ) {
        $computertoChange = Datos::GetComputerData( $ComputerIDtoDelete );
        $_SESSION['COMPUTERTOCHANGE'] = $computertoChange;
        //
        $respuesta = Datos::DeleteComputerModel( $ComputerIDtoDelete );
        if ( $respuesta === 1 ) {
            $_SESSION["MENSAJECAMBIODATOSPC"] = '<p class = "tac fs18px lh2em mb15px w100p">La Computadora: <strong>'.$_SESSION['COMPUTERTOCHANGE']['maintancecomputerName'].'</strong>, ha sido eliminado correctamente, en conjunto con todos los datos relacionados al mismo</p>';
            unset( $_SESSION["SelectedComputerid"] );
            unset( $_SESSION['COMPUTERTOCHANGE'] );
            header( "Location: computers-all-computers" );
            exit;
        } else {
            $_SESSION["MENSAJECAMBIODATOSPC"] =  '<p class = "tac fs18px lh2em mb15px w100p">El proceso ha fallado.</p>';
            unset( $_SESSION["SelectedComputerid"] );
            unset( $_SESSION['COMPUTERTOCHANGE'] );
                header( "Location: computers-all-computers" );
                exit;

            }
        }
	
	//Marbust Computers Functions
	public static function GetTotalUserComputersController() {
		$_SESSION['TotalCurrentUserComputers'] = Datos::GetTotalUserComputersModel($_SESSION['userData']['MarbustAccountId']);
	}
	public static function GetTotalCountAllUsersANDMaintancesComputersController() {
		$_SESSION['TotalCountUsersComputers'] = Datos::GetTotalCountComputersModel();
		$_SESSION['TotalCountUsersMaintances'] = Datos::GetTotalCountComputersMaintancesModel();
	}
	public static function GetMyComputersController() {
        $userId = $_SESSION['userData']['MarbustAccountId'];
        $myComputersData = Datos::GetMyComputersModel($userId);
        $_SESSION['myComputersData'] = $myComputersData;
    }
	
	public static function GetAllComputersController() {
        $_SESSION['AllComputersData'] = Datos::GetAllComputersModel();
    }
	
	public static function GetAllMaintancesController() {
        $_SESSION['AllMaintancesData'] = Datos::GetAllMaintancesModel();
    }
	
	public static function GetMyMaintancesListController() {
		$userId = $_SESSION['userData']['MarbustAccountId'];
        $_SESSION['MyMaintancesData'] = Datos::GetMyMaintancesModel($userId);
    }
	
	public static function GetMyMaintancesController() {
		$_SESSION['TotalCurrentUserCountMaintances'] = Datos::GetMyMaintancesCountModel($_SESSION['userData']['MarbustAccountId']);
		$nextComputer = Datos::GetMyComputersModel($_SESSION['userData']['MarbustAccountId']);
		//var_dump($nextComputer[0]);
		$computersCount = Datos::GetTotalUserComputersModel($_SESSION['userData']['MarbustAccountId']);
		if ($computersCount != 0) {
			$_SESSION['nextComputerName'] = $nextComputer[0]['maintancecomputerName'];
			 $year = $nextComputer[0]["maintancenextYear"];
             $month = $nextComputer[0]["maintancenextMonth"];
             $month = functions::MesName($month);
             $day = $nextComputer[0]["maintancenextDay"];
			$_SESSION['nextComputerDate'] = $month.' '.$day.', '.$year;
		}
	}
	
	public static function CustomerRegisterPCController() {
        if(isset($_POST["controller-action"])) {
           $controller_action = $_POST["controller-action"];
            if ($controller_action == "register-my-pc") {
                $MarbustAccountId = $_SESSION['userData']['MarbustAccountId'];
                $ComputerName = filter_input(INPUT_POST, 'maintancecomputerName', FILTER_SANITIZE_STRING);
                $_SESSION["maintancecomputerName"] = $ComputerName;
                if (empty($ComputerName)) {
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header("Location: computers-register-my-computer");
                    exit; 
                }
                $verExistingPC = Datos::checkExistingPC($ComputerName);
                 /*echo $verExistingAccount;
                 exit;*/
                 if($verExistingPC){
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que existe una computadora Registrada con ese Nombre.</p>';
                     header("Location: computers-register-my-computer");
                     exit;
                }
                $day = date("d");
                $month =  date("m");
                $year = date("Y");
                $respuesta = Datos::PCRegistrationModel($MarbustAccountId, $ComputerName, $day, $month, $year);
                    if ($respuesta === 1) {
                        $_SESSION["MENSAJECAMBIODATOS"] = '<p class = "fs18px lh2em mb15px">Gracias por registrar su Computadora: <strong>'.$ComputerName.'</strong>, ahora puedes acceder a todos nuestros Servicios para ella</p>';
                        unset($_SESSION["maintancecomputerName"]);
                        header("Location: computers");
                        exit;
                    } else {
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Registro ha fallado.</p>';
                    header("Location: computers-register-my-computer");
                    exit; 
                    }
                }
        }
     }
	
	public static function SpecificCustomerRegisterPCController() {
        if(isset($_POST["controller-action"])) {
           $controller_action = $_POST["controller-action"];
            if ($controller_action == "register-my-pc") {
                $MarbustAccountId = $_POST["RegisterUserId"];
                /*echo $MarbustAccountId;
                exit;*/
                $ComputerName = filter_input(INPUT_POST, 'maintancecomputerName', FILTER_SANITIZE_STRING);
                $_SESSION["maintancecomputerName"] = $ComputerName;
                if (empty($ComputerName)) {
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header("Location: computers-register-user-computer");
                    exit; 
                }
                $verExistingPC = Datos::checkExistingPC($ComputerName);
                 /*echo $verExistingAccount;
                 exit;*/
                 if($verExistingPC){
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que existe una computadora Registrada con ese Nombre.</p>';
                     header("Location: computers-register-user-computer");
                     exit;
                }
                $day = date("d");
                $month =  date("m");
                $year = date("Y");
                $respuesta = Datos::PCRegistrationModel($MarbustAccountId, $ComputerName, $day, $month, $year);
                    if ($respuesta === 1) {
                        $_SESSION["MENSAJEREGISTRACIONPC"] = '<p class = "fs18px lh2em mb15px">Gracias por registrar la Computadora '.$ComputerName.', ahora se puede acceder a todos nuestros Servicios para ella</p>';
                        unset($_SESSION["preUserPCRegisterData"]);
                        unset($_SESSION["maintancecomputerName"]);
                        header("Location: computers");
                        exit;
                    } else {
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Registro ha fallado.</p>';
                    header("Location: computers-register-user-computer");
                    exit; 
                    }
                }
        }
     }
	
	public static function CustomerKindsMaintanceController() {
        if(isset($_POST["controller-action"])) {
           $controller_action = $_POST["controller-action"];
            if ($controller_action == "register-maintance-type") {
                $KindName = filter_input(INPUT_POST, 'maintancetypeName', FILTER_SANITIZE_STRING);
                $_SESSION["maintancetypeName"] = $KindName;
                $points = filter_input(INPUT_POST, 'maintancetypePoints', FILTER_SANITIZE_STRING);
                $_SESSION["maintancetypePoints"] = $points;
                $time = filter_input(INPUT_POST, 'maintancetypeextraTime', FILTER_SANITIZE_STRING);
                if (empty($KindName) || empty($points) || empty($time)) {
                    $_SESSION["MENSAJEREGISTRACIONTipo"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header("Location: computers-register-type-maintances");
                    exit; 
                }
                $verExistingMaintance = Datos::checkMaintanceType($KindName);
                 /*echo $verExistingAccount;
                 exit;*/
                 if($verExistingMaintance){
                    $_SESSION["MENSAJEREGISTRACIONTipo"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que existe un tipo de mantenimiento registrado con ese nombre.</p>';
                     header("Location: computers-register-type-maintances");
                     exit;
                }
                $respuesta = Datos::MaintanceTypeRegistryModel($KindName, $points, $time);
                    if ($respuesta === 1) {
                        $_SESSION["MENSAJEREGISTRACIONPC"] = '<p class = "fs18px lh2em mb15px">Gracias por registrar el tipo de mantenimiento llamado: '.$KindName.', ahora este puede ser usado para el registro de mantenimientos</p>';
                        unset($_SESSION["maintancetypeName"]);
                        unset($_SESSION["maintancetypePoints"]);
                        header("Location: computers");
                        exit;
                    } else {
                    $_SESSION["MENSAJEREGISTRACIONPC"] =  '<p class = "tac fs18px lh2em mb15px">El Registro ha fallado.</p>';
                    header("Location: computers-register-type-maintances");
                    exit; 
                    }
                }
        }
     }
	
	public static function TechRegistrationsController() {
         if(isset($_POST["controller-action"])) {
             $controller_action = $_POST["controller-action"];
             if ($controller_action == "register-tech") {
                 $MarbustAccountId = filter_input(INPUT_POST, 'RegisterTechId', FILTER_SANITIZE_STRING);
                 $active = filter_input(INPUT_POST, 'maintancetechActive', FILTER_SANITIZE_STRING);
                 $respuesta = Datos::MaintanceTechRegistryModel($MarbustAccountId, $active);
                    if ($respuesta === 1) {
                        $_SESSION["MENSAJEREGISTRACIONPC"] = '<p class = "fs18px lh2em mb15px">Gracias por registrar el Técnico de Mantenimiento, ahora él o ella puede realizar Mantenimientos</p>';
                        header("Location: computers");
                        exit;
                    } else {
                    $_SESSION["MENSAJEREGISTRACIONTech"] =  '<p class = "tac fs18px lh2em mb15px">El Registro ha fallado.</p>';
                    header("Location: computers-register-tech");
                    exit; 
                }
             }
         }
    }
	
	public static function PreRegisterMaintanceController() {
		if(isset($_POST["controller-action"])) {
             $controller_action = $_POST["controller-action"];
             if ($controller_action == "pre-register-maintance") {
                 $_SESSION["CurrentCustomerIdMaintance"] = filter_input(INPUT_POST, 'accountId', FILTER_SANITIZE_STRING);
                	header("Location: computers-register-maintance");
                    exit; 
             }
         }
	}
	
	public static function getUserInfoandComputers($id) {
		$_SESSION["CurrentMaintanceUserName"] = datos::getUserName($id);
		$_SESSION['CustomersComputersData'] = datos::GetCustomerComputersModel($id);
	}
	
	public static function getMaintancesKinds() {
          $MaintancesKindsList = Datos::GetMaintancesKindsModel();
       
        $_SESSION['MaintancesKindsList'] = $MaintancesKindsList;

    }
	
	public static function MaintanceRegistrationsController() {
         if(isset($_POST["controller-action"])) {
             $controller_action = $_POST["controller-action"];
             if ($controller_action == "register-maintance") {
                 //Id de Usuario
                 $MarbustAccountId = $_SESSION["CurrentCustomerIdMaintance"];
                 // Id de Tecnico
                 //$TechId = $_SESSION["TECHID"];
				 if ($_SESSION["AUTECH"] == TRUE) {
					  $TechId = $_SESSION["TECHID"];
                 //Id de la Computadora
                 $ComputerId = filter_input(INPUT_POST, 'maintancecomputerId', FILTER_SANITIZE_STRING);
                 //Id del Tipo de Mantenimiento
                 $KindId = filter_input(INPUT_POST, 'maintancetypeId', FILTER_SANITIZE_STRING);
                 //Fecha
                 $day = date("d");
                $month =  date("m");
                $year = date("Y");
                 // Descripcion del Mantenimiento
                 $description = filter_input(INPUT_POST, 'maintanceDescription', FILTER_SANITIZE_STRING);
                 // Fue hecho en Promoción (SI1 / NO0)
                 $promotion = filter_input(INPUT_POST, 'maintancePromo', FILTER_SANITIZE_STRING);           
                 if (empty($MarbustAccountId) || empty($TechId) || empty($ComputerId) || empty($KindId) || empty($description)) {
                    $_SESSION["MENSAJEREGISTRACIONMaintance"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header("Location: computers-register-maintance");
                    exit; 
                }
                $moreMonths = Datos::MonthsforNextMaintanceModel($KindId);
                $extraTime = $moreMonths["maintancetypeextraTime"];
                $respuesta = Datos::MaintanceRegistryModel($MarbustAccountId, $TechId, $ComputerId, $KindId, $day, $month, $year, $description, $promotion);
                    if ($respuesta === 1) {
                        $month = $month + $extraTime;
                        if ($month > 12) {
                            $month = $month - 12;
                            $year = $year + 1;
                        }
                        $respuesta2 = Datos::MaintanceUpdateNextDateModel($ComputerId, $month, $day, $year);
                        if ($respuesta2 === 1) {
                            $_SESSION["MENSAJEREGISTRACIONMaintance"] = '<p class = "fs18px lh2em mb15px">La fecha del próximo mantenimiento se ha actualizado correctamente. ';
                        } else {
                             $_SESSION["MENSAJEREGISTRACIONMaintance"] = '<p class = "fs18px lh2em mb15px">La fecha del próximo mantenimiento no se ha actualizado correctamente. ';
                        }
                        $_SESSION["MENSAJEREGISTRACIONMaintance"] = $_SESSION["MENSAJEREGISTRACIONMaintance"].'Gracias por registrar el Mantenimiento, el proceso ha sido exitoso.</p>';
                        unset($_SESSION["CurrentCustomerIdMaintance"]);
                        header("Location: computers");
                        exit;
                    } else {
                    $_SESSION["MENSAJEREGISTRACIONMaintance"] =  '<p class = "tac fs18px lh2em mb15px">El Registro ha fallado.</p>';
                    header("Location: computers-register-maintance");
                    exit; 
                }
				 }  
             }
         }
    }
	
	public static function EditMaintanceController($MaintanceId) {
		$_SESSION['SpecificMaintancesData'] = Datos::GetSpecificMaintanceModel($MaintanceId);
		/*var_dump($_SESSION['SpecificMaintancesData']);*/
         if(isset($_POST["controller-action"])) {
             $controller_action = $_POST["controller-action"];
             if ($controller_action == "edit-maintance") {
                // Descripcion del Mantenimiento
                 $description = filter_input(INPUT_POST, 'maintanceDescription', FILTER_SANITIZE_STRING);
                      
                 if (empty($description)) {
                    $_SESSION["MENSAJEREGISTRACIONMaintance"] =  '<p class = "tac fs18px lh2em mb15px">El Registro no puede continuar debido a que debe completar todos los campos del formulario.</p>';
                    header("Location: edit-maintance-info");
                    exit; 
                }
                $respuesta = Datos::MaintanceEditModel($MaintanceId, $description);
                    if ($respuesta === 1) {
                        $_SESSION["MENSAJEREGISTRACIONMaintance"] = '<p class = "fs18px lh2em mb15px">Gracias por editar el Mantenimiento, el proceso ha sido exitoso.</p>';
                        unset($_SESSION['SpecificMaintancesData']);
                        header("Location: computers");
                        exit;
                    } else {
                    $_SESSION["MENSAJEREGISTRACIONMaintance"] =  '<p class = "tac fs18px lh2em mb15px">El Registro ha fallado.</p>';
                    header("Location: edit-maintance-info");
                    exit; 
                }
             }
         }
    }
    public static function DeleteMaintanceController( $MaintanceIDtoDelete ) {
        $respuesta = Datos::DeleteMaintanceModel( $MaintanceIDtoDelete );
        if ( $respuesta === 1 ) {
            $_SESSION["MENSAJECAMBIODATOSPC"] = '<p class = "tac fs18px lh2em mb15px w100p">El Mantenimiento ha sido eliminado correctamente, en conjunto con todos los datos relacionados al mismo</p>';
            unset( $_SESSION["SelectedUserMaintanceid"] );
            header( "Location: computers-maintances" );
            exit;
        } else {
            $_SESSION["MENSAJECAMBIODATOSPC"] =  '<p class = "tac fs18px lh2em mb15px w100p">El proceso ha fallado.</p>';
                unset( $_SESSION["SelectedUserMaintanceid"] );
                header( "Location: computers-maintances" );
                exit;

            }
        }
    }
    ?>
