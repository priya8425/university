<?php
include('../../../configure.php');
session_start();
if(!isset($_SESSION['id'])) // If session is not set then redirect to Login Page
{
 header("Location:login.php"); 
}
if(isset($_GET['delsr_no'])){
  $sr_no=mysqli_real_escape_string($conn,$_GET['delsr_no']);
  $sql=mysqli_query($conn,"delete from courses where sr_no='$sr_no'");
  if($sql=1){
    header("location:general.php");
  }
}
if(isset($_POST['submit']))
    {
        $course_name= $_POST['course_name'];
        $description =mysqli_real_escape_string($conn,$_POST['description']);
        $overview = $_POST['overview'];
        $price = $_POST['price'];
        $tags = $_POST['tags'];
        $tags_string=implode(',',$_POST['tags']);
        $features = $_POST['features'];
        $lessons = $_POST['lessons'];
        $instructor = $_POST['instructor'];
        $instructor_string=implode(',',$_POST['instructor']);
        $duration = $_POST['duration'];
        $skill_level = $_POST['skill_level'];
        $language = $_POST['language'];
        $certificate = $_POST['certificate'];
        $upload_icon=$_FILES['upload_icon']['name'];
        $background_image=$_FILES['background_image']['name'];
        $extension=substr( $upload_icon,strlen( $upload_icon)-4,strlen( $upload_icon));
        $all_extension = array(".jpg","jpeg",".png","gif");
        if(!in_array($extension,$all_extension)){
          $msg="Invalid format. Only jpg / jpeg/ png /gif format allowed";
        } 
            else{
              $upload_icon=md5($upload_icon).$extension;
        $dnk=$_FILES['upload_icon']['tmp_name'];
        $loc="../../dist/img/background/".$upload_icon;
        move_uploaded_file($dnk,$loc);
            
            $background_image=md5($background_image).$extension;
            $dnk=$_FILES['background_image']['tmp_name'];
            $loc="../../dist/img/background/".$background_image;
            move_uploaded_file($dnk,$loc);
                }
        $sql= "INSERT INTO `courses`(`course_name`, `description`, `upload_icon`, `overview`, `price`, `tags`,`background_image`,`features`, `lessons`, `instructor`,`duration`, `skill_level`, `language`, `certificate`) VALUES ('$course_name',' $description','$upload_icon','$overview','$price','$tags_string','$background_image','$features','$lessons','$instructor_string','$duration','$skill_level',' $language','$certificate')";
        if (mysqli_query($conn, $sql)){
          echo "<script> alert ('New record has been added successfully !');</script>";
       }
        else {
          echo "<script> alert ('connection failed !');</script>";
       }
    }


    


