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

    var main = new Splide("#main-slider", {
        type: "fade",
        heightRatio: 0.5,
        pagination: false,
        arrows: false,
        cover: true,
    });

    var thumbnails = new Splide("#thumbnail-slider", {
        rewind: true,
        fixedWidth: 104,
        fixedHeight: 58,
        isNavigation: true,
        gap: 10,
        focus: "center",
        pagination: false,
        cover: true,
        dragMinThreshold: {
            mouse: 4,
            touch: 10,
        },
        breakpoints: {
            640: {
                fixedWidth: 66,
                fixedHeight: 38,
            },
        },
    });

    main.sync(thumbnails);
    main.mount();
    thumbnails.mount();
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

var modals = document.querySelectorAll("[data-modal]");

modals.forEach(function (trigger) {
    trigger.addEventListener("click", function (event) {
        event.preventDefault();
        var modal = document.getElementById(trigger.dataset.modal);
        modal.classList.add("open");
        var exits = modal.querySelectorAll(".modal-exit");
        exits.forEach(function (exit) {
            exit.addEventListener("click", function (event) {
                event.preventDefault();
                modal.classList.remove("open");
            });
        });
    });
});

// get model data
async function  getOneProduct (id) {
    let res = await fetch(`get-one-product-res?id=${id}`)
    var data = await res.json()
    var checkoutButton = document.getElementById('checkout_button');
    checkoutButton.setAttribute('href', `set-sponsor/?slug=${data?.slug}`)
    var description = document.getElementById('description')
    description.innerText = data.description
    document.getElementById('product_name').innerText = data.name
    document.getElementById("price").innerText ="Price: " + data.price + "TK"
    document.getElementById("category").innerText ="Category: " + data?.category?.title
    document.getElementById("referral_commission").innerText = "Referral Commission: " + data?.refferral_commission + "%"
    document.getElementById("vedio_link").src = data?.video_url
    var imageDiv =  document.getElementById("small-img-roll")
    var imageShowSlide = document.getElementById("image-shop-slid")
    if (data?.images?.length > 0) {
        var images = ''
       data?.images?.map((image) => {
         images += `<img src="${image?.url}" class="show-small-img" alt="">`
         imageShowSlide.innerHTML = `<img src="${image?.url}" id="show-img">`
       })
       imageDiv.innerHTML = images
    }


 }
