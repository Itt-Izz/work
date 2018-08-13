    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">  
    <title>Work Online </title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
     <link rel="icon" href="logo.png" type="image/x-icon">
    <link href="assets/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-default">
  <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>   
        <ul class="nav navbar-nav">
          <li><a class="navbar-brand" href="#" id="lasitStyl" >LasitTeaCompany</a>
          </li>
          <li><a href="#"> <img src="img/logo.png" id="hdimg2"></a></li>
        </ul>
  </div>
  </nav> 
    <form class="form-horizontal" method='POST' action='login.php'> 
                <fieldset>
                <!-- Form Name -->
                <legend>
      <?php
       $url = "http://" . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
            if (strpos($url, 'error')) {
              echo "<span style='color: red;'> Username and password mismatch. Please Try again</span>";
            }
             ?><br>Login
                      </legend>
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label">Username</label>  
                  <div class="col-md-4">
                  <input id="" name="username" type="text"  class="form-control input-md" required>
                  </div>
                </div>
                <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label">Password</label>
                  <div class="col-md-4">
                    <input id="" name="password" type="password" class="form-control input-md" required>
                  </div>
                </div>  
                
                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-4">
                    <a href="#" id="forgot">Forgot Password</a>
                    <button name="submit" class="btn btn-warning pull-right" id="log">Login</button>
                  </div>
                  <div class="col-md-4"></div>
                </div>
                </fieldset>
                </form>
  </body>
<?php include 'inc/footer.php'; ?>
    <script src="assets/jquery-3.2.1.min.js"></script> 
    <script src="assets/script.js"></script>     
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function() {
     $('#forgot').click(function(){
      alert('Please contact')
     })
      });
    </script>
</html>
  