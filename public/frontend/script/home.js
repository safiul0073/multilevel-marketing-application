// hello world
// here you can write some js for home page

document.addEventListener("DOMContentLoaded", function () {
    var splide1 = new Splide("#splide1", {
        type: "loop",
        speed: 2000,
        heightRatio: 0.6,
        arrows: false,
        autoplay: true,
        direction: "ttb",
        interval: 3500,
    });
    splide1.mount();

    var splide2 = new Splide("#splide2", {
        type: "loop",
        speed: 1000,
        pagination: false,
        autoplay: true,
        interval: 2500,
    });
    splide2.mount();
});

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
