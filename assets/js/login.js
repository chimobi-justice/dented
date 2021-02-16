// get email input
let emailAddress = document.getElementById('emailAddress');
// get error for emailaddress
let emailErrFeed = document.getElementById('errResponseEmail');
// get password input
let psw = document.getElementById('password');
// get error for password
let pswErrFeed = document.getElementById('errResponsePassword');
// button to click and show password
let showPassword = document.querySelector('.showPassword');
// button to click and hide password
let hidePassword = document.querySelector('.hidePassword');
// get password input for hide and show
let changePassword = document.querySelector('#password');



// clear display error messages
const clearErr = () => {
    if (emailAddress.value.length > 0) {
        emailErrFeed.textContent = '';
    }
    if (psw.value.length > 0) {
        pswErrFeed.textContent = '';
    } 
}
emailAddress.addEventListener('keyup', clearErr);
psw.addEventListener('keyup', clearErr);

// functions for hide and show buttons
const showPasswordInputText = () => {
    if (showPassword) {
        changePassword.setAttribute('type', 'text'); 
        hidePassword.style.display = 'block';
        showPassword.style.display = 'none';

    } 
}
showPassword.addEventListener('click', showPasswordInputText);

const hidePasswordInputText = () => {
    if (hidePassword) {
        changePassword.setAttribute('type', 'password'); 
        hidePassword.style.display = 'none';
        showPassword.style.display = 'block';
    }
}
hidePassword.addEventListener('click', hidePasswordInputText);
// End of hide and show function
