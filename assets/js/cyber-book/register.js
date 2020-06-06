$(document).ready(function(){

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
        return false;
    }
    if(!passwordReg.test($password.val())){
        $password.next().show();
        $password.next().text("Invalid password format. Password must contain at least one lowercase and uppercase letter, and a number. And it must be at least 8 characters long.");
        return false;
    }
    if($password.val() != $passwordConfirm.val()){
        $passwordConfirm.next().show();
        $passwordConfirm.next().show().text("Passwords do not match.");
        return false;
    }

    return true;
}

function hideFormFeedbacks(){
    $("#registerEmail").next().hide();
    $("#registerPassword").next().hide();
    $("#registerPasswordConfirm").next().hide();
}