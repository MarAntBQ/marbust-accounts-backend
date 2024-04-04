<?php
MarbustController::TechRegistrationsController();
?>
<div class = "section register-tech">
<h1 class = "pt10px pb15px">Registrar Técnico</h1>
<p class = "tac lh2em fs20px fs-m-19px fs-p-18px maxw750px mauto w90p">Por favor use el siguiente formulario para realizar el <strong>Registro</strong></p>
<?php
        if (isset($_SESSION["MENSAJEREGISTRACIONTech"])) {
            echo $_SESSION["MENSAJEREGISTRACIONTech"];
        }
    ?>
<div class = "flex-s-a mt30px mb30px">
<div class = "box-8 box-m-12 flex-vcc flex-hc">
<form method = "post">
<p class = "fs18px mb5px"><span>*</span> Usuario:</p>
<select name = "RegisterTechId">
<?php
MarbustController::GetAllAccountsControllerOrderByName();
foreach ( $_SESSION['accountsDataOBN'] as $accountData ) {
    $verExistingAccount = Datos::checkExistingTechAccount( $accountData["MarbustAccountId"] );
    if ( !$verExistingAccount ) {
        echo '<option value="'.$accountData["MarbustAccountId"].'">'.$accountData["accountName"].' ('.substr( $accountData["accountEmail"], 0, 15 ).')</option>';
    }
}
?>
</select>
<p class = "fs18px mb5px"><span>*</span> Activo:</p>
<select name = "maintancetechActive" id = "maintancetechActive">
<option value = "1">SI</option>
<option value = "0">NO</option>
</select>
<button type = "submit" name = "submit" id = "" value = "" class = "btn-center">Registrar</button>
<input type = "hidden" name = "controller-action" value = "register-tech">
</form>
</div>
</div>

</div>
<?php
unset( $_SESSION["MENSAJEREGISTRACIONPC"] );
unset( $_SESSION["maintancecomputerName"] );
?>
