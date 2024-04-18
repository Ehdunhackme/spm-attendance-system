<?php 
include 'Includes/dbcon.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SISTEM KEHADIRAN HARI SUKAN SEKOLAH</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login" style="background-image: url('img/logo/loral1.jpe00g');">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <h5 align="center">SISTEM KEHADIRAN HARI SUKAN SEKOLAH</h5>
                                    <div class="text-center">
                                        <br> <br>
                                        <h1 class="h4 text-gray-900 mb-4">Panel Log Masuk</h1>
                                    </div>
                                    <form class="user" method="Post" action="">
                                        <div class="form-group">
                                            <select required name="userType" class="form-control mb-3">
                                                <option value="">Pilih Peranan Pengguna</option>
                                                <option value="Administrator">Admin</option>
                                                <option value="ClassTeacher">Murid</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" required name="username" id="exampleInputEmail" placeholder="Masukkan Alamat Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" required class="form-control" id="exampleInputPassword" placeholder="Masukkan Kata Laluan">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <!-- <label class="custom-control-label" for="customCheck">Remember
                          Me</label> -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-block" value="Log Masuk" name="login" />
                                        </div>
                                    </form>

                                    <?php

                                        if(isset($_POST['login'])){

                                            $userType = $_POST['userType'];
                                            $username = $_POST['username'];
                                            $password = $_POST['password'];
                                            $password = md5($password);

                                            if($userType == "Administrator"){

                                                $query = "SELECT * FROM tbladmin WHERE emailAddress = '$username' AND password = '$password'";
                                                $rs = $conn->query($query);
                                                $num = $rs->num_rows;
                                                $rows = $rs->fetch_assoc();

                                                if($num > 0){

                                                    $_SESSION['userId'] = $rows['Id'];
                                                    $_SESSION['firstName'] = $rows['firstName'];
                                                    $_SESSION['lastName'] = $rows['lastName'];
                                                    $_SESSION['emailAddress'] = $rows['emailAddress'];

                                                    echo "<script type = \"text/javascript\">
                                                    window.location = (\"Admin/index.php\");
                                                    alert('Selamat Datang ke Sistem Kehadiran Hari Sukan Sekolah');
                                                    </script>";
                                                } else {
                                                    echo "<div class='alert alert-danger' role='alert'>
                                                    Nama Pengguna/Kata Laluan Tidak Sah!
                                                    </div>";
                                                }
                                            } elseif($userType == "ClassTeacher"){

                                                $query = "SELECT * FROM tblclassteacher WHERE emailAddress = '$username' AND password = '$password'";
                                                $rs = $conn->query($query);
                                                $num = $rs->num_rows;
                                                $rows = $rs->fetch_assoc();

                                                if($num > 0){

                                                    $_SESSION['userId'] = $rows['Id'];
                                                    $_SESSION['firstName'] = $rows['firstName'];
                                                    $_SESSION['lastName'] = $rows['lastName'];
                                                    $_SESSION['emailAddress'] = $rows['emailAddress'];
                                                    $_SESSION['classId'] = $rows['classId'];
                                                    $_SESSION['classArmId'] = $rows['classArmId'];

                                                    echo "<script type = \"text/javascript\">
                                                    window.location = (\"ClassTeacher/index.php\");
                                                    alert('Selamat Datang ke Sistem Kehadiran Hari Sukan Sekolah');
                                                    </script>";
                                                } else {
                                                    echo "<div class='alert alert-danger' role='alert'>
                                                    Nama Pengguna/Kata Laluan Tidak Sah!
                                                    </div>";
                                                }
                                            } else {
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Nama Pengguna/Kata Laluan Tidak Sah!
                                                </div>";
                                            }
                                        }
                                    ?>

                                    <!-- <hr>
                    <a href="index.html" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                                        <!-- Register Link -->
                                        <div class="text-center">
                                            <a class="small" href="register.php">Belum mempunyai akaun? Daftar di sini!</a>
                                        </div>
                                    </form>

                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>
</html>