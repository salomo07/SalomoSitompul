<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>IT Inventory</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
</head>
<body class="hold-transition login-page">
<div class="col-xs-6"><a href="#" id="company-branding" class="fr"><img src="images/company-logo.png" alt="PSG logo"></a></div>
<div class="col-xs-6"><a href="#" id="company-branding" class="fr"><img src="images/company-logo.png" alt="BC logo"></a></div>
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>">IT Inventory</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="login/loging" method="post">
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $.ajax({
        url: "<?php echo base_url();?>login/loging",
        method:"POST",
        data : { username:, password:},
        success: function (response) 
        {

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          console.log("Error: " + errorThrown); 
        }
  });
</script>
</body>
</html>
