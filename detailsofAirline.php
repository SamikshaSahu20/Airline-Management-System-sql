<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airport Information</title>
</head>
<body>
    <div class="container">
        <h2>Airport Information</h2>
        <table class="airport-table">
            <thead>
                <tr>
                    <th>Airport ID</th>
                    <th>Airport Name</th>
                    <th>City</th>
                    <th>Airline ID</th>
                    <th>Airline Name</th>
                    <th>Contact No</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
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

// Query to fetch all airport information
$sql = "SELECT * FROM airport";
$result = mysqli_query($con, $sql);

// Check if there are any airports
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['airport_id'] . "</td>";
        echo "<td>" . $row['airport_name'] . "</td>";
        echo "<td>" . $row['city'] . "</td>";
        echo "<td>" . $row['airline_id'] . "</td>";
        echo "<td>" . $row['airline_name'] . "</td>";
        echo "<td>" . $row['contact_no'] . "</td>";
        echo "<td><a href='update_airport.php?id=" . $row['airport_id'] . "'>Update</a></td>";
        echo "<td><a href='delete_airport.php?id=" . $row['airport_id'] . "'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No airports found</td></tr>";
}

// Close the database connection
mysqli_close($con);
?>

            </tbody>
        </table>
    </div>
    <!-- Data entry form -->
    <div class="container">
        <h2>Add Airport Data</h2>
        <form id="airportForm" class="form-horizontal" style="padding: 0 5rem 0 5rem; width: 100%; inner:100%" method="post" action="airport.php">
            <div class="form-group">
                <label for="airport-id">Airport ID</label>
                <input type="text" class="form-control trans-input-area" placeholder="Airport ID" id="airport-id" name="airport-id" required>
            </div>
            <div class="form-group">
                <label for="airport-name">Airport Name</label>
                <input type="text" class="form-control trans-input-area" placeholder="Airport Name" id="airport-name" name="airport-name" required>
            </div>
            <div class="form-group">
                <label for="airport-city">City</label>
                <input type="text" class="form-control trans-input-area" placeholder="City" id="airport-city" name="airport-city" required>
            </div>
            <div class="form-group">
                <label for="airline-id">Airline ID</label>
                <input type="text" class="form-control trans-input-area" placeholder="Airline ID" id="airline-id" name="airline-id" required>
            </div>
            <div class="form-group">
                <label for="airline-name">Airline Name</label>
                <input type="text" class="form-control trans-input-area" placeholder="Airline Name" id="airline-name" name="airline-name" required>
            </div>
            <div class="form-group">
                <label for="contact-no">Contact No</label>
                <input type="text" class="form-control trans-input-area" placeholder="Contact No" id="contact-no" name="contact-no" required>
            </div>
            <div class="form-group">
                <button class="btn btn-block trans-input-area" type="submit"><i class="glyphicon glyphicon-send"></i> Add Data</button>
            </div>
        </form>
    </div>
</body>
</html>
