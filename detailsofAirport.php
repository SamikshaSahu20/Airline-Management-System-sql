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
$sql = "SELECT * FROM air_line_port";
$result = mysqli_query($con, $sql);

// Check if the query executed successfully
if (!$result) {
    die("Error executing the query: " . mysqli_error($con));
}

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
        echo "<td><a href='update_airport.php?Aid=" . $row['airport_id'] . "'>Update</a></td>";
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
    </body>
<style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .airport-table {
            width: 100%;
            border-collapse: collapse;
        }

        .airport-table th, .airport-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .airport-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .airport-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .airport-table tbody tr:hover {
            background-color: #e9e9e9;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
</style>

</html>
