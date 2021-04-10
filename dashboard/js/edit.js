const editCompanyName = document.getElementById('editCompanyName');
const editCompanyLocation = document.getElementById('editCompanyLocation');
const editCategory = document.getElementById('editCategory');
const editJobTime = document.getElementById('editJobTime');
const editUrl = document.getElementById('editUrl');
const editMsgBody = document.getElementById('editMsgBody');
const editBtn = document.getElementById('editBtn');
// End of fields

// // success responses
let editResponseErr = document.querySelector('.editResponseErr');

// check input > 0 && undisaled button and get company fields
const checkEditCompanyFields = () => {
    if (editCompanyName.value.length && editCompanyLocation.value.length && editCategory.value.length && editJobTime.value.length && editUrl.value.length && editMsgBody.value.length > 0) {
        editBtn.removeAttribute('disabled', 'disabled');
        editBtn.style.background = '#fb7c6d';
        editBtn.style.border = '#fb7c6d';
        editBtn.style.cursor = 'pointer';
    } else {
        editBtn.setAttribute('disabled', 'disabled');
        editBtn.style.background = '#6c757d';
        editBtn.style.cursor = 'progress';
    }
} 
editCompanyName.addEventListener('keyup', checkEditCompanyFields);
editCompanyLocation.addEventListener('keyup', checkEditCompanyFields);
editCategory.addEventListener('keyup', checkEditCompanyFields);
editJobTime.addEventListener('keyup', checkEditCompanyFields);
editUrl.addEventListener('keyup', checkEditCompanyFields);
editMsgBody.addEventListener('keyup', checkEditCompanyFields);

// added timeout for removing the response
if (editResponseErr) {
    setTimeout(() => {
        response.remove();
    }, 5000);
}
