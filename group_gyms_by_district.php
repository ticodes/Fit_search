<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursach";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Создаем временную таблицу для хранения результатов 
$tempTable = "temp_grouped_gyms";
$sqlCreateTempTable = "CREATE TEMPORARY TABLE $tempTable AS SELECT District, COUNT(*) AS GymCount FROM FitSearch GROUP BY District";
$conn->query($sqlCreateTempTable);

// Запрос на выборку из временной таблицы без сортировки
$sqlSelect = "SELECT * FROM $tempTable";
$result = $conn->query($sqlSelect);

if ($result->num_rows > 0) {
    echo "<h3>Группировка по районам:</h3>";
    // Выводим данные без ссылок для изменения сортировки
    echo "<table>";
    echo "<tr><th>Район</th><th>Количество залов</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['District'] . "</td>";
        echo "<td>" . $row['GymCount'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Нет данных для отображения.";
}

// Удаляем временную таблицу
$sqlDropTempTable = "DROP TEMPORARY TABLE IF EXISTS $tempTable";
$conn->query($sqlDropTempTable);

$conn->close();
?>
