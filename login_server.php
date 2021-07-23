<?PHP
header("Content-Type: text/html; charset=utf8");
if(!isset($_POST["submit"])){
    exit("wrong");
}
include('connect.php');
$name = $_POST['name'];
$passowrd = $_POST['password'];
if($_POST["submit"]=='admin'){
    $sql = "select * from admin where admin_id = '$name' and password='$passowrd'";
    $result = mysqli_query($con,$sql);
    $rows=mysqli_num_rows($result);
    if($rows){//0 false 1 true
        while($row = mysqli_fetch_assoc($result))
        {
            header("refresh:0;url=home_page_admin.php?admin_id={$row['admin_id']}");
        }
        exit;
    }else{
        echo "<script>window.location.href='login.php?wrong=';</script> ";
    }
}else {
    $sql = "select * from user where user_id  = '$name' and password='$passowrd'";
    $result = mysqli_query($con, $sql);
    $rows = mysqli_num_rows($result);
    if ($rows) {//0 false 1 true
        while ($row = mysqli_fetch_assoc($result)) {
            header("refresh:0;url=home_page_user.php?user_id={$row['user_id']}");
        }
        exit;
    } else {
        echo "<script>window.location.href='login.php?wrong=';</script> ";
    }
}
mysqli_close($con);//关闭数据库
?>
