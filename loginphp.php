<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'test_women');

// Handle login
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password) && !is_numeric($username)) {
        $query = "SELECT * FROM signup WHERE Email = '$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);

            if ($userdata['Password'] == $password) {
                // Start the session
                session_start();

                // Store user ID in the session
                $_SESSION['user_id'] = $userdata['id'];

                // Check if username is 'admin1@gmail.com' or 'admin2@gmail.com' and redirect accordingly
                if ($username === 'admin1@gmail.com' || $username === 'admin2@gmail.com') {
                    header("Location: adminhome.html");
                    exit();
                } else {
                    // Redirect to the registration form page
                    header("Location: home.html");
                    exit(); // Make sure to exit after redirection
                }
            } else {
                echo "Invalid username or password";
            }
        } else {
            echo "Invalid username or password";
        }
    }
}
?>
