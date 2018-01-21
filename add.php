<?php
    session_start();

	if(!(isset($_SESSION['username'])))
	{
		header('Location: login.php');
	}
	//Call sql database connection
    require_once("conf/conn.php");
	if(isset($_POST['btn_submit']))
	{
		$name = $_POST['name'];
        $token = $_POST['token'];
        $react = $_POST['react'];
		$sql = "SELECT MAX(id) FROM `user`";
		$result = $mysql->query($sql);
		$max = $result->fetch_row();
		//Fetch max and count + 1 
		$id = (int)$max[0] + 1;
		$sql = "INSERT INTO `user` (`id`, `name`, `status`, `token`, `react`) VALUES ('".$id."', '".$name."','1','".$token."','".$react."')";
		$result = mysqli_query($mysql, $sql);
		if($result)
		{
			header("location: index.php");
		} else
		{
			echo 'false';
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <title>Adding user - Bot Facebook</title>
</head>
<body>

<head>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Bot Facebook</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
</head>
<div class="container-fluid">
	<div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Adding user for Facebook Bot
            </div>
            <div class="panel-body">
              <form action="add.php" method="post" name="form" id="form" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="name" class="control-label">Name:</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="token" class="control-label">Token:</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="token" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="react" class="control-label">Reaction:</label>
                        </div>
                        <div class="col-sm-10">
                            <select name="react" class="form-control">
                                <option value = "LIKE">LIKE</option>
                                <option value = "LOVE">LOVE</option>
                                <option value = "ANGRY">ANGRY</option>
                                <option value = "HAHA">HAHA</option>
                                <option value = "WOW">WOW</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success" name="btn_submit">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
              </form>
            </div>
      </div>
    </div>
</div>
</body>
</html>
<?php

?>