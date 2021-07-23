<?PHP

if(isset($_POST["submit"])){
    if(!isset($_GET["admin_id"])){
        echo 'wrong';
    }
    $admin_id = $_GET['admin_id'];
    $submit = $_POST['submit'];
    $Description = $_GET['Description'];
    $someArray = json_decode($submit, true);
    $chatroom = $someArray[0]["chatroom"];
    include('connect.php');
    $department ='null';
    $sql = "select * from admin where admin_id = '$admin_id'";
    $result = mysqli_query($con,$sql);//执行sql
    $rows=mysqli_num_rows($result);//返回一个数值
    while($row = mysqli_fetch_assoc($result))
    {
        $department=$row['department'];
    }
    $sql = "select * from whatsapp_groupchat where chatroom_name='$chatroom'and Description	='null'";
    $result = mysqli_query($con,$sql);//执行sql
    $rows=mysqli_num_rows($result);//返回一个数值
    if ($rows) {
        while ($row = mysqli_fetch_assoc($result)) {
            $groupchat_id = $row['groupchat_id'];
            $q="UPDATE `whatsapp_groupchat` SET Description = '$Description' WHERE whatsapp_groupchat.groupchat_id = '$groupchat_id';";
            $reslut_ = mysqli_query($con, $q);
            if (!$reslut_) {
                echo("Error description: " . mysqli_error($reslut_));
            }
        }
    }
    $sql = "select * from whatsapp_groupchat where chatroom_name = '$chatroom'";
    $result = mysqli_query($con,$sql);//执行sql
    $rows=mysqli_num_rows($result);//返回一个数值
    $groupchat_id = 'null';
    while($row = mysqli_fetch_assoc($result))
    {
        $groupchat_id=$row['groupchat_id'];
    }
    for ( $i=0 ; $i<count($someArray) ; $i++ ) {
        $sql = "select * from whatsapp_message_data where groupchat_id = '$groupchat_id' and sender='{$someArray[$i]["sender"]}' and date='{$someArray[$i]["date"]}' and time='{$someArray[$i]["time"]}' and message='{$someArray[$i]["message"]}'";
        $result = mysqli_query($con, $sql);//执行sql
        $rows = mysqli_num_rows($result);//返回一个数值
        if (!$rows) {//0 false 1 true
            $q="insert into whatsapp_message_data(groupchat_id,sender,date,time,message,file ) values ('$groupchat_id','{$someArray[$i]["sender"]}','{$someArray[$i]["date"]}','{$someArray[$i]["time"]}','{$someArray[$i]["message"]}','{$someArray[$i]["HaveFile"]}')";
            $reslut=mysqli_query($con,$q);
            if (!$reslut){
                echo("Error description: " . mysqli_error($reslut));
            }
        }
    }

    echo "<script>alert('upload success!');</script>";
    header("refresh:0;url=home_page_admin.php?admin_id={$admin_id}");
}?>