<?php
MarbustController::AccountsRegistrationsController();
?>
<div class="section register-container">
    <h1 class="pt10px pb15px">Registrarse en el Sitio</h1>
    <p class="tac lh2em fs20px fs-m-19px fs-p-18px mauto w80p">Por favor use el siguiente formulario para realizar el registro de su <strong>Marbust Account&reg;</strong></p>
    <?php
        if (isset($_SESSION["MENSAJEREGISTRACION"])) {
            echo $_SESSION["MENSAJEREGISTRACION"];
        }
    ?>
    <div class="flex-s-a mt30px mb30px">
        <div class="box-8 box-m-12 flex-s-a">
            <form method="post">
                <p class="fs18px mb5px"><span>*</span> Nombres:</p>
                <input type="text" placeholder="Nombres" name="accountName" id="accountName" maxlength="25" required<?php if (isset($_SESSION["RegisterName"])) { echo ' value="'.$_SESSION["RegisterName"].'"';} ?>>
                <p class="fs18px mb5px"><span>*</span> Apellidos:</p>
                <input type="text" placeholder="Apellidos" name="accountLastName" id="accountLastName" maxlength="25" required<?php if (isset($_SESSION["RegisterLastName"])) { echo ' value="'.$_SESSION["RegisterLastName"].'"';} ?>>
                <p class="fs18px mb5px"><span>*</span> E-mail:</p>
                <input type="email" placeholder="name@example.com" name="accountEmail" id="accountEmail" maxlength="50" required<?php if (isset($_SESSION["RegisterEmail"])) { echo ' value="'.$_SESSION["RegisterEmail"].'"';} ?>>
                <p class="fs18px mb5px"><span>*</span> Teléfono:</p>
                <input type="tel" placeholder="099999999" name="accountPhone" id="accountPhone" maxlength="10" pattern="[0-9]{10}" required<?php if (isset($_SESSION["RegisterPhone"])) { echo ' value="'.$_SESSION["RegisterPhone"].'"';} ?>>
                <p class="fs18px mb5px"><span>*</span> Password:</p>
                <input type="password" name="accountPassword" id="accountPassword" maxlength="300" placeholder="Password" required>
                <button type="submit" name="submit" id="" value="" class="btn-center">Registrar Usuario</button>
                <input type="hidden" name="controller-action" value="register">
            </form>
        </div>
    </div>

</div>
<?php
unset ($_SESSION["MENSAJEREGISTRACION"]);
unset ($_SESSION["RegisterEmail"]);
unset ($_SESSION["RegisterName"]);
unset ($_SESSION["RegisterPhone"]);
?>
