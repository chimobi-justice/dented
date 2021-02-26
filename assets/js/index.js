// click login button to redirect user to login
const loginBtn = document.getElementById('loginBtn');
// click get started button to redirect user to login
const getStartedBtn = document.getElementById('getStartedBtn');
// button to click to post a job
const postJob = document.getElementById('postJob');
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

const postTheJob = () => {
    if (postJob) {
        location.href = 'auth/login.php';
    }
} 
postJob.addEventListener('click', postTheJob);

// anded timeout for removing response
if (sucriptionResponse) {
    setTimeout(() => {
        sucriptionResponse.remove();
    }, 5000);
}