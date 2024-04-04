<?php
MarbustController::EditMaintanceController($_SESSION["SelectedUserMaintanceid"]);
//MarbustController::getUserInfoandComputers( $_SESSION["CurrentCustomerIdMaintance"] );
/*echo $_SESSION["SelectedUserMaintanceid"];
exit;*/
?>
<div class = "section register-tech">
<h1 class = "pt10px pb15px">Editar Mantenimiento</h1>
<p class = "tac lh2em fs20px fs-m-19px fs-p-18px maxw750px mauto w90p">Por favor use el siguiente formulario para realizar la <strong>Modificación del Mantenimiento</strong> para el usuario <strong><?php echo $_SESSION['SpecificMaintancesData']["accountName"];
?></strong>.</p>
<?php
        if (isset($_SESSION["MENSAJEREGISTRACIONMaintance"])) {
            echo $_SESSION["MENSAJEREGISTRACIONMaintance"];
        }
    ?>
<div class = "flex-s-a mt30px mb30px">
<div class = "box-8 box-m-12 flex-vcc flex-hc">
<form method = "post">
<p class = "fs18px mb5px"><span>*</span> Computadora del Cliente:</p>
<input type = "text" maxlength = "50" <?php echo ' value="'.$_SESSION['SpecificMaintancesData']["maintancecomputerName"].'"';?> readonly required disabled>
<p class = "fs18px mb5px"><span>*</span> Fecha de Mantenimiento:</p>
<?php
$day = $_SESSION['SpecificMaintancesData']["maintancedoneDay"];
$month =  $_SESSION['SpecificMaintancesData']["maintancedoneMonth"];
$month = functions::MesName( $month );
$year = $_SESSION['SpecificMaintancesData']["maintancedoneYear"];
$GLOBALS["CurrentDate"] = $month.' '.$day.', '.$year;
?>
<input type = "text" placeholder = "Fecha" maxlength = "50" required<?php echo ' value="'.$GLOBALS["CurrentDate"].'"';?> readonly disabled>
<p class = "fs18px mb5px"><span>*</span>Descripción de lo Sucedido:</p>
<textarea id = "maintanceDescription" name = "maintanceDescription" rows = "7" cols = "30" placeholder = "Describa de la manera mas clara posible los acontecimientos del Mantenimiento, problemas, soluciones, y el estado final en que quedo la computadora." required><?php echo $_SESSION['SpecificMaintancesData']["maintanceDescription"]
?></textarea>
<p class = "fs18px mb5px"><span>*</span> Tipo de Mantenimiento:</p>
<input type = "text" maxlength = "50" <?php echo ' value="'.$_SESSION['SpecificMaintancesData']["maintancetypeName"].'"';?> readonly required disabled>
<button type = "submit" name = "submit" id = "" value = "" class = "btn-center">Editar</button>
<input type="hidden" name="controller-action" value="edit-maintance">
</form>
</div>
</div>
</div>
<?php
//unset ($_SESSION["MENSAJEREGISTRACIONMaintance"]);
//unset ($_SESSION['maintanceDescription']);
?>
