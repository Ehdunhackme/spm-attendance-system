<?php 
include 'Includes/dbcon.php';
session_start();

if(isset($_POST['register'])) {
    $firstName = '';
    $lastName = '';
    $emailAddress = '';
    $password = '';
    $password = md5($password); // Consider using password_hash() for better security in a real application

    // Only creating accounts for Murid, removed userType check
    $stmt = $conn->prepare("INSERT INTO tblclassteacher (firstName, lastName, emailAddress, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $emailAddress, $password);

    if($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Registration failed: " . $stmt->error . "'); window.location.href='register.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEM KEHADIRAN HARI SUKAN SEKOLAH
        Register</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .card-title {
            text-align: center;
        }
        .btn-primary {
            display: block;
            margin: 20px auto;
        }
    </style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Register</h5>
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <select required name="userType" class="form-control mb-3">
                                    <option value="">Select User Role</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="ClassTeacher">Class Teacher</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" required name="firstName" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" required name="lastName" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" required name="emailAddress" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" required name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="register" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>