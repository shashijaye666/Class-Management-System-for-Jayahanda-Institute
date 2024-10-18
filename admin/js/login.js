





function validatelogin(){

    var username=$('#username').val();
    var password=$('#txtpassword').val();

    if(username=="" || password==""){
         
      $.confirm({
            title: 'Warning',
            content: 'Username and Password cannot be empty',
            type: 'Red',
            buttons:{
            Ok:{
                text: "ok!",
                btnClass: 'btn-primary',
                keys: ['enter'],
                
            },
            }
        });
      

        return false;

    }else{

       return true;
    }
}


$(document).on('click','#btnlogin',function(){

    if(validatelogin()){

        userlogin();
    }

});


function userlogin(){
    var login="login";

    var username=$('#username').val();
    var password=$('#password').val();

$.ajax({
 
    method:"POST",
    url:"pages/login.php",
    data:{username:username,password:password,login:login},

    success:function(data){
        var value=data.trim();
        
        
        if(value!=='[]'){

            window.location.href="/PoliceApp/admin";

        }else {
            $.confirm({
                title: 'Warning',
                content: 'Please Enter a valid username or password',
                type: 'Red',
                buttons:{
                Ok:{
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    
                },
                }
            });
            return false;
        }
      
      

    }, 
    error:function(data){
      
         
    }


});

}