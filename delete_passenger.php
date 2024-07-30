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

// Check if the passenger ID is provided in the URL for deletion
if(isset($_GET['id'])) {
    $passenger_id = $_GET['id'];

    // Query to delete passenger by ID
    $delete_sql = "DELETE FROM passenger WHERE id = $passenger_id";
    if (mysqli_query($con, $delete_sql)) {
        // Redirect to the page where you want to display the updated passenger information
        header("Location: details.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
