<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "flight";
$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch passenger information
$sql = "SELECT * FROM passenger";
$result = mysqli_query($con, $sql);

// Check if there are any passengers
$passengerData = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $passengerData[] = $row;
    }
}

// Close the connection
mysqli_close($con);
?>
