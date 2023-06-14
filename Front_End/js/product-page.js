const sizeButton = document.querySelectorAll(".item-size");

sizeButton.forEach ((button, index) => {
    button.addEventListener("click", () => {
        button.classList.add("active");

        for(x in sizeButton) {
            if( x != index) {
                sizeButton[x].classList.remove("active");
            }
        }
    });
});

