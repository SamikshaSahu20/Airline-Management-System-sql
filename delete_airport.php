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
    // Check if airport ID is provided
    if(isset($_POST['airport_id'])) {
        $airport_id = $_POST['airport_id'];

        // Query to delete airport by ID
        $delete_sql = "DELETE FROM air_line_port WHERE airport_id = $airport_id";
        if (mysqli_query($con, $delete_sql)) {
            echo "Airport with ID $airport_id deleted successfully.";
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }
    } else {
        echo "Airport ID not provided.";
    }
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Airport</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            margin-bottom: 10px;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Airport</h2>
        <form method="post">
            <label for="airport_id">Airport ID:</label>
            <input type="text" id="airport_id" name="airport_id" required>
            <button type="submit">Delete</button>
        </form>
    </div>
</body>
</html>