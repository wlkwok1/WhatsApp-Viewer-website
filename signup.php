<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("wrong");
}//判断是否有submit操作
$admin_id = $_GET['admin_id'];
$user_name=$_POST['user_name'];//post获取表单里的password
$password=$_POST['password'];
$phone_number=$_POST['phone_number'];
$address=$_POST['address'];
$department=$_POST['department'];
include('connect.php');//链接数据库
if($_POST["submit"]=='admin'){
    $user_id='a';
    for ( $i=0 ; $i<7 ; $i++ ) {
        $user_id = $user_id.rand(0,7) ;
     }
    $q="insert into admin(admin_id,admin_name,password,phone_number,address,department) values ('$user_id','$user_name','$password','$phone_number','$address','$department')";
    $reslut=mysqli_query($con,$q);
    if (!$reslut){
        echo "<script>alert('Error!');</script>";
        header("refresh:0;url=
        register.php?admin_id={$admin_id}");
    }else{
        echo '<script>alert(\'create account success! ID : ',$user_id,'\');</script>';
        header("refresh:0;url=home_page_admin.php?admin_id={$admin_id}");
    }
}else{
    $user_id='u';
    for ( $i=0 ; $i<7 ; $i++ ) {
        $user_id = $user_id.rand(0,7) ;
    }
    $q="insert into user(user_id,user_name,password,phone_number,address,department) values ('$user_id','$user_name','$password','$phone_number','$address','$department')";
    $reslut=mysqli_query($con,$q);
    if (!$reslut){
        echo "<script>alert('Error!');</script>";
        header("refresh:0;url=register.php?admin_id={$admin_id}");
    }else{
        echo '<script>alert(\'create account success! ID : ',$user_id,'\');</script>';
        header("refresh:0;url=home_page_admin.php?admin_id={$admin_id}");
    }
}
mysqli_close($con);//关闭数据库
?>
