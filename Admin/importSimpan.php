<?php
include '../Includes/dbcon.php';
include '../Includes/session.php';

// Ensure the connection to the database is established
$connection = OpenCon(); 

// Check if the 'import' POST request is set
if (isset($_POST["import"])) {
    // Verify if a file is uploaded
    if (!empty($_FILES['file']['name'])) {
        // Get the temporary file name and open the CSV file
        $filename = $_FILES["file"]["tmp_name"];
        $file = fopen($filename, "r");

        // Array to store repeated IDs
        $repeatedIDs = [];

        // Read CSV data line by line
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $ID = $getData[0];
            $firstName = $getData[1];
            $lastName = $getData[2];
            $emailAddress = $getData[3];
            $password = $getData[4];
            $phoneNo = $getData[5];
            $classId = $getData[6];
            $classArmId = $getData[7];
            $dateCreated = $getData[8];

            // Check if the ID already exists in the database
            $checkQuery = "SELECT * FROM tblclassteacher WHERE Id = '$ID'";
            $checkResult = mysqli_query($connection, $checkQuery);
            if (mysqli_num_rows($checkResult) > 0) {
                // If ID exists, add it to the repeatedIDs array
                $repeatedIDs[] = $ID;
            } else {
                // Insert a new record into the database
                $query = "INSERT INTO tblclassteacher (Id, firstName, lastName, emailAddress, password, phoneNo, classId, classArmId, dateCreated) 
                          VALUES ('$ID', '$firstName', '$lastName', '$emailAddress', '$password', '$phoneNo', '$classId', '$classArmId', '$dateCreated')";
                $result = mysqli_query($connection, $query);
                if (!$result) { // If insertion fails
                    echo "<script>alert('Upload Failed: " . mysqli_error($connection) . "');
                          window.location='importAhli.php'</script>";
                    exit; 
                }
            }
        }

        fclose($file); // Close the CSV file

        if (!empty($repeatedIDs)) {
            $repeatedIDsString = implode(', ', $repeatedIDs);
            echo "<script>alert('Repeated Data Found: $repeatedIDsString');
                  window.location='importAhli.php'</script>";
            exit;
        }

        // Redirect after successful CSV upload
        echo "<script>alert('Upload Successful!');
              window.location='index.php'</script>";
    } else {
        // If no file is uploaded
        echo "<script>alert('Upload Failed! No File Uploaded.');
              window.location='importAhli.php'</script>";
    }
}

// Ensure the connection is closed
CloseCon($connection);
?>