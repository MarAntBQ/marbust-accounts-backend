<?php
MarbustController::MaintanceRegistrationsController();
MarbustController::getUserInfoandComputers( $_SESSION["CurrentCustomerIdMaintance"] );
?>
<div class = "section register-tech">
<h1 class = "pt10px pb15px">Registrar Mantenimiento</h1>
<p class = "tac lh2em fs20px fs-m-19px fs-p-18px maxw750px mauto w90p">Por favor use el siguiente formulario para realizar el <strong>Registro del Mantenimiento</strong> para el usuario <strong><?php echo $_SESSION["CurrentMaintanceUserName"]["accountName"];
?></strong>.</p>
<?php
        if (isset($_SESSION["MENSAJEREGISTRACIONMaintance"])) {
            echo $_SESSION["MENSAJEREGISTRACIONMaintance"];
        }
    ?>
<div class = "flex-s-a mt30px mb30px">
<div class = "box-8 box-m-12 flex-vcc flex-hc">
<form method = "post">
<p class = "fs18px mb5px"><span>*</span> E-mail:</p>
<input type = "email" placeholder = "name@example.com" name = "accountEmail" id = "accountEmail" maxlength = "50" required<?php echo ' value="'.$_SESSION["CurrentMaintanceUserName"]["accountEmail"].'"';
?> readonly>
<p class = "fs18px mb5px"><span>*</span> Seleccione Computadora del Cliente:</p>
<select name = "maintancecomputerId" id = "maintancecomputerId">
<?php

foreach ( $_SESSION['CustomersComputersData'] as $userComputer ) {
    echo '<option value="'.$userComputer["maintancecomputerId"].'">'.$userComputer["maintancecomputerName"].'</option>';
}
?>
</select>
<p class = "fs18px mb5px"><span>*</span> Fecha de Mantenimiento:</p>
<?php
$day = date( "d" );
$month =  date( "m" );
$month = functions::MesName( $month );
$year = date( "Y" );
$GLOBALS["CurrentDate"] = $month.' '.$day.', '.$year;
?>
<input type = "text" placeholder = "Fecha" name = "date" id = "accountEmail" maxlength = "50" required<?php echo ' value="'.$GLOBALS["CurrentDate"].'"';?> readonly disabled>
<p class = "fs18px mb5px"><span>*</span>Descripción de lo Sucedido:</p>
<textarea id = "maintanceDescription" name = "maintanceDescription" rows = "7" cols = "30" placeholder = "Describa de la manera mas clara posible los acontecimientos del Mantenimiento, problemas, soluciones, y el estado final en que quedo la computadora." required><?php if ( isset( $_SESSION['maintanceDescription'] ) ) {
    echo $_SESSION['maintanceDescription'];
}
?></textarea>
<p class = "fs18px mb5px"><span>*</span> Seleccione el Tipo de Mantenimiento:</p>
<select name = "maintancetypeId" id = "maintancetypeId">
<?php
MarbustController::getMaintancesKinds();
foreach ( $_SESSION['MaintancesKindsList'] as $kind ) {
    echo '<option value="'.$kind["maintancetypeId"].'">'.$kind["maintancetypeName"].'</option>';
}
?>
</select>
<p class = "fs18px mb5px"><span>*</span> Realizado con Promoción:</p>
<select name = "maintancePromo" id = "maintancePromo">
<option value = "0">NO</option>
<option value = "1">SI</option>
</select>
<button type = "submit" name = "submit" id = "" value = "" class = "btn-center">Registrar</button>
<input type="hidden" name="controller-action" value="register-maintance">
</form>
</div>
</div>

</div>
<?php
unset ($_SESSION["MENSAJEREGISTRACIONMaintance"]);
unset ($_SESSION['maintanceDescription']);
?>
