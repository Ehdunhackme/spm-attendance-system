<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "attendancesystem01";
	
	$conn = new mysqli($host, $user, $pass, $db);
	if($conn->connect_error){
		echo "Seems like you have not configured the database. Failed To Connect to database:" . $conn->connect_error;
	}
?>

<?php
// Database connection details
$host = 'localhost'; // or your database host
$username = 'root'; // database username
$password = ''; // database password
$database = 'attendancesystem01'; // your database name

function OpenCon() {
    global $host, $username, $password, $database;
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function CloseCon($conn) {
    $conn->close();
}
?>