<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спортивные залы</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container">
        <h2>Визуализация количества залов по районам Москвы (нажмите на элементы диаграммы)</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kursach";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $tempTable = "temp_grouped_gyms";
        $sqlCreateTempTable = "CREATE TEMPORARY TABLE $tempTable AS SELECT District, COUNT(*) AS GymCount FROM FitSearch GROUP BY District";
        $conn->query($sqlCreateTempTable);

        $sqlSelect = "SELECT * FROM $tempTable";
        $result = $conn->query($sqlSelect);

        $districts = [];
        $gymCounts = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $districts[] = $row['District'];
                $gymCounts[] = $row['GymCount'];
            }
        }

        $sqlDropTempTable = "DROP TEMPORARY TABLE IF EXISTS $tempTable";
        $conn->query($sqlDropTempTable);

        $conn->close();
        ?>

        

        <div style="width: 80%; margin: 20px auto;">
            <canvas id="gymChart"></canvas>
        </div>

        <script>
            var districts = <?php echo json_encode($districts); ?>;
            var gymCounts = <?php echo json_encode($gymCounts); ?>;

            var ctx = document.getElementById('gymChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: districts,
                    datasets: [{
                        label: 'Количество залов',
                        data: gymCounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>

</body>

</html>
