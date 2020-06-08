$(document).ready(function(){
    $("#loginBtn").click(validateLogin);
});

function validateLogin(){
    hideFormFeedbacks();

    let $email = $("#loginEmail");
    let $password = $("#loginPassword");

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

    $.ajax({
        url: "index.php?page=4",
        method: "POST",
        dataType: "json",
        data: {
            email: $email.val(),
            password: $password.val(),
            login: true
        },
        success: function(data){
            alert(data.message);
            window.location.href = "index.php";
        },
        error: function(xhr,errType,errMsg){
            var errJson = JSON.parse(xhr.responseText);
            alert(errJson.message);
        }
    });
}

function hideFormFeedbacks(){
    $("#loginEmail").next().hide();
    $("#loginPassword").next().hide();
}