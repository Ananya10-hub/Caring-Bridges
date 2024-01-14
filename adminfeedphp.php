<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'test_women';

$con = mysqli_connect($server, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Connection Error: " . mysqli_connect_errno();
    exit();
}

// Fetch feedback data
$result = mysqli_query($con, "SELECT * FROM feedback");
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Collect the data in an array
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($con); // Close the database connection

// Output the data as JSON
echo json_encode($data);
?>
