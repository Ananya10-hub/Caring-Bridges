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

// Fetch data from the contact_us table
$query = "SELECT * FROM contact_us";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error fetching data: " . mysqli_error($con);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('su1.jpg') center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: black;
            text-align: center;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color: black;
        }

        th {
            background-color: white;
        }

        tbody tr {
            background-color: white;
        }

        tbody tr:nth-child(even) {
            background-color: white;
        }

        tbody tr:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <h2>Contact Us Details</h2>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['message']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
mysqli_close($con);
?>
