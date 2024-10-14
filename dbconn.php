<?php
define ('hostname','localhost');
define ('username','root');
define ('password','');
define ('database','curd');

$conn=mysqli_connect(hostname,username,password,database);

if(!$conn)
{
    die("Connection failed".mysqli_error());
}
else
{
    echo "Connected";
}

?>

