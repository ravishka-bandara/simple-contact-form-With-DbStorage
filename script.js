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

    
})