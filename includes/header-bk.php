<nav>
    <a href="#" class="logo"><span class="fresh-eaters">MARBUST</span><span class="nexa-light">&reg;</span></a>
    <ul id="ul">
        <li><a href="#"><i class="fas fa-home"></i> Inicio</a></li>
        <li><a href="#about" class="OPLINK"><i class="fas fa-briefcase"></i> ¿Quiénes somos?</a></li>
        <li class="sub-menu">
           <a><i class="fas fa-project-diagram"></i> Servicios <i class="fas fa-caret-down"></i></a>
            <ul>
                <li><a href="index.php">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
            </ul>
        </li>
        <li><a href="#"><i class="far fa-play-circle"></i> Vídeos</a></li>
        <li class="sub-menu">
            <a><i class="fas fa-user-tie"></i> Cuentas <i class="fas fa-caret-down"></i></a>
            <ul>
                <li><a href="index.php">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="https://store.marbust.com"><i class="fas fa-shopping-cart"></i> Tienda en Línea</a></li>
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
