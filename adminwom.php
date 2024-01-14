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

// Fetch data from the scheme_details table
$query = "SELECT * FROM women_data";
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
    <title>Scheme Details</title>
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

        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>

    <h2>Scheme Details</h2>

    <table>
        <thead>
            <tr>
                <th>Scheme ID</th>
                <th>Scheme Name</th>
                <th>Name</th>
                <th>Age</th>
                <th>Age Image</th>
                <th>District</th>
                <th>Taluk</th>
                <th>Phone Number</th>
                <th>Marital Status</th>
                <th>Image</th>
                <th>Women ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['women_id']}</td>";
                echo "<td>{$row['Scheme_id']}</td>";
                echo "<td>{$row['Scheme_name']}</td>";
                echo "<td>{$row['Name']}</td>";
                echo "<td>{$row['Age']}</td>";
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['apiw']) . "' alt='Age Image'></td>";
                echo "<td>{$row['District']}</td>";
                echo "<td>{$row['Taluk']}</td>";
                echo "<td>{$row['Phone_No']}</td>";
                echo "<td>{$row['Marital_status']}</td>";
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['pic']) . "' alt='Image'></td>";
            
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
