<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		header('Location: index.php');
	}
	$error = '';
    //Call sql database connection
    require_once("conf/conn.php");
    //Checking
    if (isset($_POST["btn_submit"])) {
        // Get user information
        $username = $_POST["usr"];
        $password = $_POST["psw"];
		
        //Patched sql injection
        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        if ($username == "" || $password =="") {
            echo "Username or Password not empty!";
        }else{
            $sql = "select * from admin where user = '$username' and pass = '$password' ";
            $query = mysqli_query($mysql,$sql);
            $num_rows = mysqli_num_rows($query);
            if ($num_rows==0) {
				$error = '<div id="div1" class="alert alert-danger">
                            			Username or password wrong!
                        			</div>';
 			 }else{
				 
                //Save username and password to session
                $_SESSION['username'] = $username;
                // Excuting action when complete form
                // We will go to index.php
                header('Location: index.php');
            }
        }
    }
?>
<!doctype html>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <title>Login - Bot facebook</title>
</head>
<body>
<header>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Botfacebook</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    </ul>
  </div>
</nav>

</header>
<br>
<br>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Login Information</div>
                <div class="panel-body">
                    <form action="login.php" method="post">
						<?php
								echo $error;
						?>
                        <div class="form-group">
                            <label for="user">Username:</label>
                            <input type="text" class="form-control" name="usr">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" name="psw">
                        </div>
                        <button name="btn_submit" type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="navbar-fixed-bottom">
    	Developer by Qui Huynh
    </footer>
</body>
</html>
