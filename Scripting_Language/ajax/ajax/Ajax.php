<?php
if(isset($_GET["fname"]) && isset($_GET["lname"])){
    $fname = htmlspecialchars($_GET["fname"]);
    $lname = htmlspecialchars($_GET["lname"]);
    $fullname = $fname . " " . $lname;
    echo "Hello, $fullname! Welcome to the BCA program.";
} else {
    echo "Hi there! Welcome to our website.";
}
?>
