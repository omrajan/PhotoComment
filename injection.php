
</form>
<form method=”post” action=”injection.php” enctype=”multipart/form-data” >
    Username:<input type=”text” name=”Username” id=”Username”/></br>
    Password:<input type=”text” name=”Password” id=”Password”/></br>
    <input type=”submit” name=”submit” value=”Submit” />

<?php
$params = array($_POST[‘Username’], $_POST[‘Password’]);


$server = “MyServer\sqlexpress”;
$options = array(“Database”=>”ExampleDB”, “UID”=>”MyUID”, “PWD”=>”MyPWD”);
$conn = sqlsrv_connect($server, $options);
$sql = “SELECT * FROM UserTbl WHERE Username = ? and Password = ?”;
$stmt = sqlsrv_query($conn, $sql, $params);
if(sqlsrv_has_rows($stmt))
{
    echo “Welcome.”;
}
else
{
    echo “Invalid password.”;
}
?>
