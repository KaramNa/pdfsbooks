function closeDiv(button) {
    button.parentNode.parentNode.removeChild(button.parentNode);
    return false;
}

function showMenu() {
    document.getElementById("main-nav").classList.toggle("nav-menu-show-hide");
}

function hideMenu() {
    document.getElementById("main-nav").classList.remove("nav-menu-show-hide");
}

function nav(a) {
    if (a) {
        document.getElementById("menu").classList.add("active");
        document.getElementById("overlay").style.display = "block";
    } else {
        document.getElementById("menu").classList.remove("active");
        document.getElementById("overlay").style.display = "none";
    }
}