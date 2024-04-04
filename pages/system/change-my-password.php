<?php
MarbustController::AccountsChangePasswordController();
?>
<div class="section change-password-container">
	<h1 class="pt10px pb15px">Cambiar Mi Contraseña en el Sitio</h1>
	<p class="tac lh2em fs20px fs-m-19px fs-p-18px mauto w80p">Por favor use el siguiente formulario para realizar el cambio de su <strong>Password</strong></p>
	<?php
       
        if (isset($_SESSION["MENSAJECAMBIODATOS"])) {
            echo $_SESSION["MENSAJECAMBIODATOS"];
        }
    ?>
	<div class="flex-s-a mt30px mb30px">
		<div class="box-8 box-m-12 flex-s-a">
			<form method="post">
				<p class="fs18px mb5px"><span>*</span> Nueva Contraseña:</p>
				<input type="password" name="accountPassword" id="accountPassword" maxlength="300" placeholder="Password" required>
				<button type="submit" name="submit" id="" value="" class="btn-center">Actualizar</button>
				<input type="hidden" name="controller-action" value="changePassword">
			</form>
		</div>
	</div>
</div>
<?php
unset ($_SESSION["MENSAJECAMBIODATOS"]);
?>
