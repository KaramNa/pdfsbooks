window.onload = function() {
    var ad = document.querySelector("ins.adsbygoogle");
    if (ad && ad.innerHTML.replace(/\s/g, "").length == 0) {
        document.getElementById("free_download_link_div").innerHTML =
            "<div class='adblock-alter'>Ads Help us to keep this service up and free, please disable your ad blocker to get the free download link, Thanks for your understanding</div>";
    } else {
        document.getElementById("free_download_link_button").classList.remove('hidden');
    }
};

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