<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "SalesTrackPro";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Function to fetch records
function fetchRecords($conn, $startDate, $endDate) {
    $query = "SELECT buy.INO, buy.Date, customer.fname, item.NAME, item.ICODE, item.ICATAGORY, item.PRICE
              FROM buy
              INNER JOIN customer ON buy.YID = customer.id
              INNER JOIN item ON buy.INO = item.SID
              WHERE buy.Date BETWEEN '$startDate' AND '$endDate'";
    
    $result = mysqli_query($conn, $query);

    if($result !== false) {
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['INO'] . "</td>";
                echo "<td>" . $row['Date'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['NAME'] . "</td>";
                echo "<td>" . $row['ICODE'] . "</td>";
                echo "<td>" . $row['ICATAGORY'] . "</td>";
                echo "<td>" . $row['PRICE'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Check if POST parameters are set
if(isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Fetch and display records
    fetchRecords($conn, $startDate, $endDate);
}

// If no POST parameters, fetch and display all records
else {
    fetchRecords($conn, '1970-01-01', '9999-12-31'); // Adjust date range as needed
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Item report Page</title>
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
            <form id="searchForm" method="post">
                <input type="date" id="startDate" name="startDate">
                <input type="date" id="endDate" name="endDate">
                <button type="submit">SEARCH NOW</button>
            </form>

            <!-- Table to display records -->
            <table class="cd-table order-table table">
                <thead>
                    <tr>
                        <th>Invoice number</th>
                        <th>Date</th>
                        <th>Customer name</th>
                        <th>Item name</th>
                        <th>Item code</th>
                        <th>Item category</th>
                        <th>Item unit price</th>
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

    <script>
    // JavaScript code to handle form submission and AJAX request
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true); // Sending the request to the same PHP file
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('eventTableBody').innerHTML = xhr.responseText;
            }
        };
        xhr.send('startDate=' + startDate + '&endDate=' + endDate);
    });
</script>
</body>
</html>
