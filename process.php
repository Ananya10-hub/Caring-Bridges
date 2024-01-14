<?php
$firstname = $_POST["Firstname"];
$lastname = $_POST["Lastname"];
$email = $_POST["Email"];
$password = $_POST["Password"];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'test_women');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    // Check if the email already exists in the database
    $check_query = "SELECT * FROM signup WHERE email = '$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // If email exists, display a message and redirect to the login page
        echo "Account with this email already exists! Redirecting to login page...";
        echo "<script>setTimeout(function() { window.location.href = 'login.html'; }, 3000);</script>";
    } else {
        // If email does not exist, proceed with registration
        $stmt = $conn->prepare("INSERT INTO signup (`firstname`, `lastname`, `email`, `password`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);

        if ($stmt->execute()) {
            // Display success message
            echo "Sign up successful. You will be redirected to the home page shortly.";

            // Start the session and handle redirection (as shown in your previous code)
            // Redirect to the home page after 3 seconds
            header("refresh:3;url=home.html");
            exit(); // Make sure to exit after redirection
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>
