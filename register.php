<?php
include 'Includes/dbcon.php';
session_start();

$statusMsg = ""; // Status message for registration feedback

if (isset($_POST['register'])) {
    // Retrieve form data
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $emailAddress = $_POST['emailAddress'] ?? '';
    $phoneNo = $_POST['phoneNo'] ?? '';
    
    // Assign the default password and hash it
    $sampPass = "pass123";
    $sampPass_2 = md5($sampPass); // Default password for all new users

    // Prepare the INSERT statement including the hashed password
    $stmt = $conn->prepare("INSERT INTO tblclassteacher (firstName, lastName, emailAddress, phoneNo, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $emailAddress, $phoneNo, $sampPass_2);

    if ($stmt->execute()) {
        // Display a success message and redirect to the index page
        echo "<script>alert('Pendaftaran berjaya! Anda akan diarahkan ke laman utama.'); window.location.href='index.php';</script>";
    } else {
        // Display error message if the registration fails
        $statusMsg = "<div class='alert alert-danger text-center'>Pendaftaran gagal: " . $stmt->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akaun Murid</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .card {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        .card-title {
            text-align: center;
        }
        .alert {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pendaftaran Akaun Murid</h5>
                        <?php echo $statusMsg; ?>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" required name="firstName" placeholder="Nama Pertama">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" required name="lastName" placeholder="Nama Terakhir">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" required name="emailAddress" placeholder="Alamat Emel">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" required name="phoneNo" placeholder="Nombor Telefon">
                            </div>
                            <div class="form-group">
                                <select required name="classId" class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    <?php
                                        // Fetch classes from tblclass
                                        $qry = "SELECT * FROM tblclass ORDER BY className ASC";
                                        $result = $conn->query($qry);
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['Id'] . '">' . $row['className'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group text-center"> <!-- Align the button to the center -->
                                <input type="submit" class="btn btn-primary" name="register" value="Daftar" style="width: 100%;"> <!-- Set the button to the same width as the input fields -->
                            </div>
                            <div class="form-group text-center">
                                <small class="text-muted">Nota: Kata laluan lalai untuk akaun murid ialah "pass123"</small>
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