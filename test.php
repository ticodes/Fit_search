<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursach";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM FitSearch";
$result = $conn->query($sql);

$dataset = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dataset[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спортивные залы</title>
    <style>
        body {
            background-color: #1c1c1c;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #ff4040;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            border: 1px solid #333;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #2c2c2c;
            color: #ff4040;
        }

        td {
            background-color: #1c1c1c;
        }

        label {
            color: #ffffff;
            margin-right: 10px;
        }

        input[type="text"] {
            padding: 6px;
        }

        button {
            background-color: #ff4040;
            color: #ffffff;
            padding: 8px;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #ff6666;
        }

        /* Новые стили для улучшенного внешнего вида */
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"] {
            width: 200px;
        }

        form input[type="radio"] {
            margin-right: 5px;
        }

        .buttons-container {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Таблица данных</h2>

        <form id="columnsForm">
            <?php
            if (!empty($dataset[0])) {
                $columnTranslations = [
                    'global_id' => 'ID зала',
                    'ObjectName' => 'Название зала',
                    'District' => 'Район',
                    'Address' => 'Адрес',
                    'Email' => 'Эл. почта',
                    'WebSite' => 'Веб-сайт',
                    'HelpPhone' => 'Телефон поддержки',
                    'HasEquipmentRental' => 'Прокат оборудования',
                    'HasTechService' => 'Техническое обслуживание',
                    'HasDressingRoom' => 'Раздевалка',
                    'HasEatery' => 'Кафе',
                    'HasToilet' => 'Туалет',
                    'HasWifi' => 'Wi-Fi',
                    'HasCashMachine' => 'Банкомат',
                    'HasFirstAidPost' => 'Пункт первой помощи',
                    'HasMusic' => 'Музыкальное сопровождение',
                    'Lighting' => 'Тип освещения',
                    'Seats' => 'Места',
                    'Paid' => 'Платность',
                    'PaidComments' => 'Комментарии к оплате',
                    'DisabilityFriendly' => 'Доступность для инвалидов'
                ];

                foreach ($dataset[0] as $key => $value) {
                    $translatedLabel = isset($columnTranslations[$key]) ? $columnTranslations[$key] : $key;
                    echo "<label><input type='checkbox' name='columns[]' value='$key'>$translatedLabel</label>";
                }
            }
            ?>
            <div class="buttons-container">
                <button type="button" onclick="showSelectedColumns()">Показать выбранные столбцы</button>
            </div>
        </form>

        <form id="filterForm">
            <label for="search">Поиск:</label>
            <input type="text" id="search" name="search">
            <br>
            <label><input type="radio" name="filter" value="all" checked>Все</label>
            <label><input type="radio" name="filter" value="free">Бесплатные</label>
            <div class="buttons-container">
                <button type="button" onclick="filterTable()">Применить фильтр</button>
            </div>
        </form>

        <table id="datasetTable">
            <thead id="tableHead">
                <tr>
                    <?php
                    if (!empty($dataset[0])) {
                        foreach ($dataset[0] as $key => $value) {
                            $translatedHeader = isset($columnTranslations[$key]) ? $columnTranslations[$key] : $key;
                            echo "<th data-column='$key'>$translatedHeader</th>";
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                foreach ($dataset as $row) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        echo "<td data-column='$key'>$value</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function showSelectedColumns() {
            var selectedColumns = [];
            var checkboxes = document.querySelectorAll('#columnsForm input[name="columns[]"]:checked');
            checkboxes.forEach(function (checkbox) {
                selectedColumns.push(checkbox.value);
            });

            var tableHead = document.getElementById('tableHead');
            var tableBody = document.getElementById('tableBody');

            // Показать выбранные столбцы в thead
            tableHead.innerHTML = '<tr>';
            selectedColumns.forEach(function (column) {
                var translatedHeader = '<?php echo addslashes(isset($columnTranslations["' + column + '"]) ? $columnTranslations["' + column + '"] : ' + column + ');?>';

                tableHead.innerHTML += '<th style="display: none;" data-column="' + column + '">' + translatedHeader + '</th>';
            });
            tableHead.innerHTML += '</tr>';

            // Показать выбранные столбцы в tbody
            var rows = tableBody.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                for (var j = 0; j < cells.length; j++) {
                    var cell = cells[j];
                    var columnName = cell.getAttribute('data-column');
                    if (selectedColumns.indexOf(columnName) > -1) {
                        cell.style.display = '';
                    } else {
                        cell.style.display = 'none';
                    }
                }
            }
        }

        function filterTable() {
            var input, filter, table, tr, td, i, j;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("datasetTable");
            tr = table.getElementsByTagName("tr");
            var filterType = document.querySelector('input[name="filter"]:checked').value;

            for (i = 0; i < tr.length; i++) {
                var found = false;
                var cells = tr[i].getElementsByTagName("td");
                for (j = 0; j < cells.length; j++) {
                    td = cells[j];
                    if (td) {
                        var tdValue = td.innerHTML.toUpperCase();

                        if (filterType === 'all') {
                            if (tdValue.indexOf(filter) > -1) {
                                found = true;
                                break;
                            }
                        } else if (filterType === 'free' && tdValue.includes('БЕСПЛАТНО')) {
                            found = true;
                            break;
                        }
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>

</body>

</html>
