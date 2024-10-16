<?php
define ('hostname','localhost');
define ('username','root');
define ('password','');
define ('database','crudo');

$conn=mysqli_connect(hostname,username,password,database);

if(!$conn)
{
    die("Connection failed".mysqli_error());
}


?>

