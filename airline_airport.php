<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "flight";
$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $airport_id = $_POST["airport-id"];
    $airport_name = $_POST["airport-name"];
    $city = $_POST["airport-city"];
    $airline_id = $_POST["airline-id"];
    $airline_name = $_POST["airline-name"];
    $contact_no = $_POST["contact-no"];

    // SQL to insert data into table
    $sql = "INSERT INTO airline_airport (airport_id, airport_name, city, airline_id, airline_name, contact_no)
            VALUES ('$airport_id', '$airport_name', '$city', '$airline_id', '$airline_name', '$contact_no')";

    if (mysqli_query($con, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

// Close connection
mysqli_close($con);
?>
