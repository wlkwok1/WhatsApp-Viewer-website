<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("wrong");
}
$user_id= $_GET['user_id'];
$old_password=$_POST['old_password'];
$new_password=$_POST['new_password'];
$confirm_password=$_POST['confirm_password'];
include('connect.php');//链接数据库

	$sql="select * from user WHERE user.user_id = '$user_id'; ";
	$result_outside = mysqli_query($con,$sql);
	if (mysqli_num_rows($result_outside) > 0) {
        while ($row = mysqli_fetch_assoc($result_outside)) {

			if ($old_password != $row['password']) {
				echo "<script>alert('Your old password is wrong');</script>";
				header("refresh:0;url=user_change_password.php?user_id={$user_id}");
			}else if ($old_password == $new_password){
				echo "<script>alert('Old password cannot same with new password! ');</script>";
				header("refresh:0;url=user_change_password.php?user_id={$user_id}");
			}else if ($new_password != $confirm_password){
				echo "<script>alert('Confirm password is not same with new password!');</script>";
				header("refresh:0;url=user_change_password.php?user_id={$user_id}");
			}else{
				
				$q="UPDATE `user` SET password = '$confirm_password' WHERE user.user_id = '$user_id';";
				$reslut=mysqli_query($con,$q);
				if (!$reslut){
					echo "<script>alert('Error!');</script>";
					header("refresh:0;url=user_change_password.php?user_id={$user_id}");
				}else{
					echo "<script>alert('update success!');</script>";
					header("refresh:0;url=home_page_user.php?user_id={$user_id}");
				}
			}
		}
	}
mysqli_close($con);//关闭数据库
?>
