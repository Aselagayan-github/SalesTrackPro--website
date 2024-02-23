
<?php
// Database connection
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "SalesTrackPro";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Fetch table records
$query = "SELECT `INO`, `Date`, `NAME`, `ICAATAGORY`, `IQUANTITY`, `PRICE` FROM `buy`";
$result = mysqli_query($conn, $query);

// JSON encode the fetched data for JavaScript consumption
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
$dataJson = json_encode($data);

// Function to fetch records within the specified date range
function fetchRecordsByDateRange($startDate, $endDate, $conn) {
    $query = "SELECT `INO`, `Date`, `NAME`, `ICAATAGORY`, `IQUANTITY`, `PRICE` FROM `buy` WHERE `Date` BETWEEN '$startDate' AND '$endDate'";
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice report page</title>
    <!-- Demo CSS -->
    <link rel="stylesheet" href="css/demo.css">
    <style>
        .cd-table-container {
            background: #fff;
            box-shadow: 1px 2px 26px rgba(0, 0, 0, 0.2);
            padding: 15px;
            max-width: 720px;
        }
        /* Table Design */
        .cd-table {
            width: 100%;
            color: #666;
            margin: 10px auto;
            border-collapse: collapse;
        }

            .cd-table tr, .cd-table td {
                border: 1px solid #ccc;
                padding: 10px;
            }

            .cd-table th {
                background: #017721;
                color: #fff;
                padding: 10px;
            }
        /* Search Box */
        .cd-search {
            padding: 10px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
        }
        /* Search Title */
        .cd-title {
            color: #666;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <!-- Header section -->
    <!-- Main section -->
    <main>
        <section class="container cd-table-container">
            <h2 class="cd-title">Search Table Records:</h2>
            <!-- Date range inputs -->
            <input type="date" id="startDate" name="startDate">
            <input type="date" id="endDate" name="endDate">
            <button type="button" onclick="searchRecords()">SEARCH NOW</button>

            <!-- Table to display records -->
            <table class="cd-table order-table table">
                <thead>
                    <tr>
                        <th>Invoice number</th>
                        <th>Date</th>
                        <th>Item name</th>
                        <th>Item category</th>
                        <th>Item quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody id="eventTableBody"></tbody>
            </table>

            <!-- Exit button -->
            <button onclick="window.location.href='index.html';">
                EXIT NOW HOME PAGE
            </button>
        </section>
    </main>
    <footer class="credit">Developed by: Asela Gayan - <a title="Awesome web design code & scripts" href="https://www.linkedin.com/in/asela-gayan-503687212/" target="_blank">LinkedIn</a></footer>

    <!-- JavaScript to handle search and display records -->
    <script>
        // Function to populate table with fetched records
        function populateTable(data) {
            var tableBody = document.getElementById('eventTableBody');
            tableBody.innerHTML = '';
            data.forEach(function(record) {
                var row = "<tr>";
                row += "<td>" + record.INO + "</td>";
                row += "<td>" + record.Date + "</td>";
                row += "<td>" + record.NAME + "</td>";
                row += "<td>" + record.ICAATAGORY + "</td>";
                row += "<td>" + record.IQUANTITY + "</td>";
                row += "<td>" + record.PRICE + "</td>";
                row += "</tr>";
                tableBody.innerHTML += row;
            });
        }

        // Function to search records within date range
        function searchRecords() {
            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;
            var data = <?php echo $dataJson; ?>;
            var filteredData = data.filter(function(record) {
                return record.Date >= startDate && record.Date <= endDate;
            });
            populateTable(filteredData);
        }

        // Initial population of table
        window.onload = function() {
            var data = <?php echo $dataJson; ?>;
            populateTable(data);
        };
    </script>
</body>
</html>




