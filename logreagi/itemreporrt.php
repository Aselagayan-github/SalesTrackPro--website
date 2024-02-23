
        <?php
error_reporting(0);
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
$query = "SELECT `ICODE`, `NAME`, `ICATAGORY`, `ISCATAGORY`, `QUANTITY`, `SID`, `PRICE` FROM `item`";
$result = mysqli_query($conn, $query);

// Fetch and encode the data for JavaScript consumption
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
$dataJson = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item report Page</title>
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
    <!-- Main section -->
    <main>
        <section class="container cd-table-container">
            <h2 class="cd-title">Item Table Records:</h2>

            <!-- Table to display records -->
            <table class="cd-table order-table table">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Item Category</th>
                        <th>Item Subcategory</th>
                        <th>Item Quantity</th>
                        <th>Seller ID</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody id="eventTableBody">
                    <?php
                    // Populate table rows with fetched records
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['NAME'] . "</td>";
                        echo "<td>" . $row['ICATAGORY'] . "</td>";
                        echo "<td>" . $row['ISCATAGORY'] . "</td>";
                        echo "<td>" . $row['QUANTITY'] . "</td>";
                        echo "<td>" . $row['SID'] . "</td>";
                        echo "<td>" . $row['PRICE'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Exit button -->
            <button onclick="window.location.href='index.html';">
                EXIT NOW HOME PAGE
            </button>
        </section>
    </main>
    <footer class="credit">Developed by: Asela Gayan - <a title="Awesome web design code & scripts" href="https://www.linkedin.com/in/asela-gayan-503687212/" target="_blank">LinkedIn</a></footer>
</body>
</html>
