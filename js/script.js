$(function(){
     $(".navbar a,footer a").on("click",function(event){
         event.preventDefault();
         var  hash = this.hash;

         $("body,html").animate({scrollTop: $(hash).offset().top},900,function(){window.location.hash = hash;})
     });

    $("#contact-form").submit(function (e) {
        e.preventDefault();
        $(".comment").empty();
        var postData = $("#contact-form").serialize();

        $.ajax({
            type: "POST",
            url: "php/contact.php",
            data: postData,
            dataType: "json",
            success: function (result) {
                if (result.isSuccess) {
                    $("#contact-form").append("<p class='remerciements' style='display: none;'>Votre message a bien été envoyé, je traite votre demande au plus vite ! :)</p>");
                    $("#contact-form")[0].reset();
                }
                else {
                    $("#firstname + .comment").html(result.firstnameError);
                    $("#name + .comment").html(result.nameError);
                    $("#email + .comment").html(result.emailError);
                    $("#telephone + .comment").html(result.telephoneError);
                    $("#message + .comment").html(result.msgError);
                }
            }
        });

    });
});