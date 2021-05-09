let name = document.getElementById('name');
let responseName = document.querySelector('#responseName');
let email = document.getElementById('email');
let responseEmail = document.querySelector('#responseEmail');
let subject = document.getElementById('subject');
let responseSubject = document.getElementById('responseSubject');
let message = document.getElementById('message');
let responseMessage = document.getElementById('responseMessage');

let contactResponse = document.querySelector('.err');



// clear display error messages
const clearErr = () => {
    if (name.value.length > 0) {
        responseName.textContent = '';
    }
    if (email.value.length > 0) {
        responseEmail.textContent = '';
    } 
    if (subject.value.length > 0) {
        responseSubject.textContent = '';
    }
    if (message.value.length > 0) {
        responseMessage.textContent = '';
    } 
}
name.addEventListener('keyup', clearErr);
email.addEventListener('keyup', clearErr);
subject.addEventListener('keyup', clearErr);
message.addEventListener('keyup', clearErr);


if (contactResponse) {
    setTimeout(() => {
        contactResponse.remove();
    }, 5000);
}
