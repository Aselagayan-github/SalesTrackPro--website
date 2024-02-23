<?php
// Start session
session_start();

// Suppress notices
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Database connection
<?php
    include ("connection.php");?>
<?php
    if(isset($_POST['login'])){
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        

        $query = "SELECT * FROM  customer WHERE id ='$id' && fname ='$fname'";
        $data = mysqli_query($conn,$query);

        $total = mysqli_num_rows($data);
        
        if($total == 1)
        {
            echo "Login sucessfull";
            
        }
        else{
            echo "login failed";
        }


    }


?>