$('#main-contact-form').submit(function (event) {
    event.preventDefault();
        var name=$('input[name="name"]').val();
        var email=$('input[name="email"]').val();
        var phone=$('input[name="phone"]').val();
       var message =$('textarea[name="message"]').val();
       $.post('functions/message.php',{name,email,phone,message},function(data){
        $('.newData').html(data).hide().fadeIn();
        $('#main-contact-form input:not([type="submit"]').val('');
         $('#main-contact-form textarea').val('');
         setTimeout(function(){
            $('.newData').fadeOut();  
         }, 3000);

       }).fail(function(xhr, status, error){
       console.log("AJAX Error:", status);
        console.log("HTTP Error:", xhr.status);
        console.log("Server Response:", xhr.responseText);
       })

    
})