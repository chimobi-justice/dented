// get fullname input
let fullName = document.getElementById('fullname');
// get error for fullname
let fullNameErrFeed = document.getElementById('errResponseFullname');
// get email input
let emailAddress = document.getElementById('emailAddress');
// get error for emailaddress
let emailErrFeed = document.getElementById('errResponseEmail');
// get password input
let psw = document.getElementById('password');
// get error for password
let pswErrFeed = document.getElementById('errResponsePassword');
// button to click and show password


// clear display error messages
const clearErr = () => {
    if (fullName.value.length > 0) {
        fullNameErrFeed.textContent = '';
    }
    if (emailAddress.value.length > 0) {
        emailErrFeed.textContent = '';
    }
    if (psw.value.length > 0) {
        pswErrFeed.textContent = '';
    } 
}
fullName.addEventListener('keyup', clearErr);
emailAddress.addEventListener('keyup', clearErr);
psw.addEventListener('keyup', clearErr);