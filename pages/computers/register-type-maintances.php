<?php
MarbustController::CustomerKindsMaintanceController();
?>
<div class = "section register-type-maintances">
<h1 class = "pt10px pb15px">Registre Tipos de Mantenimientos</h1>
<p class = "tac lh2em fs20px fs-m-19px fs-p-18px maxw750px mauto w90p">Por favor use el siguiente formulario para realizar el <strong>Registro</strong></p>
<?php
if (isset($_SESSION["MENSAJEREGISTRACIONTipo"])) {
            echo $_SESSION["MENSAJEREGISTRACIONTipo"];
        }
?>
<div class = "flex-s-a mt30px mb30px">
<div class = "box-8 box-m-12 flex-vcc flex-hc">
<form method = "post">
<p class = "fs18px mb5px"><span>*</span> Nombre único:</p>
<input type = "text" placeholder = "Nombre Unico para Tipo" name = "maintancetypeName" id = "maintancetypeName" maxlength = "50" required<?php if ( isset( $_SESSION["maintancetypeName"] ) ) {
    echo ' value="'.$_SESSION["maintancetypeName"].'"';
}
?>>
<p class = "fs18px mb5px"><span>*</span>Cantidad de Puntos:</p>
<input type = "number" placeholder = "Cantidad de Puntos" name = "maintancetypePoints" id = "maintancetypePoints" maxlength = "2" required<?php if ( isset( $_SESSION["maintancetypePoints"] ) ) {
    echo ' value="'.$_SESSION["maintancetypePoints"].'"';
}
?>>
<p class = "fs18px mb5px"><span>*</span>Tiempo en meses aproximado para próximo Mantenimiento:</p>
<select name = "maintancetypeextraTime" id = "maintancetypeextraTime">
<option value = "1">1 Mes</option>
<?php
$index = 2;
while ( $index <= 12 ) {
    echo '<option value="'.$index.'">'.$index.' Meses</option>';
    $index++;
}
?>
</select>
<button type = "submit" name = "submit" id = "" value = "" class = "btn-center">Registrar</button>
<input type = "hidden" name = "controller-action" value = "register-maintance-type">
</form>
</div>
</div>

</div>
<?php
unset($_SESSION["MENSAJEREGISTRACIONTipo"]);
unset($_SESSION["maintancetypeName"]);
unset($_SESSION["maintancetypePoints"]);
?>
