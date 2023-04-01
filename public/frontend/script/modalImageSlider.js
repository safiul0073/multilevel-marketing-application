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
