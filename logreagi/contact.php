<?php
error_reporting(0);

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "SalesTrackPro";

// Create connection
$conn = mysqli_connect($serverName, $userName, $password, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $phone = mysqli_real_escape_string($conn, $_POST['Phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $message = mysqli_real_escape_string($conn, $_POST['Message']);

    // Attempt insert query execution
    $sql = "INSERT INTO `contact` (`name`, `phone`, `email`, `massage`) VALUES ('$name', '$phone', '$email', '$message')";
    if (mysqli_query($conn, $sql)) {
        echo "Records added successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>