$(document).ready(function (){
    $("#contactBtn").click(sendContactForm);
});

function sendContactForm(){

    let $message = $("textarea[name='contactMessage']");
    let $email = $("input[name='contactEmail']");
    let $name = $("input[name='contactName']");
    let $subject = $("input[name='contactSubject']");


    let nameReg = /^[A-Z][a-z]{2,}$/;
    let subjectReg = /^[A-Z]/;
    let emailReg = /^[a-z]+[a-z\d]{2,}(\.[a-z\d]+)*@[a-z]{2,}(\.[a-z]{2,})+$/;

    if($message.val().length < 20 || $message.val().length > 100){
        alert("Message must be at least 20 chars long, and shorter than 100 characters.");
        return;
    }

    if(!nameReg.test($name.val())){
        alert("Name must start with an uppercase letter and follow with lowercase letters.")
        return;
    }

    if(!emailReg.test($email.val())){
        alert("Invalid email format. Email must start with a letter and contain only letters and numbers.");
        return;
    }

    if(!subjectReg.test($subject.val())){
        alert("Subject must start with an uppercase letter.");
        return;
    }

    $.ajax({
        url: "models/public/send_contact_form.php",
        method: "POST",
        dataType: "json",
        data: {
            message: $message.val(),
            name: $name.val(),
            email: $email.val(),
            subject: $subject.val(),
            contactBtn: true
        },
        success: function(data){
            alert("Message sent successfuly.");
            location.reload();
        },
        error: function(xhr,errType,errMsg){
            var errJson = JSON.parse(xhr.responseText);
            alert(errJson.message);
        }
    });
}