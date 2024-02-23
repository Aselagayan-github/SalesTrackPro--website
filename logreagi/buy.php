<?php
error_reporting(0);
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "SalesTrackPro";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if (mysqli_connect_errno()) {
    echo " failed to connect ";
    exit();
}

// Function to generate a unique invoice number
function generateInvoiceNumber() {
    // Prefix for the invoice number
    $prefix = "INV";
    // Get the current timestamp
    $timestamp = time();
    // Generate the unique invoice number by concatenating prefix and timestamp
    $invoiceNumber = $prefix . $timestamp;
    return $invoiceNumber;
}

// Use the generated invoice number in the form field
$INO = generateInvoiceNumber();

if(isset($_POST['BUY'])) {
    // Retrieve form data
    $INO = $_POST['INO'];
    $NAME = $_POST['NAME'];
    $ICAATAGORY = $_POST['ICAATAGORY'];
    $ISUCATAGORY = $_POST['ISUCATAGORY'];
    $IQUANTITY = $_POST['IQUANTITY'];
    $YID = $_POST['YID'];
    $Date = $_POST['Date'];
    $PRICE = $_POST['PRICE'];
    
    // Insert data into the database
    $query = "INSERT INTO `buy` (`INO`, `NAME`, `ICAATAGORY`, `ISUCATAGORY`, `IQUANTITY`, `YID`, `Date`, `PRICE`) 
              VALUES ('$INO', '$NAME', '$ICAATAGORY', '$ISUCATAGORY', '$IQUANTITY', '$YID', '$Date', '$PRICE')";
    
    if(mysqli_query($conn, $query)) {
        echo "Item bought successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Item MANAGE WEBPAGE</title>

    <style>
        body {
            background: url(iamges/post-01.jpg); /* Corrected image path */
            background-size: cover;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        h1 {
            font-size: 37px;
            font-weight: 600;
            color: Green;
            text-transform: uppercase;
            text-align: center;
            margin-top: 20px;
        }

        form {
            margin: 0 auto;
            max-width: 500px;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }

        

        input, select {
            width: 48%;
            border: 2px solid black;
            font-size: 15px;
            padding: 7px;
            border-radius: 3px;
            transition: all 0.5s ease;
        }

        button {
            width: 48%;
            padding: 8px 10px;
            font-size: 18px;
            font-weight: 700;
            border: 3px solid red;
            border-radius: 25px;
            color: rgb(255, 6, 6);
            background-color: transparent;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: rgba(255, 0, 0, 0.2);
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid white;
            color: yellow;
            background-color: rgba(0, 0, 0, 0.7);
            text-align: center;
        }

        th {
            background-color: black;
        }

        tr:nth-child(even) {
            background-color: rgba(150, 212, 212, 0.4);
        }

        label {
         font-family: cursive;
         width: 381px;
         margin-right: 32px;
         font-size: 21px;
         color: Red;
         }

        input {
         width: 100%;
         border: 2px solid black;
         font-size: 15px;
         padding: -37px 1px;
         border-radius: 3px;
         transition: all 0.5s ease;
         padding: 7px;
         }
    </style>
</head>
<body>

    <h1>Item BUY NOW</h1>
    <form id="userForm" method="post">
        <!-- Your form fields here -->
        <label for="INO">Invoice no</label>
        <input type="text" id="INO" name="INO" value="<?php echo $INO; ?>" required>
        <label for="NAME">Item name:</label>
        <input type="text" id="NAME" name="NAME" required>
        <label for="ICAATAGORY">Item category:</label>
        <select id="ICAATAGORY" name="ICAATAGORY">
            <option value="Not Selected">Select Item category</option>
            <option value="Office laptop">Office laptop</option>
            <option value="Gaming Laptops">Gaming Laptops</option>
            <option value="AMD Ryzen Laptops">AMD Ryzen Laptops</option>
            <option value="High-performance Laptops">High-performance Laptops</option>
            <option value="Student Laptops">Student Laptops</option>
            <option value="macOS Laptops">macOS Laptops</option>
        </select>
        <label for="ISUCATAGORY">Item sub category:</label>
        <select id="ISUCATAGORY" name="ISUCATAGORY">
            <option value="Not Selected">Select Item sub category</option>
            <option value="Dell">Dell</option>
            <option value="HP">HP</option>
            <option value="Apple">Apple</option>
            <option value="Asus">Asus</option>
            <option value="Lenovo">Lenovo</option>
        </select>
        <label for="IQUANTITY">Item Quantity:</label>
        <input type="number" id="IQUANTITY" name="IQUANTITY" required>
        <label for="YID">Your ID:</label>
        <input type="text" id="YID" name="YID" required>
        <label for="Date">Date</label>
        <input type="text" id="Date" name="Date" required>
         <label for="PRICE">Price</label>
        <input type="text" id="PRICE" name="PRICE" required>

        <button type="submit" name="BUY">BUY ITEM</button>
        
        <button onclick="window.location.href='index.html';">
        EXIT NOW HOME PAGE
        </button>
        
    </form>

    <table border="1" style="width:80%">
        <thead>
            <tr>
                <th>Item code</th>
                <th>Item name</th>
                <th>Item category</th>
                <th>Sub category</th>
                <th>Quantity</th>
                <th>Seller ID</th>
                <th>Price</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display items from the database
            $query = "SELECT * FROM item";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['ICODE'] . "</td>";
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

</body>
</html>