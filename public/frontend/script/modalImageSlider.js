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

function showImageSlider(images) {
    var sliderInputDiv = document.getElementById("swiper-images");
    if (images.length > 0) {
        var images_str = "";
        images?.map((image) => {
            images_str += `<div class="swiper-slide">
            <img
            class="object-cover w-full h-full"
            src="${image?.url}"
            alt="image"
            />
        </div>`;
        });
        sliderInputDiv.innerHTML = images_str;
    } else {
        sliderInputDiv.innerHTML =
            "<h1 class='text-center'>Sorrry! there is no images right now.</h1>";
    }
}
