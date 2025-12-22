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
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
        errorDiv.style.color = '#dc3545';
        errorDiv.style.marginTop = '5px';
        errorDiv.style.fontSize = '0.9rem';

        //addd to form group
        formGroup.appendChild(errorDiv);

        // highlight field
        field.style.borderColor = '#dc3545';
        field.style.backgroundColor = '#fff8f8';
    }


    //clear errors 
    function clearErrors(){
        document.querySelectorAll('.error-message').forEach(el => el.remove());

        //reset field styles
        document.querySelectorAll('input, textarea').forEach(field=>{
            field.style.borderColor = '#e0e0e0';
            field.style.backgroundColor = '#ffffffff';
        });
    }

    // notification system
    function showNotification(message, type){
        //remove current notification
        const existing = document.querySelector('.notification');
        if(existing) existing.remove();

        //create notification
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
        <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i>
        <span>${message}</span>
        <button onClick="this.parentElement.remove()">&times;</button>`;

        //style notification
        notification.style.cssText=`
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 10px;
        background: ${type === 'error' ? '#dc3545' : '#28a745'};
        color: white;
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 1000;
        animation: slideIn 0.3s;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);`;


        
    } 
})