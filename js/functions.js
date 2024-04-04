function menudisplayer() {
    var menubtn = document.getElementById("ul");
    if (menubtn.classList == "" || menubtn.classList == "menu-up") {
        menubtn.classList.remove("menu-up");
        menubtn.classList.add("menu-small");
    } else {
        menubtn.classList.add("menu-up");
        setTimeout(function(){menubtn.classList.remove("menu-small"); menubtn.classList.remove("menu-up");}, 400);
    }
}