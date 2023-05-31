<?php 
$con=new mysqli('','root','','Zhongguoсha'); //server,login,pass,name_bd
// $con=mysqli_connect(...)
if(!$con){
    die(mysqli_error($con));
}
?>