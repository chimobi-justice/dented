let copyRight = document.getElementById('copyright');

// message to shown after signing up an account and remove message 
let errMessageDisplay = document.getElementById('errMessageDisplay');
if (errMessageDisplay) {
    setTimeout(() => {
        errMessageDisplay.remove();
    }, 5000);
}

let D = new Date();
copyRight.textContent = D.getFullYear();