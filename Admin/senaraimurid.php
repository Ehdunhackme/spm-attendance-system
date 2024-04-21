<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';

// Updated query without class arms
$query = "SELECT tblclassteacher.Id, tblclassteacher.firstName, tblclassteacher.lastName,
          tblclassteacher.emailAddress, tblclassteacher.phoneNo, tblclass.className, 
          tblclassteacher.dateCreated
          FROM tblclassteacher
          INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId";

$rs = $conn->query($query);
$num = $rs->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="img/logo/attnlg.png" rel="icon">
  <title>Admin - Student Attendance System</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "Includes/sidebar.php"; ?>
    <!-- Content -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php include "Includes/topbar.php"; ?>
        <!-- Container Fluid -->
        <div class="container-fluid" id="container-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Student List</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Phone No</th>
                        <th>Class</th>
                        <th>Date Created</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      if ($num > 0) {
                        $sn = 0;
                        while ($rows = $rs->fetch_assoc()) {
                          $sn++;
                          echo "<tr>
                                  <td>$sn</td>
                                  <td>{$rows['firstName']}</td>
                                  <td>{$rows['lastName']}</td>
                                  <td>{$rows['emailAddress']}</td>
                                  <td>{$rows['phoneNo']}</td>
                                  <td>{$rows['className']}</td>
                                  <td>{$rows['dateCreated']}</td>
                                  <td><a href='?action=delete&Id={$rows['Id']}'><i class='fas fa-trash'></i></a></td>
                               </tr>";
                        }
                      } else {
                        echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Scripts -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
</body>

</html>