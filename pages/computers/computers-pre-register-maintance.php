<?php
MarbustController::PreRegisterMaintanceController();
?>
<div class = "section register-tech">
<h1 class = "pt10px pb15px">Registrar Mantenimiento</h1>
<p class = "tac lh2em fs20px fs-m-19px fs-p-18px maxw750px mauto w90p">Por favor use el siguiente formulario para realizar el <strong>Registro</strong></p>
<div class = "flex-s-a mt30px mb30px">
<div class = "box-8 box-m-12 flex-vcc flex-hc">
<form method = "post">
<p class = "fs18px mb5px"><span>*</span> Usuario:</p>
<select name = "accountId">
<?php
MarbustController::GetAllAccountsControllerOrderByName();
foreach ( $_SESSION['accountsDataOBN'] as $accountData ) {
    $verExistingAccount = Datos::checkExistingComputersAccount( $accountData["MarbustAccountId"] );
    if ( $verExistingAccount ) {
        echo '<option value="'.$accountData["MarbustAccountId"].'">'.$accountData["accountName"].' ('.substr( $accountData["accountEmail"], 0, 15 ).')</option>';
    }
}
?>
</select>
<button type = "submit" name = "submit" id = "" value = "" class = "btn-center">Continuar</button>
<input type = "hidden" name = "controller-action" value = "pre-register-maintance">
</form>
</div>
</div>

</div>
<?php
if (isset($_SESSION["CurrentCustomerIdMaintance"])) {
 	unset($_SESSION["CurrentCustomerIdMaintance"]);
}
?>
