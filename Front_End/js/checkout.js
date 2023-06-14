// Get references to the form and the button
const myForm = document.querySelector('.disable_form');
const accessButton = document.querySelector('#accessButton');

// Disable all input fields within the form initially
myForm.querySelectorAll('input').forEach(element => {
    element.disabled = true;
});

// Enable all input fields within the form when the button is clicked
accessButton.addEventListener('click', () => {
    myForm.querySelectorAll('input').forEach(element => {
        element.disabled = false;
    });
    accessButton.style.display = 'none';
});