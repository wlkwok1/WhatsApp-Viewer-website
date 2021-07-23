<?php
$admin_id = $_GET['admin_id'];
{
    $submit = $_POST['chatroom_name'];
    include('connect.php');
    $roomid = '';
    $department= '';
    $sql = "select * from admin where admin_id='$admin_id'";
    $result = mysqli_query($con, $sql);//执行sql
    $rows = mysqli_num_rows($result);//返回一个数值
    while ($row = mysqli_fetch_assoc($result)) {
        $department = $row['department'];
    }
    $sql = "select * from whatsapp_groupchat where chatroom_name='$submit'";
    $result = mysqli_query($con, $sql);//执行sql
    $rows = mysqli_num_rows($result);//返回一个数值
    if (!$rows) {//0 false 1 true
        $q = "insert into whatsapp_groupchat(chatroom_name,Description,department,admin_id ) values ('$submit','null','$department','$admin_id')";
        $reslut_ = mysqli_query($con, $q);
        $sql = "select * from whatsapp_groupchat where chatroom_name='$submit'";
        $result = mysqli_query($con, $sql);//执行sql
        $rows = mysqli_num_rows($result);//返回一个数值
        while ($row = mysqli_fetch_assoc($result)) {
            $roomid = $row['groupchat_id'];
        }
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $roomid = $row['groupchat_id'];
        }
    }
    if (!file_exists("upload/{$roomid}")) {
        mkdir("upload/{$roomid}", 0700);
    }
    $output = '';
    if ($_FILES['zip_file']['name'] != '') {
        $file_name = $_FILES['zip_file']['name'];
        $array = explode(".", $file_name);
        $name = $array[0];
        $ext = $array[1];
        if ($ext == 'zip') {
            $path = "upload/{$roomid}";
            $location = $path . $file_name;
            if (move_uploaded_file($_FILES['zip_file']['tmp_name'], $location)) {
                $zip = new ZipArchive;
                if ($zip->open($location)) {
                    $zip->extractTo($path);
                    $zip->close();
                }
            }
            //header("refresh:0;url=upload_message.php?admin_id={$admin_id}");
        }
    }
    $dir = "upload/{$roomid}/";
    $a = scandir($dir);
    $f = "upload/{$roomid}/_chat.txt";
    foreach ($a as $value) {
        if(strpos($value,"WhatsApp")>=0&&strpos($value,".txt")>=0){
            $f="upload/{$roomid}/{$value}";
        }
    }
    $homepage = file_get_contents($f);
    echo '<td> <textarea hidden name="mytext" id="textarea"  class="form-control" rows="6" cols="40" readonly="readonly">';
    echo $homepage;
    echo '</textarea></td>';
    unlink($f);
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var textArray=[]
    var dateArray=[]
    var senderArray=[]
    var messageArray=[]
    var textArray2=[]
    var input;
    var reader;
    var file=[<?php echo '"'.implode('","', $a).'"' ?>];
    //url.searchParams.get('username');
    var text= document.getElementById("textarea").value;
    if(text.indexOf('‪')===-1||text.indexOf('‬')===-1||text.indexOf(' ')===-1){
        console.log("Android");
        generateAndroid();
    }else {
        console.log("IOS");
        generateIOS();
    }
    function generateIOS() {
        var text= document.getElementById("textarea").value;
        console.log(text);
        textArray = text.split("\n");
        console.log("text");
        //console.log(text);
        //console.log(textArray);
        for (i = 0; i < textArray.length; i++) {
            if (textArray[i].indexOf('/') === 2 &&
                textArray[i].substr(textArray[i].indexOf('/') + 1).indexOf('/') <= 3) {
                textArray2.push(textArray[i])
            } else if (
                textArray[i].indexOf('/') === 3 &&
                textArray[i].substr(textArray[i].indexOf('/') + 1).indexOf('/') <= 3) {
                textArray2.push(textArray[i])
            } else if (
                textArray[i].indexOf('/') === 4 &&
                textArray[i].substr(textArray[i].indexOf('/') + 1).indexOf('/') <= 3) {
                textArray2.push(textArray[i])
            } else {
                textArray2[textArray2.length - 1] = textArray2[textArray2.length - 1] + "\n" + textArray[i];
            }
        }
        //console.log(textArray2);
        for (j = 0; j < textArray2.length; j++) {
            parseLineIOS(textArray2[j]);
        }
        var arr = new Array();
        var FileArray= new Array();
        for (a = 0; a < dateArray.length; a++) {
            var search="NO";
            for (z = 2; z < file.length; z++) {
                if(messageArray[a].indexOf(file[z])!==-1){
                    console.log(file[z]);
                    console.log(messageArray[a].indexOf(file[z]));
                    search=file[z];
                }
            }
            console.log(search);
            FileArray.push(search);
        }
        console.log(dateArray.length);
        console.log(FileArray.length);
        for (a = 0; a < dateArray.length; a++) {
            var obj = new Object;
            var date_time_data = dateArray[a].replace('/', '-');
            date_time_data = date_time_data.replace('/', '-');
            var date_time_Array = date_time_data.split(" ");
            obj.chatroom = "<?php echo $_POST['chatroom_name'] ?>";
            obj.date = date_time_Array[0];
            obj.time = date_time_Array[1];
            obj.sender = senderArray[a];
            obj.message = messageArray[a];
            obj.HaveFile = FileArray[a];
            arr = arr.concat(obj);
        }
        console.log(JSON.stringify(arr));
        var currentUrl = window.location.href;
        let params = (new URL(currentUrl)).searchParams;
        var hash_Text = params.get('admin_id')
        post_to_url("upload_message.php?admin_id="+ hash_Text+"&roomID=<?php echo $roomid ?>", {submit: JSON.stringify(arr)});
        console.log(dateArray);
        console.log(senderArray);
        console.log(messageArray);
    }
    function parseLineIOS(line) {
        if(!line || !line.length) {
            return;
        }
        var date = line.substring(line.indexOf('[')+1,line.indexOf(']'));
        var sender, message;
        if (line.indexOf('‬:') === -1) {
            return;
        }
        else {
            sender = line.substring(line.indexOf('‪')+1, line.indexOf('‬'));
            message = line.substr(line.indexOf('‬')+2);
        }
        var sender_data = sender.replace(' ', ' ');
        sender_data = sender_data.replace(' ', ' ');
        dateArray.push(date)
        senderArray.push(sender_data)
        messageArray.push(message)
    }
    function generateAndroid() {
        var text= document.getElementById("textarea").value;
        console.log(text);
        textArray = text.split("\n");
        console.log("text");
        //console.log(text);
        //console.log(textArray);
        for(i=0;i<textArray.length;i++){
            if(textArray[i].indexOf('/') === 2||textArray[i].indexOf('/') === 1 &&
                textArray[i].substr(textArray[i].indexOf('/')+1).indexOf('/')=== 2||textArray[i].substr(textArray[i].indexOf('/')+1).indexOf('/')=== 1){
                textArray2.push(textArray[i])
            }else{
                textArray2[textArray2.length-1]=textArray2[textArray2.length-1]+"\n"+textArray[i];
            }
        }
        //console.log(textArray2);
        for(j=0;j<textArray2.length;j++){
            parseLineAndroid(textArray2[j]);
        }
        var arr = new Array();
        var FileArray= new Array();
        for (a = 0; a < dateArray.length; a++) {
            var search="NO";
            for (z = 2; z < file.length; z++) {
                if(messageArray[a].indexOf(file[z])!==-1){
                    console.log(file[z]);
                    console.log(messageArray[a].indexOf(file[z]));
                    search=file[z];
                }
            }
            console.log(search);
            FileArray.push(search);
        }
        var arr = new Array();
        for(a=0;a<dateArray.length;a++){
            var obj = new Object;
            var date_time_data = dateArray[a].replace('/', '-');
            date_time_data = date_time_data.replace('/', '-');
            var date_time_Array =date_time_data.split(" ");
            obj.chatroom = "<?php echo $_POST['chatroom_name'] ?>";
            obj.date = date_time_Array[0];
            obj.time = date_time_Array[1]+":00";
            obj.sender = senderArray[a];
            obj.message = messageArray[a];
            obj.HaveFile = FileArray[a];
            arr = arr.concat(obj);
        }
        console.log(JSON.stringify(arr));
        var currentUrl = window.location.href;
        let params = (new URL(currentUrl)).searchParams;
        var hash_Text=params.get('admin_id')
        post_to_url("upload_message.php?admin_id="+ hash_Text+"&roomID=<?php echo $roomid ?>", {submit: JSON.stringify(arr)});

        console.log(dateArray);
        console.log(senderArray);
        console.log(messageArray);
    }
    function parseLineAndroid(line) {
        if(!line || !line.length) {
            return;
        }
        var date = line.substr(0,line.indexOf(' -'));
        var sender, message;
        if (line.indexOf(': ') === -1) {
            sender = 'system';
            message = line.substr(line.indexOf('- ')+2);
        }
        else {
            sender = line.substr(line.indexOf('- ')+2, line.indexOf(': ')-line.indexOf('- ')-2);
            message = line.substr(line.indexOf(': ')+2);
        }
        dateArray.push(date)
        senderArray.push(sender)
        messageArray.push(message)
    }
    function post_to_url(path, params, method) {
        method = method || "post";
        var form = document.createElement("form");
        form._submit_function_ = form.submit;
        form.setAttribute("method", method);
        form.setAttribute("action", path);
        for(var key in params) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
        }
        document.body.appendChild(form);
        form._submit_function_();
    }
</script>
