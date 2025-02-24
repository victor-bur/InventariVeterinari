<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "inventariveterinari";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass $dbname);
if (!$conn)
{
    die("No hi ha connexió: ".mysqli_connect_error());
}

$username = $_POST['username'];
$contrasenya = $_POST['contrasenya'];

$query = mysqli_query($conn,"SELECT * FROM login where username = '".$username."' and password )
?>