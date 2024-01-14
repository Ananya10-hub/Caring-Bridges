<!DOCTYPE html>
<html>
<head>
  <title>Beneficiary Statistics</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'test_women';

$con = mysqli_connect($server, $username, $password, $database);

// Specify the desired schemes for the graph
$selected_schemes = ['Beti Bachao Beti Padhao', 'Balika Samridhi Yojana', 'Sukanya Samriddhi', 'Ladli Scheme', 'Child Protection services', 'POSHAN Abhiyaan'];

// Query to fetch data for selected schemes
$query = $con->prepare("SELECT scheme_name, COUNT(ben_id) AS benefactor_count FROM benefactor_child WHERE scheme_name IN (?, ?, ?, ?, ?, ?) GROUP BY scheme_name");
$query->bind_param('ssssss', ...$selected_schemes);
$query->execute();

$result = $query->get_result();

$scheme_names = [];
$benefactor_counts = [];
$chart_colors = []; // Array to store unique colors for bars

// Generating random colors for each scheme
function generateRandomColor() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

while ($data = $result->fetch_assoc()) {
    $scheme_names[] = $data['scheme_name'];
    $benefactor_counts[] = $data['benefactor_count'];
    $chart_colors[] = generateRandomColor(); // Assign a random color for each bar
}
?>

<div style="width: 800px; margin: 0 auto;">
  <canvas id="myChart"></canvas>
</div>

<script>
  const labels = <?php echo json_encode($scheme_names) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Benefactor Count',
      data: <?php echo json_encode($benefactor_counts) ?>,
      backgroundColor: <?php echo json_encode($chart_colors) ?>,
      borderColor: <?php echo json_encode($chart_colors) ?>,
      borderWidth: 1
    }]
  };

  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
      scales: {
        x: {
          title: {
            display: true,
            text: 'Schemes'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Number of Benefactors'
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Benefactors of Child Schemes',
          font: {
            size: 20
          }
        }
      }
    }
  });
</script>

</body>
</html>
