<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Itinerary</title>
<link rel="stylesheet" href="mycss.css">

    </head>
<body>
<div class="container">
  <button class="btn" onclick="window.location.href = 'merge.php';">Merge Now</button>
</div>
    <div class="container">
        <h2>Passenger Information</h2>
        <table class="passenger-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pincode</th>
                    <th>Country</th>
                    <th>Action</th>
                    <th>Delete</th>
                    <th>Payment</th> <!-- Added Payment column -->
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
                
                // Check if the passenger ID is provided in the URL for deletion
                if(isset($_GET['delete_id'])) {
                    $passenger_id = $_GET['delete_id'];

                    // Query to delete passenger by ID
                    $delete_sql = "DELETE FROM passenger WHERE id = $passenger_id";
                    if (mysqli_query($con, $delete_sql)) {
                        // Redirect to the page where you want to display the updated passenger information
                        header("Location: itineary.html");
                        exit();
                    } else {
                        echo "Error deleting record: " . mysqli_error($con);
                    }
                }

                // Query to fetch all passenger information
                $sql = "SELECT * FROM passenger";
                $result = mysqli_query($con, $sql);

                // Check if there are any passengers
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['firstName'] . "</td>";
                        echo "<td>" . $row['lastName'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['mobile'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['state'] . "</td>";
                        echo "<td>" . $row['pincode'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td><a href='update_passenger.php?id=" . $row['id'] . "'>Update</a></td>"; // Assuming 'id' is the primary key of your passenger table
                        echo "<td><a href='delete_passenger.php?id=" . $row['id'] . "'>Delete</a></td>"; // Assuming 'id' is the primary key of your passenger table
                        echo "<td><a href='payments.php?id=" . $row['id'] . "'>Make Payment</a></td>"; // Assuming 'id' is the primary key of your passenger table
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No passengers found</td></tr>";
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
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.container {
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333333;
    margin-bottom: 20px; /* Added margin bottom for spacing */
}

.passenger-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px; /* Adjusted margin top for spacing */
}

.passenger-table th, .passenger-table td {
    padding: 12px;
    border-bottom: 1px solid #dddddd;
    text-align: left;
    font-weight: 400;
    font-size: 14px;
}

.passenger-table th {
    background-color: #f2f2f2;
    font-weight: bold;
    color: #333333;
}

.passenger-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.passenger-table tbody tr:hover {
    background-color: #e9e9e9;
}

/* Added styles for links */
.passenger-table a {
    color: #007bff; /* Adjust link color */
    text-decoration: none;
}

.passenger-table a:hover {
    text-decoration: underline;
}

</style>

</html>
