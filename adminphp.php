<?php
// Establish connection to your database
$conn = new mysqli('localhost', 'root', '', 'test_women');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$query = "SELECT id, Email, Firstname, Lastname FROM signup"; // Specify columns from your 'signup' table
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td><a href='mailto:" . $row["Email"] . "'>" . $row["Email"] . "</a></td>"; // Modify to include email link
        echo "<td>" . $row["Firstname"] . "</td>";
        echo "<td>" . $row["Lastname"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No users found</td></tr>";
}

$conn->close();
?>
