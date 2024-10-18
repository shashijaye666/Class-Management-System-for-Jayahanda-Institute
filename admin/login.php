<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</head>
<body class="hold-transition login-page">

<?php 

// session_start();
//if(isset($_SESSION['UserId'])){
   //echo "Your session is running " . $_SESSION['UserId'];
    // print_r($_SESSION);
//}
?>


<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <!-- <input type="hidden" id="userid" value="<?php echo $_SESSION['UserId'] ?>"/> -->
      <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-4">
          <button class="btn btn-primary" type="button" id="btnlogin">Log in</button>
          </div>
          <!-- /.col -->
        </div>
        
      </form>

     
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div> -->
    <!-- /.login-card-body -->
  </div>
</div>
<div class="clearfix"></div>

<div class="separator">
  

  <div class="clearfix"></div>
  <br />

  <div>
   
    <p>©2022 All Rights Reserved. Powered by <a href="https://www.linkedin.com/in/shashikajaye">Shashika Jayathilaka</a>></p>
  </div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


<script type="application/javascript" src="js/login.js"></script>
</body>
</html>
