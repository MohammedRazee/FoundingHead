// Quantity Manager
const quantityInputs = document.querySelectorAll(".quantity-input");

quantityInputs.forEach((input) => {
    const plusButton = input.nextElementSibling;
    const minusButton = input.previousElementSibling;

    plusButton.addEventListener("click", ()=> {
        input.value++;
    });

    minusButton.addEventListener("click", ()=> {
        if(input.value > input.min) {
            input.value--;
        }
    });
});


// If Cart Empty
const rows = document.getElementById("row_value");
let value = rows.getAttribute("data-value");

if (value == 0) {
    const empty = document.querySelector(".section");
    empty.classList.add("active");
    const empty1 = document.querySelector(".price-details");
    empty1.classList.add("active");

    const fall = document.querySelector(".default");
    fall.classList.add("active");
}