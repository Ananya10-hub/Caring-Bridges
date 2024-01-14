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
    $pgm_name  = $_POST['pgm_name'];
    $rating    = $_POST['rating'];
    $comments  = $_POST['comments'];
    $phone_no  = $_POST['phone_no'];

    $query = mysqli_prepare($con, "INSERT INTO feedback (pgm_name, rating, comments, phone_no) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, 'ssss', $pgm_name, $rating, $comments, $phone_no);
    $success = mysqli_stmt_execute($query);

    if ($success) {
        echo "Feedback submission successful, thank you for your feedback!";
        echo "<script>setTimeout(function() { window.location.href = 'home.html'; }, 1500);</script>";
    } else {
        echo "Feedback submission unsuccessful: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
