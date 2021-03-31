// get company fields
const company_name = document.getElementById('companyName');
const company_location = document.getElementById('companyLocation');
const job_time = document.getElementById('jobTime');
const company_url = document.getElementById('url');
const job_description = document.getElementById('msgBody');
const submitBtn = document.getElementById('submitBtn');
// End of fields

// success responses
let response = document.querySelector('.response');


// check input > 0 && undisaled button and get company fields
const checkCompanyFields = () => {
    if (company_name.value.length && company_location.value.length && job_time.value.length && company_url.value.length && job_description.value.length > 0) {
        submitBtn.removeAttribute('disabled', 'disabled');
        submitBtn.style.background = '#fb7c6d';
        submitBtn.style.border = '#fb7c6d';
        submitBtn.style.cursor = 'pointer';
    } else {
        submitBtn.setAttribute('disabled', 'disabled');
        submitBtn.style.background = '#6c757d';
        submitBtn.style.cursor = 'progress';
    }
} 
company_name.addEventListener('keyup', checkCompanyFields);
company_location.addEventListener('keyup', checkCompanyFields);
job_time.addEventListener('keyup', checkCompanyFields);
company_url.addEventListener('keyup', checkCompanyFields);
job_description.addEventListener('keyup', checkCompanyFields);

// added timeout for removing the response
if (response) {
    setTimeout(() => {
        response.remove();
    }, 5000);
}



