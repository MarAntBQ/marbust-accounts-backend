// Menu Variables
let menu = document.getElementsByClassName('js-header-nav')[0];
let main = document.getElementsByTagName('main')[0];
let menuBtn = document.getElementsByClassName('js-header-btn-open')[0];

// Activate Menu in the Header Btn.
menuBtn.addEventListener('click', event => {
  menuFunction();
});

// Close the Menu from the Main.
main.addEventListener('click', event => {
  if (menu.classList.contains("header__nav--active")) {
    main.classList.remove('main--menu-active');
    menu.classList.add("header__nav--desactive");
    setTimeout(function(){menu.classList.remove("header__nav--active"); menu.classList.remove("header__nav--desactive");}, 500);
  }
});

// Opens Sub Menu in Mobile Version.
menu.addEventListener('click', event => {
  if (event.target.classList.contains('js-has-menu-icon')) {
    event.target.parentElement.click();
  } 
  if (event.target.classList.contains('js-has-menu-a')) {
    console.log('clickando el right menu');
    var currentElement = event.target.parentElement;
    var subMenu = currentElement.getElementsByClassName('js-sub-menu')[0];
    if (subMenu.classList.contains('sub-menu--active')) {
      subMenu.classList.remove('sub-menu--active');
      currentElement.classList.remove('has-menu--mobile-active');
    } else {
      subMenu.classList.add('sub-menu--active');
      currentElement.classList.add('has-menu--mobile-active');
    }
  }
});

function menuFunction() {
  console.log('Ready');
  console.log(menu.classList.contains("header__nav--active"));
  if (menu.classList.contains("header__nav--active")) {
    main.classList.remove('main--menu-active');
    menu.classList.add("header__nav--desactive");
    setTimeout(function(){menu.classList.remove("header__nav--active"); menu.classList.remove("header__nav--desactive");}, 500);
  } else {
    main.classList.add('main--menu-active');
    menu.classList.add("header__nav--active");
  }
}