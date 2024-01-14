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
    $std = $_POST['std'];
    $phone_no = $_POST['ph_no'];
    $det = $_POST['det'];

    // Retrieve Scheme_id and Scheme_name from child_data table
    $scheme_query = "SELECT Scheme_id, Scheme_name FROM child_data WHERE Scheme_name = '$scheme_name'";
    
    $scheme_result = $conn->query($scheme_query);

    if ($scheme_result->num_rows > 0) {
        $row = $scheme_result->fetch_assoc();
        $scheme_id = $row['Scheme_id'];
        $scheme_name = $row['Scheme_name'];

        // Insert data into benefactor_child table
        $insert_query = "INSERT INTO benefactor_child (Name, Scheme_id, Scheme_name, Start_date, Phone_no, details) 
                         VALUES ('$name', '$scheme_id', '$scheme_name', '$std', '$phone_no', '$det')";

        if ($conn->query($insert_query) === TRUE) {
            echo "Record successfully inserted";
            echo "<script>setTimeout(function() { window.location.href = 'ben_c.html'; }, 2000);</script>";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        echo "Scheme not found in child data";
    }
}

$conn->close();
?>
