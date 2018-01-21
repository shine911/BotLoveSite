<?php
    session_start();

	if(!(isset($_SESSION['username'])))
	{
		header('Location: login.php');
	}
	//Call sql database connection
    require_once("conf/conn.php");
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

    <title>Bot facebook</title>
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
<div class="row">
    <!--SideBar-->
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Adminstration</div>
            <div class="panel-body">Something</div>
        </div>
    </div>
    <!--EndSideBar-->

    <!--Content-->
    <div class="col-sm-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                Infomation
            </div>
            <div class="panel-body">
            <!--Table-->
              <table class="table table-hover" width="75%">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
					$sql ='SELECT * FROM user';
					$result = mysqli_query($mysql,$sql);
				
					while($row = mysqli_fetch_array($result))
					{
						/* Set active or offline status */
						if($row['status']==1)
						{
							$status = "ACTIVE";
							$color = "green";//Active coloring green
						} else
						{
							$status = "OFFLINE";
							$color = "red"; //Offline coloring red
						}
						echo'
						  	<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['name'].'</td>
							<td style="color:'.$color.'">'.$status.'</td>
							<td> <a href="?edit='.$row['id'].'"><button class="btn btn-primary">Edit</button></a>&nbsp;
								 <a href="?del='.$row['id'].'"><button class="btn btn-danger">Delete</button>
							</td>
							</tr>
						';
					}
				  ?>
                  </tbody>
              </table>
	<!--AddButton-->
    <div class="col-sm-offset-10 col-sm-2">
    <a href="add.php"><button name="btn_add" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Add User</button></a>
     </div>
    <!--EndAddButton-->
              <!--EndTable-->
            </div>
        </div>
    </div>

    <!--EndContent-->
</div>
</body>
</html>
<?php

	if(isset($_GET['edit']))
	{
		//WriteModal
		$id = $_GET['edit'];
		//Call submit button
		if(isset($_POST['btn_submit']))
		{
			$token = $_POST['token'];
			$name = $_POST['name'];
			$sql = "UPDATE `user` SET `token` = '".$token."', name='".$name."' WHERE `user`.`id` = ".$id.";";
			$result = mysqli_query($mysql,$sql);
		}
		
		$sql = "SELECT * FROM `user` WHERE `id`='".$id."'";
		$result = mysqli_query($mysql,$sql);
		if($result)
		{
			$getInfo = mysqli_fetch_array($result);
		}
		echo'
		<!-- Modal -->
		  <div class="modal fade" id="editModal" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Editable</h4>
				</div>
				<form method="post" class="form-horizontal" action="index.php?edit='.$id.'">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID:</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="id" value="'.$getInfo['id'].'" disabled>
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-sm-2" for="name">Name:</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="name" value="'.$getInfo['name'].'">
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-sm-2" for="token">Token:</label>
							<div class="col-sm-10"> 
							  <input type="text" class="form-control" name="token" value="'.$getInfo['token'].'">
							</div>
						  </div>
					</div>
					<div class="modal-footer">
						<div class="form-group">
						  <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;
						</div>
					</div>
				</form>
			  </div>
			  
			</div>
		  </div>
		<!--EndModal-->
		';
		?>
        <!--Call Modal-->
		<script>
			$("#editModal").modal();
		</script>
        <?php
	}
	if(isset($_GET['del']))
	{
		$id = $_GET['del'];
		$sql = "DELETE FROM `user` WHERE `user`.`id`='".$id."'";
		if (mysqli_query($mysql, $sql)) {
			$sql = "SELECT name FROM user";
			$result = $mysql->query($sql);
			$count = 1;
			while($data = $result->fetch_assoc())
			{
				$sql1 = "UPDATE user SET id = ".$count." WHERE name = '".$data['name']."';";
				$mysql->query($sql1);
				$count++;
			}
			?>
            <!--Alert and Go back index-->
            <script>
				alert("Account delete successfully");
				window.location = "index.php";
			</script>
			<?php
		}
	}
?>