document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById("mlm-toggler-button");
    const menu = document.getElementById("mlm-mobile-menu");
    var mobile_menu_toggled = false;
    button.addEventListener(
        "click",
        function () {
            if (mobile_menu_toggled == false) {
                mobile_menu_toggled = true;
                menu.classList.add("active-menu");
            } else {
                mobile_menu_toggled = false;
                menu.classList.remove("active-menu");
            }
        },
        false
    );
});