if(isset($_POST['testedit1'])){
  $sr_no= $_POST['sr_no'];
  $course_name = $_POST['course_name'];
 $upload_icon=$_FILES['upload_icon']['name'];
$dnk=$_FILES['upload_icon']['tmp_name'];
$loc="../../dist/img/background/".$upload_icon;
  move_uploaded_file($dnk,$loc);
  $duration = $_POST['duration'];
  $price = $_POST['price'];
 
 
  $sql="UPDATE `courses` SET `course_name`='$course_name',`upload_icon`='$upload_icon',`duration`='$duration',`price`='$price' WHERE sr_no='$sr_no'";
  if (mysqli_query($conn, $sql)){
   
    echo "<script>alert('Successfully Updated');</script>";
 } else {
    echo "<script> alert ('connection failed !');window.location.href='general.php'</script>";
 }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Advanced form elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <?php include("sidebar.php")?>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4>Courses</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">General Form</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">

                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-sample" method="post" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputEmail1">Course Name</label>
                          <input type="text" class="form-control" value="" name="course_name">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputFile">Background Image</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="background_image"
                                id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputEmail1">Description</label>
                          <textarea class="form-control" value="" name="description"></textarea>
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputFile">Upload Icons</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="upload_icon" id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputPassword1">Over View</label>
                          <input type="text" class="form-control" name="overview" value="">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputPassword1">Price</label>
                          <input type="text" class="form-control" name="price" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6">
                        <div class="form-group col">
                          <label>Tags</label>
                          <div class="select2-purple">
                            <select class="select2" multiple="multiple" name="tags[]" data-placeholder="Select a Tag"
                              data-dropdown-css-class="select2-purple" style="width: 100%;">
                              <option>Web Design</option>
                              <option>HTML</option>
                              <option>CSS</option>
                              <option>PHP</option>
                              <option>JAVA</option>
                              <option>C++</option>
                              <option>DEVELOPMENT</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <?php

                  $sql = "SELECT * FROM `instructor`";
                  $result = mysqli_query($conn, $sql);


                  
                 ?>

                      <div class="col-12 col-sm-6">
                        <div class="form-group col">
                          <label>Instructor</label>
                          <div class="select2-purple">
                            <select class="select2" multiple="multiple" name="instructor[]"
                              data-placeholder="Select a Instructor" data-dropdown-css-class="select2-purple"
                              style="width: 100%;">
                              <?php
                              while($row = mysqli_fetch_assoc($result)){
                                ?>
                              <option value="<?php echo $row['id']?>"><?php echo $row['instructor']?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6">
                        <div class="form-group col">
                          <label for="exampleInputPassword1">Duration</label>
                          <input type="text" class="form-control" name="duration" value="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputPassword1">Skill Level</label>
                          <select class="form-control select2" style="width: 100%;" name="skill_level">
                            <option selected="selected">Beginner</option>
                            <option>Delaware</option>
                            <option>Beginner</option>
                            <option>Texas</option>
                            <option>Beginner</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputPassword1">Language</label>
                          <select class="form-control select2" style="width: 100%;" name="language">
                            <option selected="selected">English</option>
                            <option>Hindi</option>
                            <option>Marathi</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputPassword1">Certificate</label>
                          <select class="form-control select2" style="width: 100%;" name="certificate">
                            <option selected="selected">Yes</option>
                            <option>No</option>

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputPassword1">Features</label>
                          <input type="text" class="form-control" name="features" value="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group col">
                          <label for="exampleInputPassword1">Lessons</label>
                          <input type="text" class="form-control" name="lessons" value="">
                        </div>
                      </div>
                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              </div>
              <!-- Horizontal Form -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <div style="overflow-x:auto;">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Sr.No</th>
                        <th>Course Name</th>
                        <th>Icon</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php     
                        $sql=mysqli_query($conn,"select * from courses");
                        $count=1;
                        while($arr=mysqli_fetch_array($sql)){
                        ?>
                      <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo $arr['course_name'];?></td>

                        <td><img src="../../dist/img/background/<?php echo $arr['upload_icon'];?>"
                            style="height:150px; width:150px;"></td>
                        <td><?php echo $arr['duration'];?></td>

                        <td><?php echo $arr['price'];?></td>

                        <td>
                          <button type="button" class="btn btn-sm btn-primary btn-rounded btn-icon testedit btn-sm"
                            data-toggle="modal" data-id='<?php echo $arr['sr_no']; ?>' style="color: aliceblue"> <i
                              class="fas fa-pen"></i></button>

                          <a href="general.php?delsr_no=<?php echo $arr['sr_no']; ?>"><button type="button"
                              class="btn btn-danger btn-md" style="color: aliceblue"> <i
                                class="fas fa-trash"></i></button></a>
                      </tr>
                      <?php $count++; }  ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix" style="background:white">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>

                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div>



              </div>
              <!-- /.card -->


              <!-- /.card -->
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <div class="modal fade closemaual" id="dnkModal4" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" enctype="multipart/form-data">
          <div class="modal-body body5">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-close btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="testedit1">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- BS-Stepper -->
  <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <!-- dropzonejs -->
  <script src="../../plugins/dropzone/min/dropzone.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
      })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date picker
      $('#reservationdate').datetimepicker({
        format: 'L'
      });

      //Date and time picker
      $('#reservationdatetime').datetimepicker({
        icons: {
          time: 'far fa-clock'
        }
      });

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
              'month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function (event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      })

      $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })

    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      url: "/target-url", // Set the url
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false, // Make sure the files aren't queued until manually added
      previewsContainer: "#previews", // Define the container to display the previews
      clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function (file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function () {
        myDropzone.enqueueFile(file)
      }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function (file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1"
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function (progress) {
      document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function () {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function () {
      myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End

  </script>

  <script>
    $(document).ready(function () {
      $('.testedit').click(function () {
        let dnk3 = $(this).data('id');

        $.ajax({
          url: 'generalmodal.php',
          type: 'post',
          data: {
            dnk3: dnk3
          },
          success: function (response5) {
            $('.body5').html(response5);
            $('#dnkModal4').modal('show');
          }
        });
      });


    });

  </script>
</body>

</html>
