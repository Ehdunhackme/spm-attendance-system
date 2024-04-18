<?php
// Include necessary files and establish database connection
include '../Includes/dbcon.php';
include '../Includes/session.php';

// Check if a file is uploaded
if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get the uploaded file
    $file = $_FILES['file']['tmp_name'];

    // Load PHPExcel library (assuming you have it installed)
    require_once 'PHPExcel/PHPExcel.php';

    // Create a new PHPExcel object
    $objPHPExcel = PHPExcel_IOFactory::load($file);

    // Get the active sheet
    $sheet = $objPHPExcel->getActiveSheet();

    // Start from the second row (assuming the first row contains headers)
    $startRow = 2;

    // Loop through each row of the sheet
    for($i = $startRow; $i <= $sheet->getHighestRow(); $i++) {
        // Get row data
        $rowData = $sheet->rangeToArray('A' . $i . ':K' . $i, NULL, TRUE, FALSE)[0];

        // Insert row data into the database
        $firstName = $rowData[1];
        $lastName = $rowData[2];
        $otherName = $rowData[3];
        $admissionNumber = $rowData[4];
        $className = $rowData[5];
        $classArmName = $rowData[6];
        $sessionName = $rowData[7];
        $termName = $rowData[8];
        $status = ($rowData[9] == "Present") ? 1 : 0;
        $dateTimeTaken = $rowData[10];

        // Perform your database insertion here
        // Example query:
        $query = "INSERT INTO tblattendance (status, dateTimeTaken, classId, classArmId, sessionTermId, admissionNo)
                  VALUES ('$status', '$dateTimeTaken', 
                          (SELECT Id FROM tblclass WHERE className = '$className'), 
                          (SELECT Id FROM tblclassarms WHERE classArmName = '$classArmName'), 
                          (SELECT Id FROM tblsessionterm WHERE sessionName = '$sessionName' AND termId = (SELECT Id FROM tblterm WHERE termName = '$termName')), 
                          '$admissionNumber')";
        mysqli_query($conn, $query);
    }

    // Redirect or display a success message
    echo "Data imported successfully!";
} else {
    // Handle file upload errors
    echo "File upload failed.";
}
?>