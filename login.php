<?php
session_start();
//session control
if(!isset($_SESSION['uname']) || $_SESSION['uname'] == " " || !isset($_SESSION['uid']) || $_SESSION['uid'] == " ")
{
	echo "<script language='javascript'>";
	echo "window.location='../index.php'";
	echo "</script> ";
	exit;
}

$_SESSION['start'] = time();

if(!isset($_SESSION['expire'])){
	$_SESSION['expire'] = $_SESSION['start'] + (1* 10) ; // ending a session in 30 seconds
}
$now = time();

if($now > $_SESSION['expire'])
{
	session_destroy();
	echo "Your session has expire !  <a href='logout.php'>Click Here to Login</a>";
}
else
{
	echo "This should be expired in 1 min <a href='logout.php'>Click Here to Login</a>";
}

include("connection.php"); //Establishing connection with our database

$error = ""; //Variable for storing our errors.

if(isset($_POST["submit"]))
{
	if(empty($_POST["username"]) || empty($_POST["password"]))
	{
		$error = "Both fields are required.";
	}else
	{
		// Define $username and $password

		$params = array($_POST['username'],$_POST['password']);

		//$username=$_POST['username'];
		//$password=$_POST['password'];


		//Check username and password from database
		$sql="SELECT userID FROM users WHERE username=? and password=?";
		$result=mysqli_query($db,$sql,$params);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC) ;

		//If username and password exist in our database then create a session.
		//Otherwise echo error.

		if(mysqli_num_rows($result) == 1)
		{
			$_SESSION['username'] = $username; // Initializing Session
			header("location: photos.php"); // Redirecting To Other Page
		}else
		{
			$error = "Incorrect username or password.";
		}

	}
}
?>