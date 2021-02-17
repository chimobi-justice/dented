// click login button to redirect user to login
const loginBtn = document.getElementById('loginBtn');
// click get started button to redirect user to login
const getStartedBtn = document.getElementById('getStartedBtn');
// sucription request responses
let sucriptionResponse = document.querySelector('.response');

// login  button function
const clickLoginBtn = () => {
    if (loginBtn) {
        location.href = 'auth/login.php';
    }
}
loginBtn.addEventListener('click', clickLoginBtn);

// get started  button function
const btnGetStarted = () => {
    if (getStartedBtn) {
        location.href = 'auth/login.php';
    }
}
getStartedBtn.addEventListener('click', btnGetStarted);

// anded timeout for removing response
if (sucriptionResponse) {
    setTimeout(() => {
        sucriptionResponse.remove();
    }, 5000);
}