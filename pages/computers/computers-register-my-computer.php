<?php
 MarbustController::CustomerRegisterPCController();
?>
<div class="section register-computer-container">
    <h1 class="pt10px pb15px">Registre su Computadora</h1>
    <p class="tac lh2em fs20px fs-m-19px fs-p-18px maxw750px mauto w90p">Por favor use el siguiente formulario para realizar el <strong>Registro</strong></p>
   <?php
        if (isset($_SESSION["MENSAJEREGISTRACIONPC"])) {
            echo $_SESSION["MENSAJEREGISTRACIONPC"];
        }
    ?>
    <div class="flex-s-a mt30px mb30px">
        <div class="box-8 box-m-12 flex-vcc flex-hc">
            <form method="post">
                <p class="fs18px mb5px"><span>*</span> Nombre:</p>
                <input type="text" placeholder="Nombre único para su Computadora" name="maintancecomputerName" id="maintancecomputerName" maxlength="50" required<?php if (isset($_SESSION["maintancecomputerName"])) { echo ' value="'.$_SESSION["maintancecomputerName"].'"';} ?>>
                <button type="submit" name="submit" id="" value="" class="btn-center">Registrar</button>
                <input type="hidden" name="controller-action" value="register-my-pc">
            </form>
        </div>
    </div>

</div>
<?php
unset($_SESSION["MENSAJEREGISTRACIONPC"]);
unset($_SESSION["maintancecomputerName"]);
?>
