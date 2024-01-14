<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'women';

$con = mysqli_connect($server, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Connection Error: " . mysqli_connect_errno();
    exit();
}

// Define scheme ID numbers for 6 schemes
$schemeNumbers = array(
    'Stree Shakthi' => 1,
    'Shanthwana' => 2,
    'Swayam Siddha' => 3,
    'Mahila Udyam Nidhi' => 4,
    'Bhagyalakshmi' => 5,
    'Dena Shakti' => 6
);

if (isset($_POST['submit'])) {
    $scheme_name     = $_POST['scheme_name'];
    $name            = $_POST['field_1']; // Update to field_1
    $age             = $_POST['field_2']; // Update to field_2
    $district        = $_POST['field_3']; // Update to field_3
    $taluk           = $_POST['field_4']; // Update to field_4
    $phone           = $_POST['field_5']; // Update to field_5
    $marital_status  = $_POST['field_6']; // Update to field_6

    if (array_key_exists($scheme_name, $schemeNumbers)) {
        $scheme_id = $schemeNumbers[$scheme_name];

        $query = mysqli_query($con, "INSERT INTO scheme_reg (Scheme_id, Scheme_name, Name, Age, District, Taluk, Phone_No, Marital_status) 
                                      VALUES ('$scheme_id', '$scheme_name', '$name', '$age', '$district', '$taluk', '$phone', '$marital_status')");

        if ($query) {
            echo "Registration successful";
            echo "<script>setTimeout(function() { window.location.href = 'scheme.html'; }, 1500);</script>";
        } else {
            echo "Registration unsuccessful : " . mysqli_error($con);
        }
    } else {
        echo "Scheme name does not exist in the mapping.";
    }
}

mysqli_close($con);
?>
