<?php
	//Call sql database connection
    require_once("../conf/conn.php");
	//Checking login
	
?>
<?php
			$sql = "SELECT name FROM user";
			$result = $mysql->query($sql);
			$count = 0;
			while($data = $result->fetch_assoc())
			{
				$sql1 = "UPDATE user SET id = ".$count." WHERE name = '".$data['name']."';";
				echo $sql1;
				echo '<br>';
				$mysql->query($sql1);
				$count++;
			}
?>