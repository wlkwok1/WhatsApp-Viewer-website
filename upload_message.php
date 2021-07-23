<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Upload Message</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
            </div>
            <div class="sidebar-brand-text mx-3"> Admin </div>
        </a>
        <form method="post">
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="home_page_admin.php?admin_id=<?php echo $_GET["admin_id"]?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Chatroom</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="upload_message.php?admin_id=<?php echo $_GET["admin_id"]?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Upload Message</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php?admin_id=<?php echo $_GET["admin_id"]?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Create Account</span></a>
            </li>

        </form>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="search_admin.php" method="post">
                    <div class="input-group">
                        <input id="data" name="data" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div id="table" class="input-group-append">
                            <select type="submit"  id="table" name="table"  class="btn btn-primary">
                                <option value="sender" >sender</option>
                                <option value="date" >date</option>
                                <option value="time" >time</option>
                                <option value="message" >message</option>
                            </select>
                            <input type="hidden" name="admin_id" value="<?php echo $_GET["admin_id"]?>">
                            <input class="btn btn-primary" type="submit" name="search" value="search">
                        </div>
                    </div>
                </form>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_GET["admin_id"]?></span>
                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                        </a>
                        <!-- Dropdown - User Information -->
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="admin_profile.php?admin_id=<?php echo $_GET["admin_id"]?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="change_password.php?admin_id=<?php echo $_GET["admin_id"]?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                    </li>
            </nav>
        <!-- End of Topbar -->
          <!-- Begin Page Content -->
              <div class="container-fluid">

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800">Upload Data</h1>
                  <p class="mb-4">User can Upload WhatsApp Chat Data Here</p>
                  <!-- Topbar Search -->

                  <!-- Topbar Search -->
                  <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post" action="unzip.php?admin_id=<?php echo $_GET['admin_id']?>" enctype="multipart/form-data">
                      <div class="input-group">
						  <div class="input-group-append">
                             <input class="btn btn-primary" type="file" name="zip_file" /> 
                          </div>
                          <input type="text" id="chatroom_name" name="chatroom_name" class="form-control bg-light border-0 small" placeholder="chatroom name" aria-label="Search" aria-describedby="basic-addon2" required>
                          <div class="input-group-append">
                              <button type="submit" name="btn_zip" class="btn btn-info" value="Upload">
                                  <i class="fas fa-fw fa-folder"></i>
                              </button>
                          </div>
                      </div>
                  </form>
                  <br>
                  <br>
                  <div class="card shadow mb-4">
                      <div class="card-header py-3">
					<?php  
                          if(isset($_POST["submit"])) {
                              $submit = $_POST['submit'];
                              $someArray = json_decode($submit, true);
                              $chatroom = $someArray[0]["chatroom"];
                              include('connect.php');
                              $sql = "select * from whatsapp_groupchat where chatroom_name='$chatroom' and Description='null'";
                              $result = mysqli_query($con, $sql);//执行sql
                              $rows = mysqli_num_rows($result);//返回一个数值
                              echo '<h6 class="m-0 font-weight-bold text-primary">';
                              if ($rows) {//0 false 1 true
                                  echo 'New ';
                              }
                              echo 'chatroom : ';
                              echo $chatroom;
                              echo '</h6><br>';
                              if ($rows) {//0 false 1 true
                                  echo '<input type="text"  name="Description" id="Description" class="form-control bg-light border-0 small" placeholder="Description" aria-label="Search" aria-describedby="basic-addon2">';
                              }
                          }?>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                  <tr>
									  <th hidden>id</th>
                                      <th>date</th>
                                      <th>sender</th>
                                      <th>message</th>
                                  </tr>
                                  </thead>        
                                  <tbody>
                                  <?PHP  if(isset($_POST["submit"])){
                                      if(!isset($_GET["admin_id"])){
                                          echo 'wrong';
                                      }
                                      $admin_id = $_GET['admin_id'];
                                      $submit = $_POST['submit'];
                                      $someArray = json_decode($submit, true);
                                      $chatroom = $someArray[0]["chatroom"];
                                      include('connect.php');
                                      for ( $i=0 ; $i<count($someArray) ; $i++ ) {
                                          echo '<tr>';
										  echo '<td hidden>';echo $i+1;echo '</td>';
                                          echo '<td>';echo $someArray[$i]["date"];echo ' ';echo $someArray[$i]["time"];echo '</td>';
                                          echo '<td>';echo $someArray[$i]["sender"];echo '</td>';
                                          echo '<td>';echo $someArray[$i]["message"];
                                          if($someArray[$i]["HaveFile"]!='NO'){
                                              if(strpos($someArray[$i]["HaveFile"],".jpg")>0){
                                                  echo '<img src="/server/upload/',$_GET["roomID"],'/',$someArray[$i]["HaveFile"],'">';
                                              }
                                              echo  '<p><a href="/server/upload/',$_GET["roomID"],'/',$someArray[$i]["HaveFile"],'" download="',$someArray[$i]["HaveFile"],'">download</a>';
                                          }
                                          echo '</td>';
                                          echo '</tr>';
                                      }

                                  }?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <tr>
                          <?PHP
                          if(isset($_POST["submit"])) {
                              echo '<center><button id="deploy_button" onclick="Upload_message()" >Upload</button></center>';
                          }?>
                          <br>
                  </div>
              </div>
              <!-- /.container-fluid -->
        <!-- End of Main Content -->
      <!-- Footer -->
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script>
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

      function Upload_message() {
          var currentUrl = window.location.href;
          let params = (new URL(currentUrl)).searchParams;
          var hash_Text=params.get('admin_id')
          var Description = $("#Description").val();
          var form_post_Data = <?php echo json_encode($_POST['submit'] ?? null) ?>;
          console.log(Description);
          console.log(form_post_Data);
          post_to_url("upload_message_data.php?admin_id="+hash_Text+"&Description="+Description,{ submit:  form_post_Data} );
      }
  </script>
</body>

</html>
