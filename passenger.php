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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through each submitted form field
    foreach ($_POST as $key => $value) {
        // Check if the field name starts with the prefix "firstName"
        if (strpos($key, 'firstName') === 0) {
            // Extract the passenger number from the field name
            $passengerNumber = substr($key, strlen('firstName'));

            // Retrieve other corresponding form fields based on the passenger number
            $firstName = $_POST["firstName$passengerNumber"];
            $lastName = $_POST["lastName$passengerNumber"];
            $age = $_POST["age$passengerNumber"];
            $gender = $_POST["gender$passengerNumber"];
            $email = $_POST["email$passengerNumber"];
            $mobile = $_POST["mobile$passengerNumber"];
            $address = $_POST["address$passengerNumber"];
            $city = $_POST["city$passengerNumber"];
            $state = $_POST["state$passengerNumber"];
            $pincode = $_POST["pincode$passengerNumber"];
            $country = $_POST["country$passengerNumber"];

            // Insert data into your database table
            // Modify the query according to your table structure
            $sql = "INSERT INTO passenger (firstName, lastName, age, gender, email, mobile, address, city, state, pincode, country) 
                    VALUES ('$firstName', '$lastName', '$age', '$gender', '$email', '$mobile', '$address', '$city', '$state', '$pincode', '$country')";

             // Execute the query
            if (mysqli_query($con, $sql)) {
                // Records inserted successfully, show alert and redirect
                echo "<script>alert('Records inserted successfully.'); window.location.href = 'details.php';</script>";
                exit(); // Exit after redirection
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
    }
} else {
    // Redirect back to the form page if accessed directly
    header("Location: index.html");
    exit();
}
?>
