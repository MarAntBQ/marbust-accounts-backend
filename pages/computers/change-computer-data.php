<?php
MarbustController::AccountsChangeComputerDataController($_SESSION["SelectedComputerid"]);
?>
<div class="section change-data-container">
    <h1 class="pt10px pb15px">Cambiar Datos de Computadora</h1>
    <p class="tac lh2em fs20px fs-m-19px fs-p-18px mauto w80p">Por favor use el siguiente formulario para realizar el cambio de los datos de: <strong><?php echo $_SESSION['COMPUTERTOCHANGE']['maintancecomputerName']?></strong></p>
    <?php
       
        if (isset($_SESSION["MENSAJEREGISTRACIONPC"])) {
            echo $_SESSION["MENSAJEREGISTRACIONPC"];
        }
    ?>
    <div class="flex-s-a mt30px mb30px">
        <div class="box-8 box-m-12 flex-s-a">
            <form method="post">
                <p class="fs18px mb5px"><span>*</span> Nombre:</p>
                <input type="text" placeholder="Nombre único para su Computadora" name="maintancecomputerName" id="maintancecomputerName" maxlength="50" required<?php echo ' value="'.$_SESSION['COMPUTERTOCHANGE']['maintancecomputerName'].'"'; ?>>
                <button type="submit" name="submit" id="" value="" class="btn-center">Actualizar</button>
                <input type="hidden" name="controller-action" value="changeComputerData">
            </form>
        </div>
    </div>

</div>
<?php
unset($_SESSION["MENSAJEREGISTRACIONPC"]);
unset($_SESSION["maintancecomputerName"]);
?>