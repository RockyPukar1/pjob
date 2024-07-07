<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $companyname = $_POST['username'];
  $email = $_POST['email'];
  $userPassword = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $address = $_POST['address'];
  $detail = $_POST['description'];

  // Check if the password and confirm password match
  if ($userPassword !== $cpassword) {
    echo "Error: Password and confirm password do not match.";
    exit;
  }

  // Get the current date and time
  $currentDate = date('Y-m-d H:i:s');

  // Database connection
  $servername = "localhost";
  $username = "root";
  $dbPassword = "";
  $dbname = "login";

  // Create a database connection
  $conn = new mysqli($servername, $username, $dbPassword, $dbname);

  // Check the database connection
  if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
  }
  // File upload handling
  $logoName = $_FILES['logo']['name'];
  $logoTmpName = $_FILES['logo']['tmp_name'];
  $logoError = $_FILES['logo']['error'];

  // Move uploaded file to desired directory
  $logoDestination = 'uploads/' . $logoName;
  move_uploaded_file($logoTmpName, $logoDestination);


  // Insert data into the database
  $stmt = $conn->prepare("INSERT INTO company (c_name, email, password, c_add, c_logo, added_date, c_detail) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $companyname, $email, $userPassword, $address, $logoName, $currentDate, $detail);
  if ($stmt->execute()) {
    $_SESSION['status'] = "Company signed up successfully";
    $_SESSION['status_code'] = "success";
    header("Location: signincomp.php");
    exit;
  } else {
    $_SESSION['status'] = "Company not signed up successfully";
    $_SESSION['status_code'] = "error";

    echo "Error: " . $stmt->error;
  }
  $stmt->close();
  $conn->close();
}