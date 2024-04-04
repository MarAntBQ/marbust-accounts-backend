<nav>
    <a href="https://marbust.com" class="logo"><span class="fresh-eaters">MARBUST</span><span class="nexa-light">&reg;</span></a>
    <ul id="ul">
        <?php
                if (isset($_SESSION['loggedin'])) {
        
                } else {
                    $_SESSION['loggedin'] = FALSE;
                }
                if ($_SESSION['loggedin'] == TRUE) {
					echo '<li><a href="dashboard"><i class="fas fa-home"></i> Dashboard</a></li>';
					if ($_GET["path"] == "change-user-data" || $_GET["path"] == "users" || $_GET["path"] == "change-user-password") {
						echo '<li><a href="users"><i class="fas fa-users"></i> Usuarios</a></li>';
					}
					echo '<li class="sub-menu"><a><i class="fas fa-briefcase"></i> Servicios <i class="fas fa-caret-down"></i></a>';
						echo '<ul>';
                    	echo '<li><a href="computers"><i class="fas fa-desktop"></i> Computers</a></li>';
                    	//echo '<li><a href="hosting"><i class="fas fa-server"></i> MBHostCloud&reg;</a></li>';
						echo '</ul>';
					echo '</li>';
                    if ($_GET["path"] == "computers" && ($_SESSION['SUPERADMIN'] == TRUE || $_SESSION["AUTECH"] == TRUE)) {
                        echo '<li class="sub-menu"><a><i class="fas fa-laptop"></i> Computers <i class="fas fa-caret-down"></i></a>';
						echo '<ul>';
                    	echo '<li><a href="computers-register-user-computer"><i class="fas fa-laptop-medical"></i> Registrar Computadora</a></li>';
                    	echo '<li><a href="computers-pre-register-maintance"><i class="fas fa-tools"></i> Registrar Mantenimiento</a></li>';
						echo '</ul>';
					echo '</li>';
                    }
					echo '<li><a href="logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>';
                }
				else {
					echo '<li><a href="login"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>';
					echo '<li><a href="register"><i class="fas fa-user-plus"></i> Registrarse</a></li>';
				}
         ?>
    </ul>
    <i class="fas menu-btn fa-bars" onclick="menudisplayer()"></i>
</nav>
<script>
    $('.OPLINK').click(function() {
            menudisplayer();
    })
    $(document).ready(function() {
        $('ul li').click(function() {
            $(this).siblings().removeClass('sub-menu-active');
            $(this).toggleClass('sub-menu-active');
        })
    })
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 10) {
            $("header").addClass("header-down");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
            $("header").removeClass("header-down");
        }
    });
    var urlString, urlArray, pageHREF, menu, i, currentURL;
    urlString = document.location.href;
    urlArray = urlString.split('/');
    pageHREF = urlArray[urlArray.length - 1];

    if (pageHREF !== "") {
        menu = document.querySelectorAll('#ul li a');
        for (i = 0; i < menu.length; i++) {
            currentURL = (menu[i].getAttribute('href'));
            menu[i].className = '';
            if (currentURL === pageHREF) {
                menu[i].className = 'link-active';
            }
        }
    }

</script>
