<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_GET['admin_id'])){
    exit("wrong");
}//判断是否有submit操作
$admin_id = $_GET['admin_id'];
$user_id=$_GET['user_id'];//post获取表单里的name
$groupchat_id=$_GET['groupchat_id'];//post获取表单里的password
include('connect.php');//链接数据库
$q="DELETE FROM permission where groupchat_id = '$groupchat_id' and user_id ='$user_id'";
$reslut=mysqli_query($con,$q);
if (!$reslut){
    echo "<script>alert('Error!');</script>";
    header("refresh:0;url=home_admin.php?admin_id={$admin_id}");
}else{
    echo "<script>alert('DELETE permission success!');</script>";
    header("refresh:0;url=permission.php?groupchat_id={$groupchat_id}&admin_id={$admin_id}");
}
mysqli_close($con);//关闭数据库
?>
