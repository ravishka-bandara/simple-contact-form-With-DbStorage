document.addEventListener('DOMContentLoaded',function(){
    const form = document.getElementById('contactForm');
    const phoneInput = document.getElementById('phone');

    //phone number format
    phoneInput.addEventListener('input',function(e){
        let value = e.target.value.replace(/\D/g, '');
        if(value.length >10) value=value.substring(0, 10);

        // phone number format as (123) 456-789 
         if (value.length > 0) {
            value = '(' + value;
            if (value.length > 4) {
                value = value.substring(0, 4) + ') ' + value.substring(4);
            }
            if (value.length > 9) {
                value = value.substring(0, 9) + '-' + value.substring(9);
            }
            if (value.length > 14) {
                value = value.substring(0, 14);
            }
        }
        e.target.value = value;
    });

    // form validation before submition
    form.addEventListener('submit',function(e){
        let isValid = true;
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();

        //clear errors
        clearErrors();

        // name validatoion
        if (name.length < 2){
            showError('name', 'Name must be at least 2 characters');
            isValid = false;
        }

        //email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email)){
            showError('email','please enter a valid email address');
            isValid = false;
        }

        //message validation
        if(message.length < 10){
            showError('message','message must be at least 10 characters');
            isValid = false;
        }

        if(!isValid){
            e.preventDefault();
            showNotification('please fix the errors in the form', 'error');
        } else{
            showNotification('Submitting form...', 'success');
        }
    });

    // Error display function
    function showError(fieldId, message){
        const field = document.getElementById(fieldId);
        const formGroup = field.closest('.form-group');

        //error element
        
    }
})