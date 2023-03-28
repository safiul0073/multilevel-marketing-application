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

    var splide3 = new Splide("#splide3", {
        type: "loop",
        speed: 1000,
        pagination: false,
        // arrows: false,
        autoplay: true,
        interval: 3000,
        perPage: 3,
        perMove: 1,
        clones: true,
        focus: true,
    });
    splide3.mount();
});

function openTab(event, tabName) {
    var i, tabContent, tabLings, activeClassList, defaultClassList;
    tabContent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabContent.length; i++) {
        tabContent[i].classList.add("hidden");
    }
    tabLings = document.getElementsByClassName("tablinks");
    activeClassList = ["bg-indigo-500", "text-gray-200"];
    defaultClassList = ["bg-white", "text-gray-700"];
    for (i = 0; i < tabLings.length; i++) {
        for (j = 0; j < 2; j++) {
            tabLings[i].classList.remove(activeClassList[j]);
            tabLings[i].classList.add(defaultClassList[j]);
        }
    }
    document.getElementById(tabName).classList.remove("hidden");
    for (j = 0; j < 2; j++) {
        event.target.classList.add(activeClassList[j]);
    }
}
