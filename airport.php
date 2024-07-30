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
    $airport_id = $_POST["airport-id"]; // corrected field name
    $airport_name = $_POST["airport-name"]; // corrected field name
    $city = $_POST["airport-city"]; // corrected field name
    $airline_id = $_POST["airline-id"]; // corrected field name
    $airline_name = $_POST["airline-name"]; // corrected field name
    $contact_no = $_POST["contact-no"]; // corrected field name

    // Prepare and execute the SQL query
    $sql = "INSERT INTO air_line_port (airport_id, airport_name, city, airline_id, airline_name, contact_no) 
            VALUES ('$airport_id', '$airport_name', '$city', '$airline_id', '$airline_name', '$contact_no')";
            
    if (mysqli_query($con, $sql)) {
        // Records inserted successfully, show alert and redirect
        echo "<script>alert('Records inserted successfully.'); window.location.href = 'detailsofAirport.php';</script>";
        exit(); // Exit after redirection
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
} else {
    // Redirect back to the form page if accessed directly
    header("Location: index.html");
    exit();
}

// Close the database connection
mysqli_close($con);
?>
