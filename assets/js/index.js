// click get started button to redirect user to login
const getStartedBtn = document.getElementById('getStartedBtn');
// button to click to post a job
const postJob = document.getElementById('postJob');
// sucription request responses
let sucriptionResponse = document.querySelector('.response');
// get fullyear
let copyRight = document.getElementById('copyright');


// get started  button function
const btnGetStarted = () => {
    if (getStartedBtn) {
        location.href = 'auth/signup.php';
    }
}
getStartedBtn.addEventListener('click', btnGetStarted);

const postTheJob = () => {
    if (postJob) {
        location.href = 'auth/login.php';
    }
} 
postJob.addEventListener('click', postTheJob);

// added timeout for removing response
if (sucriptionResponse) {
    setTimeout(() => {
        sucriptionResponse.remove();
    }, 5000);
}

let D = new Date();
copyRight.textContent = D.getFullYear();