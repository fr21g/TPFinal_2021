$("#contasctForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Nombre de usuario y/o password incorrecto");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
        
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    var usnombre = $("#usnombre").val();
    var password = $("#password").val();
    /*var msg_subject = $("#msg_subject").val();
    var message = $("#message").val();*/


    $.ajax({
        type: "POST",
        url: "../paginas/login.php",
        data: "usnombre=" + usnombre + "&passworld=" + password /*+ "&msg_subject=" + msg_subject + "&message=" + message*/,
        success : function(text){
            if (text == "sucscess"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(){
    $("#contactForm")[0].reset();
    submitMSG(true, "Message Submitted!")
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}