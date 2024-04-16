<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["user"]));
    
    if (!empty($name)) {
        $mysqli = new mysqli("localhost", "root", "", "bca");
        
        if ($mysqli->connect_error) {
            die("ERROR: Could not connect. " . $mysqli->connect_error);
        }
        
        $sql = "SELECT * FROM users WHERE username='$name'";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                echo "Available";
            } else {
                echo "Not Available";
            }
            $result->free();
        } else {
            echo "Query execution failed: " . $mysqli->error;
        }
        
        $mysqli->close();
    } else {
        echo "Name field is empty";
    }
}
?>
