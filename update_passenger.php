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

// Check if the passenger ID is provided in the URL
if(isset($_GET['id'])) {
    $passenger_id = $_GET['id'];

    // Query to fetch passenger details by ID
    $sql = "SELECT * FROM passenger WHERE id = $passenger_id";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        // Fetch passenger details
        $passenger = mysqli_fetch_assoc($result);

        // Handle form submission for updating passenger details
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize form data
            $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
            $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
            $age = mysqli_real_escape_string($con, $_POST['age']);
            $gender = mysqli_real_escape_string($con, $_POST['gender']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
            $address = mysqli_real_escape_string($con, $_POST['address']);
            $city = mysqli_real_escape_string($con, $_POST['city']);
            $state = mysqli_real_escape_string($con, $_POST['state']);
            $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
            $country = mysqli_real_escape_string($con, $_POST['country']);
            // Add more fields as needed

            // Update passenger details in the database
            $update_sql = "UPDATE passenger SET 
                            firstName='$firstName', 
                            lastName='$lastName', 
                            age='$age', 
                            gender='$gender', 
                            email='$email', 
                            mobile='$mobile', 
                            address='$address', 
                            city='$city', 
                            state='$state', 
                            pincode='$pincode', 
                            country='$country' 
                            WHERE id = $passenger_id";
            if (mysqli_query($con, $update_sql)) {
                // Redirect to the page where you want to display the updated passenger information
                header("Location: details.php");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
        }

        // Close the result set
        mysqli_free_result($result);
    } else {
        echo "No passenger found with ID: " . $passenger_id;
    }
} else {
    echo "Passenger ID not provided in the URL";
}

// Close the database connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Passenger Details</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a separate CSS file for styling -->
</head>
<body>
    <div class="container">
        <h2>Update Passenger Details</h2>
        <form method="post">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo $passenger['firstName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo $passenger['lastName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" id="age" name="age" value="<?php echo $passenger['age']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" value="<?php echo $passenger['gender']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $passenger['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="text" id="mobile" name="mobile" value="<?php echo $passenger['mobile']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $passenger['address']; ?>" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo $passenger['city']; ?>" required>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" value="<?php echo $passenger['state']; ?>" required>
            </div>
            <div class="form-group">
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" value="<?php echo $passenger['pincode']; ?>" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo $passenger['country']; ?>" required>
            </div>
            <!-- Add more form fields for other passenger details as needed -->
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
