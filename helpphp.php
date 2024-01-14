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
    $name    = mysqli_real_escape_string($con, $_POST['name']);
    $email   = mysqli_real_escape_string($con, $_POST['email']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Use prepared statement to prevent SQL injection
    $query = mysqli_prepare($con, "INSERT INTO contact_us (name, email, message) VALUES (?, ?, ?)");

    // Bind parameters
    mysqli_stmt_bind_param($query, "sss", $name, $email, $message);

    // Execute the query
    $result = mysqli_stmt_execute($query);

    if ($result) {
        echo "Message has been sent, we will get back as soon as possible!";
        echo "<script>setTimeout(function() { window.location.href = 'home.html'; }, 1500);</script>";
    } else {
        echo "Registration unsuccessful: " . mysqli_error($con);
    }

    // Close the prepared statement
    mysqli_stmt_close($query);
}

mysqli_close($con);
?>
