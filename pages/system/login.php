<?php
 MarbustController::AccountsLoginController();
?>
<div class="section login-container">
    <h1 class="pt10px pb15px">Iniciar Sesión</h1>
    <p class="tac lh2em fs20px fs-m-19px fs-p-18px maxw750px mauto w90p">Por favor use el siguiente formulario para realizar el <strong>Inicio de Sesión</strong></p>
    <?php
      
       if (isset($_SESSION["MENSAJEREGISTRACION"])) {
            echo $_SESSION["MENSAJEREGISTRACION"];
            unset($_SESSION["MENSAJEREGISTRACION"]);
        }
        if (isset($_SESSION["MENSAJELOGIN"])) {
            echo $_SESSION["MENSAJELOGIN"];
            unset ($_SESSION["MENSAJELOGIN"]);
        }
    ?>
    <div class="flex-s-a mt30px mb30px">
        <div class="box-8 box-m-12 flex-vcc flex-hc">
            <form method="post">
                <p class="fs18px mb5px"><span>*</span> Your E-mail:</p>
                <input type="email" placeholder="name@example.com" name="accountEmail" id="accountEmail" required<?php if (isset($_SESSION["RegisterEmail"])) { echo ' value="'.$_SESSION["RegisterEmail"].'"';} elseif (isset($_SESSION["LoginEmail"])) {echo ' value="'.$_SESSION["LoginEmail"].'"';} ?>>
                <p class="fs18px mb5px"><span>*</span> Your Password:</p>
                <input type="password" name="accountPassword" id="accountPassword" placeholder="Password" required>
                <button type="submit" name="submit" id="" value="" class="btn-center">Iniciar Sesión</button>
                <input type="hidden" name="controller-action" value="login">
            </form>
        </div>
    </div>

</div>
<?php
         unset ($_SESSION["RegisterEmail"]);
         unset ($_SESSION["LoginEmail"]);
?>
