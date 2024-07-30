<?php
$servername="localhost";
$username="root";
$password="";
$database="flight";
$con=mysqli_connect($servername,$username,$password,$database);
if(!$con)
{
     die("error detected".mysqli_erroe($con));
}
?>