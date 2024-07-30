<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "flight";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a form where users input two passenger IDs
if (isset($_POST['passenger_id1']) && isset($_POST['passenger_id2'])) {
    $passenger_id1 = $_POST['passenger_id1'];
    $passenger_id2 = $_POST['passenger_id2'];

    // Retrieve details for passenger 1
    $sql_passenger1 = "SELECT * FROM passenger WHERE passenger_id = $passenger_id1";
    $result_passenger1 = $conn->query($sql_passenger1);

    if ($result_passenger1 !== false && $result_passenger1->num_rows > 0) {
        $passenger1_details = $result_passenger1->fetch_assoc();
    } else {
        echo "Passenger 1 not found.";
        exit();
    }

    // Retrieve details for passenger 2
    $sql_passenger2 = "SELECT * FROM passenger WHERE passenger_id = $passenger_id2";
    $result_passenger2 = $conn->query($sql_passenger2);

    if ($result_passenger2 !== false && $result_passenger2->num_rows > 0) {
        $passenger2_details = $result_passenger2->fetch_assoc();
    } else {
        echo "Passenger 2 not found.";
        exit();
    }

    // Merging passenger details
    $merged_name = $passenger1_details['firstName'] . " " . $passenger2_details['firstName'];

    // Update passenger 1 with merged name
    $update_sql = "UPDATE passengers SET name = '$merged_name' WHERE passenger_id = $passenger_id1";
    if ($conn->query($update_sql) === TRUE) {
        echo "Passenger details merged successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Passenger Merge</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    form {
        display: flex;
        flex-direction: column;
    }
    label {
        margin-bottom: 10px;
    }
    input[type="text"] {
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    input[type="submit"] {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Merge Passengers</h2>
    <form action="merge.php" method="post">
        <label for="passenger_id1">Passenger ID 1:</label>
        <input type="text" id="passenger_id1" name="passenger_id1" required>
        <label for="passenger_id2">Passenger ID 2:</label>
        <input type="text" id="passenger_id2" name="passenger_id2" required>
        <input type="submit" value="Merge">
    </form>
</div>
</body>
</html>

