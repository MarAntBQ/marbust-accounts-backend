<?php
MarbustController::AccountsChangeUserDataController($_SESSION['USERIDTOCHANGE']);
?>
<div class="section change-data-container">
    <h1 class="pt10px pb15px">Cambiar Datos de Usuario</h1>
    <p class="tac lh2em fs20px fs-m-19px fs-p-18px mauto w80p">Por favor use el siguiente formulario para realizar el cambio de los datos de: <strong><?php echo $_SESSION['USERTOCHANGE']['accountName']?></strong></p>
    <?php
       
        if (isset($_SESSION["MENSAJECAMBIODATOSUSUARIO"])) {
            echo $_SESSION["MENSAJECAMBIODATOSUSUARIO"];
        }
    ?>
    <div class="flex-s-a mt30px mb30px">
        <div class="box-8 box-m-12 flex-s-a">
            <form method="post">
                <p class="fs18px mb5px"><span>*</span> Nombre:</p>
                <input type="text" placeholder="Nombre" name="accountName" id="accountName" maxlength="50" required<?php if (isset($_SESSION["ChangeName"])) { echo ' value="'.$_SESSION["ChangeName"].'"';} ?>>
                <p class="fs18px mb5px"><span>*</span> E-mail:</p>
                <input type="email" placeholder="name@example.com" name="accountEmail" id="accountEmail" maxlength="50" required<?php if (isset($_SESSION["ChangeEmail"])) { echo ' value="'.$_SESSION["ChangeEmail"].'"';} ?>>
                <p class="fs18px mb5px"><span>*</span> Teléfono:</p>
                <input type="tel" placeholder="099999999" name="accountPhone" id="accountPhone" maxlength="10" pattern="[0-9]{10}" required<?php if (isset($_SESSION["ChangePhone"])) { echo ' value="'.$_SESSION["ChangePhone"].'"';} ?>>
                <button type="submit" name="submit" id="" value="" class="btn-center">Actualizar</button>
                <input type="hidden" name="controller-action" value="changeUserData">
            </form>
        </div>
    </div>

</div>
<?php
unset ($_SESSION["MENSAJECAMBIODATOSUSUARIO"]);
unset ($_SESSION["ChangeEmail"]);
unset ($_SESSION["ChangeName"]);
unset ($_SESSION["ChangePhone"]);
//unset ($_SESSION['USERIDTOCHANGE']);

//<p><?php echo $_SESSION['USERIDTOCHANGE'];

?>

	
