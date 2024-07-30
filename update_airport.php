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

$airport_id = ""; // Initialize airport ID variable

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get airport ID from the form input
    $airport_id = mysqli_real_escape_string($con, $_POST['airport_id']);

    // Query to fetch airport details by ID from the air_line_port table
    $sql = "SELECT * FROM air_line_port WHERE airport_id = $airport_id";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        // Fetch airport details
        $air_line_port = mysqli_fetch_assoc($result);

        // Sanitize form data
        $airport_name = mysqli_real_escape_string($con, $_POST['airport_name']);
        $city = mysqli_real_escape_string($con, $_POST['airport_city']);
        $airline_id = mysqli_real_escape_string($con, $_POST['airline_id']);
        $airline_name = mysqli_real_escape_string($con, $_POST['airline_name']);
        $contact_no = mysqli_real_escape_string($con, $_POST['contact_no']);
        // Add more fields as needed

        // Update airport details in the database
        $update_sql = "UPDATE air_line_port SET 
                        airport_name='$airport_name', 
                        city='$city', 
                        airline_id='$airline_id', 
                        airline_name='$airline_name', 
                        contact_no='$contact_no' 
                        WHERE airport_id = $airport_id";
        if (mysqli_query($con, $update_sql)) {
            echo "Airport details updated successfully!";
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    } else {
        echo "No airport found with ID: " . $airport_id;
    }

    // Close the result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Airline Port Details</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a separate CSS file for styling -->
</head>
<body>
    <div class="container">
        <h2>Update Airline Port Details</h2>
        <form method="post">
            <div class="form-group">
                <label for="airport_id">Airport ID:</label>
                <input type="text" id="airport_id" name="airport_id" value="<?php echo $airport_id; ?>" required>
            </div>
            <div class="form-group">
                <label for="airport_name">Airport Name:</label>
                <input type="text" id="airport_name" name="airport_name" value="<?php echo isset($air_line_port) ? $air_line_port['airport_name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="airport_city">City:</label>
                <input type="text" id="airport_city" name="airport_city" value="<?php echo isset($air_line_port) ? $air_line_port['city'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="airline_id">Airline ID:</label>
                <input type="text" id="airline_id" name="airline_id" value="<?php echo isset($air_line_port) ? $air_line_port['airline_id'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="airline_name">Airline Name:</label>
                <input type="text" id="airline_name" name="airline_name" value="<?php echo isset($air_line_port) ? $air_line_port['airline_name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_no">Contact Number:</label>
                <input type="text" id="contact_no" name="contact_no" value="<?php echo isset($air_line_port) ? $air_line_port['contact_no'] : ''; ?>" required>
            </div>
            <!-- Add more form fields for other airline port details as needed -->
            <button type="submit">Update</button>
        </form>
    </div>
</body>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #fff;
    color: #000;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #000;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #000;
}

input[type="text"],
input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button[type="submit"] {
    background-color: #000;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #333;
}

</style>

</html>
