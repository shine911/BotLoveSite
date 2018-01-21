<?php
    session_start();

	if(!(isset($_SESSION['username'])))
	{
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();
echo '<script>
		alert("Bye!");
		window.location="login.php";
	</script>';
?>

</body>
</html>