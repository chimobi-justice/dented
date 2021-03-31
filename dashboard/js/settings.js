// get input for fullname
let fullName = document.getElementById('settingFN');
// get error for Fullname
let errResponseFullname = document.getElementById('errResponseFullname');
// get email input
let emailAddress = document.getElementById('settingFN');
// get error for emailaddress
let emailErrFeed = document.getElementById('errResponseEmail');
// get current password input
let currentPsw = document.getElementById('current_passwd');
// get error for Current password
let pswCurrentErrFeed = document.getElementById('errResponseCurrentPasswd');
// get New password input
let newPsw = document.getElementById('new_passwd');
// get error for New password
let pswNewErrFeed = document.getElementById('errResponseNewPasswd');






// clear display error messages
const clearErr = () => {
    if (fullName.value.length > 0) {
        errResponseFullname.textContent = '';
    }
    if (emailAddress.value.length > 0) {
        emailErrFeed.textContent = '';
    }
    if (currentPsw.value.length > 0) {
        pswCurrentErrFeed.textContent = '';
    }
    if (newPsw.value.length > 0) {
        pswNewErrFeed.textContent = '';
    } 
}
fullName.addEventListener('keyup',clearErr);
emailAddress.addEventListener('keyup', clearErr);
currentPsw.addEventListener('keyup', clearErr);
newPsw.addEventListener('keyup', clearErr);