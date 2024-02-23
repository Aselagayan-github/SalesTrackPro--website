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

// Add Item
if (isset($_POST['add_item'])) {
    $ICODE = $_POST['ICODE'];
    $NAME = $_POST['NAME'];
    $ICATAGORY = $_POST['ICATAGORY'];
    $ISCATAGORY = $_POST['ISCATAGORY'];
    $QUANTITY = $_POST['QUANTITY'];
    $SID = $_POST['SID'];
    $PRICE = $_POST['PRICE'];

    $sql = "INSERT INTO item (ICODE, NAME, ICATAGORY, ISCATAGORY, QUANTITY, SID, PRICE) 
            VALUES ('$ICODE', '$NAME', '$ICATAGORY', '$ISCATAGORY', '$QUANTITY', '$SID', '$PRICE')";

    if (mysqli_query($conn, $sql)) {
        echo "Item added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Update Item
if (isset($_POST['update_item'])) {
    $ICODE = $_POST['ICODE'];
    $NAME = $_POST['NAME'];
    $ICATAGORY = $_POST['ICATAGORY'];
    $ISCATAGORY = $_POST['ISCATAGORY'];
    $QUANTITY = $_POST['QUANTITY'];
    $SID = $_POST['SID'];
    $PRICE = $_POST['PRICE'];

    $sql = "UPDATE item SET NAME='$NAME', ICATAGORY='$ICATAGORY', ISCATAGORY='$ISCATAGORY', QUANTITY='$QUANTITY', SID='$SID', PRICE='$PRICE' WHERE ICODE='$ICODE'";

    if (mysqli_query($conn, $sql)) {
        echo "Item updated successfully";
    } else {
        echo "Error updating item: " . mysqli_error($conn);
    }
}

// Delete Item
if (isset($_POST['delete_item'])) {
    $ICODE = $_POST['ICODE']; // Assuming 'ICODE' is the name of the unique identifier field for your item

    $sql = "DELETE FROM item WHERE ICODE='$ICODE'"; // Delete query

    if (mysqli_query($conn, $sql)) {
        echo "Item deleted successfully";
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }
}
// Function to create a delete button
function createDeleteButton($ICODE) {
    return "<form method='post'>
                <input type='hidden' name='ICODE' value='$ICODE'>
                <button type='submit' name='delete_item'>Delete</button>
            </form>";
}

// Function to create an update button
function createUpdateButton($ICODE) {
    return "<form method='post'>
                <input type='hidden' name='ICODE' value='$ICODE'>
                <button type='submit' name='update_item'>Update</button>
            </form>";
}

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Item MANAGE WEBPAGE</title>

    <style>
        body {
            background: url(iamges/post-05.jpg); /* Corrected image path */
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
  
        label {
         font-family: cursive;
         width: 381px;
         margin-right: 32px;
         font-size: 21px;
         color: red;
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
    </style>
</head>
<body>

    <h1>Item MANAGE NOW</h1>
    <form id="userForm" method="post">
        <!-- Your form fields here -->
        <label for="ICODE">Item code:</label>
        <input type="text" id="ICODE" name="ICODE" required>
        <label for="NAME">Item name:</label>
        <input type="text" id="NAME" name="NAME" required>
        <label for="ICATAGORY">Item category:</label>
        <select id="ICATAGORY" name="ICATAGORY">
            <option value="Not Selected">Select Item category</option>
            <option value="Office laptop">Office laptop</option>
            <option value="Gaming Laptops">Gaming Laptops</option>
            <option value="AMD Ryzen Laptops">AMD Ryzen Laptops</option>
            <option value="High-performance Laptops">High-performance Laptops</option>
            <option value="Student Laptops">Student Laptops</option>
            <option value="macOS Laptops">macOS Laptops</option>
        </select>
        <label for="ISCATAGORY">Item sub category:</label>
        <select id="ISCATAGORY" name="ISCATAGORY">
            <option value="Not Selected">Select Item sub category</option>
            <option value="Dell">Dell</option>
            <option value="HP">HP</option>
            <option value="Apple">Apple</option>
            <option value="Asus">Asus</option>
            <option value="Lenovo">Lenovo</option>
        </select>
        <label for="QUANTITY">Item Quantity:</label>
        <input type="number" id="QUANTITY" name="QUANTITY" required>
        <label for="SID">Seller ID:</label>
        <input type="text" id="SID" name="SID" required>
        <label for="PRICE">Unit Price(RS):</label>
        <input type="text" id="PRICE" name="PRICE" required>
        <button type="submit" name="add_item">ADD ITEM</button>
        
        
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
                <th>Actions</th> <!-- Add this column for update and delete buttons -->
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
                // Add update and delete buttons for each row
                echo "<td>" . createUpdateButton($row['ICODE']) . createDeleteButton($row['ICODE']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>