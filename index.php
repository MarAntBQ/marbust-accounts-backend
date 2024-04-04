<?php
session_start();
require_once 'controllers/controllers.php';
require_once 'models/models.php';
require_once 'functions/functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    //<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1">
    Templatectr::getPageNames();
    //$pageName = $GLOBALS['PAGENAME'];
    echo '<title>Marbust Accounts&reg; | '.$GLOBALS["Page-Name"].'</title>';
    include 'includes/head.php';
    include 'app/head.php';
    ?>
</head>
<body>
   <?php
    echo '<header>';
    include 'includes/header.php';
    echo '</header>';
    echo '<main>';
    Templatectr::getPageNames();
    include $GLOBALS["Page-Location"];
    echo '</main>';
    echo '<footer>';
    include 'includes/footer.php';
    echo '</footer>';
    ?>
</body>
</html>