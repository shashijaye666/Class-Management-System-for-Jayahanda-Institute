$(document).keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $('#SignIn').trigger('click');
    }
  });

$('#SignIn').click(function () {

    var username = $('#UsrName').val();
    var password = $('#Pasword').val();

    if (username.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter Username!',
        });
    }
    else if (password.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter Password!',
        });
    }
    else {
       
        $.ajax({

            method: "POST",
            url: "pages/login.php",
            data: { 'request': 'validateUserLogin','UserName': username, 'PassWord': password },
            success: function (response) {
    
                $data = $.parseJSON(response);
                if( $data==1){
                    var path = window.location.href;
                    var split = path.split("/");
                    var x = split.slice(0, split.length - 1).join("/") + "/";
                    location.replace(x+"?page=dashboard");
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid Username or Password!',
                    });
                }

            },
            failure: function (response) {
                alert(response);
            },
        });

    }

});
