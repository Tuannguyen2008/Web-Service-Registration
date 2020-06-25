<?php
	session_start();
	if (!isset($_SESSION["RegState"])) {
		$_SESSION["RegState"] = 0;
	
	}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon1.ico">
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
<?php
	if (($_SESSION["RegState"] <= 0)  || ($_SESSION["RegState"] == 3)){
	
?>	
		<form id="loginView" action="php/login.php" method="post" class="form-signin">
  			<img class="mb-4" src="images/bootstrap-solid.svg" alt="Logo" width="72" height="72">
 			  <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
  			<label for="inputEmail" class="sr-only">Email address</label>
  			<input type="email" name="Email" id="inputEmail" class="form-control" 
			     placeholder="Email Address" required autofocus>
  			<label for="inputPassword" class="sr-only">Password</label>
  			<input type="password" name="Password" id="inputPassword" class="form-control" 			placeholder="password" required>
  			<div class="checkbox mb-3">
    		<label>
      			<input name="rememberMe" type="checkbox" value="remember-me"> Remember me
    		</label>
 			  </div>
  			<button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in
  			</button>
  			<p> 
  				<a href="php/register.php">Register</a>
  				|
  				<a href="php/resetPassword.php">Forget?</a>
          </a> 
  			</p>
  				<button name="MessageBox" class="btn btn-lg btn-info btn-block">
  				  <?php
					     echo $_SESSION["Message"];
					     $_SESSION["Message"] = "";
					     $_SESSION["RegState"] = 0;
				    ?>
		
  				</button>
  		
  			<p class="mt-5 mb-3 text-muted">
  				&copy; 2017-2020 
  		</p>
	</form>	
<?php
	}
?>

<?php
  if ($_SESSION["RegState"] == 5) { 
?>
    <form id="registerView" action="php/register2.php" method="get" class="form-signin">
      <img class="mb-4" src="images/bootstrap-solid.svg" alt="Logo" width="72" height="72">   
      <h1 class="h3 mb-3 font-weight-normal">Please Register</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="Email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>  
      <label for="inputFirstName" class="sr-only">First Name</label>
      <input type="text" name="FirstName" id="inputFirstName" class="form-control" placeholder="Your First Name" required>
      <label for="inputLastName" class="sr-only">Last Name</label>
      <input type="text" name="LastName" id="inputLastName" class="form-control" placeholder="Your Last Name" required>
      <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">
        Register
      </button> 

      <p><a href="php/signout.php">Return to login view</a></p>

      <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
    </form>
<?php
  }
?>

<?php
  if ($_SESSION["RegState"] == 6) {
?>
  
    <form id="setPasswordView" action="php/setPassword.php" method="post" class="form-signin">
        <img class="mb-4" src="images/bootstrap-solid.svg" alt="Logo" width="72" height="72">    
        
        <label for="inputPassword" class="sr-only">New Password</label>
        <input type="password" name="Password" id="inputPassword" class="form-control"     
         placeholder="Password" required>     
        <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">
          Set Password
        </button>
        <p class="mt-5 mb-3 text-muted">
          &copy; 2017-2020 
        </p>
    </form>
<?php
  }
?>

<?php
  if ($_SESSION["RegState"] == 7) { 
?>
    <form id="resetPasswordView" action="php/resetPassword2.php" method="post" class="form-signin">
      <img class="mb-4" src="images/bootstrap-solid.svg" alt="Logo" width="72" height="72"> 

      <h1 class="h3 mb-3 font-weight-normal">Please Reset Password</h1>

      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="Email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>  
  
      <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">
        Reset Password
      </button>    

       <p><a href="php/signout.php">Return to login view</a></p>
       
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
    </form>
<?php
  }
?>

</body>
</html>


