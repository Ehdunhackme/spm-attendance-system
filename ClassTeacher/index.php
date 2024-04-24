<?php 
require_once '../Includes/dbcon.php';
require_once '../Includes/session.php';

// Set timezone to GMT+8
date_default_timezone_set('Asia/Kuala_Lumpur');

// Get current time in GMT+8 timezone
$current_time = date('H:i');

$query = "SELECT tblclassteacher.firstName, tblclassteacher.lastName
FROM tblclassteacher
INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId
WHERE tblclassteacher.Id = '".$_SESSION['userId']."'";

$rs = $conn->query($query);
$num = $rs->num_rows;

// Get full name
$fullName = "";
if ($num > 0) {
    $row = $rs->fetch_assoc();
    $fullName = $row['firstName'] . " " . $row['lastName'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.png" rel="icon">
  <title>Murid-Sistem Kehadiran Hari Sukan Sekolah</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php include "Includes/topbar.php";?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laman Utama Akaun Murid</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Laman Utama</a></li>
              <li class="breadcrumb-item active" aria-current="page">Menu</li>
            </ol>
          </div>
          <span class="text-black big" style="font-size: 24px;"><b>Selamat Datang <?php echo $fullName;?></b></span><br>
          <span class="text-black big" style="font-size: 24px;">Masa Sekarang: <?php echo $current_time;?> (GMT+8)</span>
          <div class="row mb-3">
             <div class="col-lg-3 col-md-6 mb-4 mt-4">
            <a class="btn btn-primary btn-block" href="takeAttendance.php">Mengambil Kehadiran</a>
          </div>
        </div>
        <!---Container Fluid-->
      </div>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>
