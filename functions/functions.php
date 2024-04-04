<?php

class functions {
    public static function checkEmail( $clientEmail ) {
        $valEmail = filter_var( $clientEmail, FILTER_VALIDATE_EMAIL );
        return $valEmail;
    }

    public static function validate_mobile( $mobile ) {
        return preg_match( '/^[0-9]{10}+$/', $mobile );
    }

    public static function MesName( $month ) {
        switch ( $month ) {
            case "01":
            $month = "Enero";
            break;
            case "02":
            $month = "Febrero";
            break;
            case "03":
            $month = "Marzo";
            break;
            case "04":
            $month = "Abril";
            break;
            case "05":
            $month = "Mayo";
            break;
            case "06":
            $month = "Junio";
            break;
            case "07":
            $month = "Julio";
            break;
            case "08":
            $month = "Agosto";
            break;
            case "09":
            $month = "Septiembre";
            break;
            case "10":
            $month = "Octubre";
            break;
            case "11":
            $month = "Noviembre";
            break;
            case "12":
            $month = "Diciembre";
            break;
        }
        return $month;
    }
	
	
}

?>