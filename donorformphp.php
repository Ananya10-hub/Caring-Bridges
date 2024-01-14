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

if (isset($_POST['submit'])) {
    $donor_name = $_POST['donor_name'];
    $age = $_POST['age'];
    $phone_number = $_POST['phone_number'];
    $amount_donated = $_POST['amount_donated'];
    $mode_of_payment = $_POST['mode_of_payment'];
    $pgrm_name = $_POST['pgrm_name'];

    $query = mysqli_prepare($con, "INSERT INTO donor_details (donor_name, age, phone_number, amount_donated, mode_of_payment, pgrm_name) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, 'sissss', $donor_name, $age, $phone_number, $amount_donated, $mode_of_payment, $pgrm_name);
    mysqli_stmt_execute($query);

    if ($query) {
        echo "Donation submission successful, thank you for your contribution!";
        echo "<script>setTimeout(function() { window.location.href = 'home.html'; }, 1500);</script>";
    } else {
        echo "Donation submission unsuccessful: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
