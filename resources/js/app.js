import "./bootstrap";

import Alpine from "alpinejs";

import anchor from '@alpinejs/anchor'
 

window.Alpine = Alpine;

Alpine.data("textAnimation", () => ({
    init() {
        // Wrap every letter in a span
        var textWrapper = document.querySelector(".ml1 .letters");
        textWrapper.innerHTML = textWrapper.textContent.replace(
            /\S/g,
            "<span class='letter'>$&</span>"
        );

        anime
            .timeline({ loop: true })
            .add({
                targets: ".ml1 .letter",
                scale: [0.3, 1],
                opacity: [0, 1],
                translateZ: 0,
                easing: "easeOutExpo",
                duration: 600,
                delay: (el, i) => 70 * (i + 1),
            })
            .add({
                targets: ".ml1 .line",
                scaleX: [0, 1],
                opacity: [0.5, 1],
                easing: "easeOutExpo",
                duration: 700,
                offset: "-=875",
                delay: (el, i, l) => 80 * (l - i),
            })
            .add({
                targets: ".ml1",
                opacity: 0,
                duration: 1000,
                easing: "easeOutExpo",
                delay: 1000,
            });
    },
}));

Alpine.data("backMusic", () => ({
    URL: null,

    init() {
        this.$watch("URL", () => {
            const audio = new Audio(this.URL);
            audio.volume = 0.1
            audio.play();
        });
    },
    loadAudio(data) {
        this.URL = data;
    },
}));

Alpine.plugin(anchor)

Alpine.start();
