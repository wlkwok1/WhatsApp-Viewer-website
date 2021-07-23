<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("wrong");
}
$admin_id= $_GET['admin_id'];
$admin_name=$_POST['admin_name'];
$phone_number=$_POST['phone_number'];
$address=$_POST['address'];
$department=$_POST['department'];
include('connect.php');//链接数据库

$q="UPDATE `admin` SET admin_name = '$admin_name', phone_number = '$phone_number', `address` = '$address', department = '$department' WHERE admin.admin_id = '$admin_id';";
$reslut=mysqli_query($con,$q);
if (!$reslut){
    echo "<script>alert('Error!');</script>";
    header("refresh:0;url=Admin_Account_modification.php?admin_id={$admin_id}");
}else{
    echo "<script>alert('update success!');</script>";
    header("refresh:0;url=home_page_admin.php?admin_id={$admin_id}");
}

mysqli_close($con);//关闭数据库
?>
