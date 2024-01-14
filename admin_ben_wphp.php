<?php
// Establish connection to your database

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'test_women';

$conn = mysqli_connect($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $scheme_name = $_POST['prgm_name'];
    $dob = $_POST['dob'];
    $phone_no = $_POST['ph_no'];
    $address = $_POST['addr'];

    // Check if the Name, Scheme_id combination exists in women_data table
    $scheme_query = "SELECT Scheme_id FROM women_data WHERE Scheme_name = '$scheme_name' AND Name = '$name'";
    $scheme_result = $conn->query($scheme_query);

    if ($scheme_result->num_rows > 0) {
        $row = $scheme_result->fetch_assoc();
        $scheme_id = $row['Scheme_id'];

        // Insert data into benefactor_women table
        $insert_query = "INSERT INTO benefactor_women (Name, Scheme_id, Scheme_name, Dob, Phone_no, address) VALUES ('$name', '$scheme_id', '$scheme_name', '$dob', '$phone_no', '$address')";

        if ($conn->query($insert_query) === TRUE) {
            echo "Record successfully inserted";
            echo "<script>setTimeout(function() { window.location.href = 'ben_w.html'; }, 2000);</script>";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        echo "No Name, Scheme_id combination exist";
    }
}

$conn->close();
?>
