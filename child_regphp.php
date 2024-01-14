<?php
session_start(); // Start the session

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'test_women';

$con = mysqli_connect($server, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Connection Error: " . mysqli_connect_errno();
    exit();
}

if ($_SESSION['user_id']) {
    $women_id = $_SESSION['user_id']; // Retrieve women_id from the session

    // Associating scheme names with IDs
    $schemes = [
        'Beti Bachao Beti Padhao' => 1,
        'Balika Samridhi Yojana' => 2,
        'Sukanya Samriddhi' => 3,
        'Ladli Scheme' => 4,
        'Child Protection services' => 5,
        'POSHAN Abhiyaan' => 6
    ];

    if (isset($_POST['submit'])) {
        $scheme_name = $_POST['scheme_name'];

        // Check if the scheme_name is valid
        if (!array_key_exists($scheme_name, $schemes)) {
            echo "Invalid scheme selected.";
            echo "<script>setTimeout(function() { window.location.href = 'childreg.html'; }, 1500);</script>";
            exit();
        }

        $Scheme_id = $schemes[$scheme_name]; // Get scheme_id from the array

        $cname = $_POST['cname'];
        $womname = $_POST['womname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $vacc = $_POST['vacc'];
        $edu = $_POST['edu'];

        // File upload handling
        if (isset($_FILES['age_proof'])) {
            $age_proof_tmp = $_FILES['age_proof']['tmp_name'];
            $age_proof_name = $_FILES['age_proof']['name'];
            $age_proof_ext = strtolower(pathinfo($age_proof_name, PATHINFO_EXTENSION));

            $valid_extensions = array('jpg', 'jpeg', 'png');
            if (!in_array($age_proof_ext, $valid_extensions)) {
                echo "Invalid file type. Please upload a valid image.";
                echo "<script>setTimeout(function() { window.location.href = 'childreg.html'; }, 1500);</script>";
                exit();
            }

            // Read file content into string
            $age_proof_data = file_get_contents($age_proof_tmp);
        }

        // Assuming 'child_id' is auto-incremented
        $query = mysqli_prepare($con, "INSERT INTO child_data (women_id, Scheme_id, Scheme_name, child_name, women_name, child_age, api, gender, vaccine, education) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        mysqli_stmt_bind_param($query, 'iissssssss', $women_id, $Scheme_id, $scheme_name, $cname, $womname, $age, $age_proof_data, $gender, $vacc, $edu);

        if (mysqli_stmt_execute($query)) {
            echo "Registration successful";
            echo "<script>setTimeout(function() { window.location.href = 'scheme_c.html'; }, 1500);</script>";
        } else {
            echo "Registration unsuccessful: " . mysqli_error($con);
        }

        mysqli_stmt_close($query);
    }
} else {
    echo "User ID not found in session";
}

mysqli_close($con);
?>
