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
async function getOneProduct(id) {
    let res = await fetch(`get-one-product-res?id=${id}`);
    var data = await res.json();
    //     checkout url setting
    var checkoutButton = document.getElementById("checkout_button");
    checkoutButton.setAttribute("href", `set-sponsor/?slug=${data?.slug}`);

    var description = document.getElementById("description");
    description.innerText = data.description;
    document.getElementById("product_name").innerText = data.name;
    document.getElementById("price").innerHTML =
        "<b>Price:</b> " + data.price + "TK";
    document.getElementById("category").innerHTML =
        "<b>Category:</b> " + data?.category?.title;
    document.getElementById("referral_commission").innerHTML =
        "<b>Referral Commission:</b> " +
        data?.refferral_commission +
        (data?.referral_type == "percent" ? "%" : "");
    document.getElementById("vedio_link").src = data?.video_url ?? "";
    var sliderInputDiv = document.getElementById("swiper-images");
    if (data?.images?.length > 0) {
        var images = "";
        data?.images?.map((image) => {
            images += `<div class="swiper-slide">
         <img
           class="object-cover w-full h-full"
           src="${image?.url}"
           alt="image"
         />
       </div>`;
        });
        sliderInputDiv.innerHTML = images;
    }
}
