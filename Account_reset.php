<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("wrong");
}
$user_id= $_GET['user_id'];
$user_name=$_POST['user_name'];
$phone_number=$_POST['phone_number'];
$address=$_POST['address'];
$department=$_POST['department'];
include('connect.php');//链接数据库

$q="UPDATE `user` SET user_name = '$user_name', phone_number = '$phone_number', `address` = '$address', department = '$department' WHERE user.user_id = '$user_id';";
$reslut=mysqli_query($con,$q);
if (!$reslut){
    echo "<script>alert('Error!');</script>";
    header("refresh:0;url=Account_modification.php?user_id={$user_id}");
}else{
    echo "<script>alert('update success!');</script>";
    header("refresh:0;url=home_page_user.php?user_id={$user_id}");
}

mysqli_close($con);//关闭数据库
?>
