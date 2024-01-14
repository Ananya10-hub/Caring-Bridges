<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="adminfeed.css">
    <title>Feedback Display</title>
    <script>
        // Use AJAX to fetch and display data
        function fetchData() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    displayData(data);
                }
            };
            xhr.open("GET", "adminfeed.php", true);
            xhr.send();
        }

        // Display data in the table
        function displayData(data) {
            var tableBody = document.getElementById("tableBody");
            data.forEach(function (row) {
                var tr = document.createElement("tr");
                tr.innerHTML = "<td>" + row.f_id + "</td>" +
                    "<td>" + row.pgm_name + "</td>" +
                    "<td>" + row.rating + "</td>" +
                    "<td>" + row.comments + "</td>" +
                    "<td>" + row.phone_no + "</td>";
                tableBody.appendChild(tr);
            });
        }

        // Fetch data on page load
        window.onload = function () {
            fetchData();
        };
    </script>
</head>

<body>

    <div class="feedback-container">
        <h2>Feedback Display</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>f_id</th>
                    <th>pgm_name</th>
                    <th>rating</th>
                    <th>comments</th>
                    <th>phone_no</th>
                </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>

    </div>

</body>

</html>
