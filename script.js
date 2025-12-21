document.addEventListener('DOMContentLoaded',function(){
    const form = document.getElementById('contactForm');
    const phoneInput = document.getElementById('phone');

    //phone number format
    phoneInput.addEventListener('input',function(e){
        let value = e.target.value.replace(/\D/g, '');
        if(value.length >10) value=value.substring(0, 10);

        
    })
})