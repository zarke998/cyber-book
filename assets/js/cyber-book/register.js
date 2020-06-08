$(document).ready(function(){
    $("#registerBtn").click(validateRegister);
    $("#resendActivationLink a").click(resendActivationLink);
});

function validateRegister(){
    hideFormFeedbacks();

    let $email = $("#registerEmail");
    let $password = $("#registerPassword");
    let $passwordConfirm = $("#registerConfirmPassword");

    let emailReg = /^[a-z]+[a-z\d]{2,}(\.[a-z\d]+)*@[a-z]{2,}(\.[a-z]{2,})+$/;
    let passwordReg = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    if(!emailReg.test($email.val())){
        $email.next().show();
        $email.next().text("Invalid email format. Email must start with a letter and contain only letters and numbers.");
        return;
    }
    if(!passwordReg.test($password.val())){
        $password.next().show();
        $password.next().text("Invalid password format. Password must contain at least one lowercase and uppercase letter, and a number. And it must be at least 8 characters long.");
        return;
    }
    if($password.val() != $passwordConfirm.val()){
        $passwordConfirm.next().show();
        $passwordConfirm.next().show().text("Passwords do not match.");
        return;
    }

    $.ajax({
        url: "index.php?page=5",
        method: "POST",
        dataType: "json",
        data: {
            email: $email.val(),
            password: $password.val(),
            "register": "true"
        },
        success: function(data){
            alert(data.message);
        },
        error: function(xhr,errType,errMsg){
            var errJson = JSON.parse(xhr.responseText);
            alert(errJson.message);
        }
    });
}
function resendActivationLink(e){
    e.preventDefault();

    hideFormFeedbacks();

    var $email = $("#registerEmail");
    
    let emailReg = /^[a-z]+[a-z\d]{2,}(\.[a-z\d]+)*@[a-z]{2,}(\.[a-z]{2,})+$/;

    if(!emailReg.test($email.val())){
        $email.next().show();
        $email.next().text("Invalid email format. Email must start with a letter and contain only letters and numbers.");
        return;
    }

    $.ajax({
        url: "models/public/resend_activation_link.php",
        method: "POST",
        dataType: "json",
        data: {
            email: $email.val()
        },
        success: function(data){
            alert(data.message);
        },
        error: function(xhr,errType,errMsg){
            var errJson = JSON.parse(xhr.responseText);
            alert(errJson.message);
        }
    });
}

function hideFormFeedbacks(){
    $("#registerEmail").next().hide();
    $("#registerPassword").next().hide();
    $("#registerPasswordConfirm").next().hide();
}