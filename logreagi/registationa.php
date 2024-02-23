<?php include("connection.php"); ?>

<?php
// Check if the form is submitted
if(isset($_POST['registers'])) {
    // Retrieve form data
    $id = $_POST['Id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['Contact'];
    $distric = $_POST['Distric'];

    // Validate data (you can add more validation as per your requirements)
    if(empty($id) || empty($fname) || empty($lname) || empty($contact) || empty($distric)) {
        // Handle empty fields
        echo "All fields are required!";
    } else {
        // Connect to your database (replace dbname, username, password with your actual database credentials)
        $conn = new mysqli("localhost", "root", "", "SalesTrackPro");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO customer (id, fname, lname, contact, distric) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $id, $fname, $lname, $contact, $distric);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>
