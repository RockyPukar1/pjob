<?php
session_start(); // Start the session

// Check if the company is signed in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // The company is signed in
    $companyname = $_SESSION['companyname'];
    $email = $_SESSION['email'];
    
    
} else {
    // The company is not signed in
    // Redirect the company to the login page or display an error message
    header("Location: signupcomp.php");
    exit;
}

// Establish the database connection
$host = "localhost";
$username = "root";
$password = "";
$dbName = "login";

// Create the database connection
$connection = mysqli_connect($host, $username, $password, $dbName);

// Check if the connection was successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// After successful user login
$username = "c_name"; // 

// Retrieve the user's email from the database based on the username
// Assuming you have a database connection established

// Perform a database query to fetch the user's email
// Replace 'users' with the actual table name and 'u_name' with the actual column name storing the username
$query = "SELECT email, c_id FROM company WHERE c_name = '$username'";

$result = mysqli_query($connection, $query);

// Check if the query was successful and retrieve the email value
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $companyid = $row['c_id'];

    

    // Set the username and email session variables
    $_SESSION['c_id']=$companyid;
    $_SESSION['c_name'] = $username;
    $_SESSION['email'] = $email;

}
?>

<?php
// Make a connection to the database
$con = mysqli_connect("localhost", "root", "", "login");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}



if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $address = $_POST['address'];
    $min_salary = $_POST['minsal'];
    $max_salary = $_POST['maxsal'];
    $job_nature = $_POST['jnat'];
    $job_description = $_POST['jdis'];
    $job_qualification = $_POST['jqual'];
    $job_responsibility = $_POST['jres'];
    
    // Prepare the query using prepared statements to prevent SQL injection
    $query = "INSERT INTO `jobs` (`j_title`, `j_category`, `j_address`, `min_salary`, `maximum_salary`, `j_nature`, `j_description`, `j_qualification`, `j_responsibility`, `c_id`)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind the statement
    $statement = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($statement, "ssssssssss", $title, $category, $address, $min_salary, $max_salary, $job_nature, $job_description, $job_qualification, $job_responsibility,  $_SESSION['c_id'] );

    // Execute the statement
    $result = mysqli_stmt_execute($statement);

    if ($result) {
        echo '<script>alert("Job Uploaded!");</script>';
        echo '<script>window.location.href = "index.php";</script>';

        exit();
    } else {
        echo "Failed: " . mysqli_error($con);
    }

    // Close the statement
    mysqli_stmt_close($statement);
}

// Close the connection
// mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">
<?php include( 'common/head.php') ?>

<body>
<?php include( 'common/nav.php') ?> <br><br>

        <div class="reg-box">
                <div class="form-box add">
                    <form action="add.php" method="POST">
                        <h2>Add job</h2>
                        <div class="input-box">
                                <input type="text" name="title" class="form-control border-0" placeholder="Job Title"  required />
                        </div>
                        <div class="input_box">
                                <select name="category" class="form-select border-0" required>
                                    <option value="">Category</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Customer Service">Customer Service</option>
                                    <option value="Human Resource">Human Resource</option>
                                    <option value="Project Management">Project Management</option>
                                    <option value="Business Development">Business Development</option>
                                    <option value="Sales & Communication">Sales & Communication</option>
                                    <option value="Teaching & Education">Teaching & Education</option>
                                    <option value="Design & Creative">Design & Creative</option>s
                                </select>
                        </div>
                        <div class="input-box">
                                <input type="text" name="address" class="form-control border-0" placeholder="Address"  required />
                        </div>
                        <div class="input-box">
                                <input type="number" name="minsal" class="form-control border-0" placeholder="Minimum Salary"  required />
                        </div> 
                        <div class="input-box">
                                <input type="number" name="maxsal" class="form-control border-0" placeholder="Maximum Salary"   required />
                        </div>
                
                        <div class="input-box">
                                <select name="jnat" class="form-select border-0" required>
                                    <option value="">Job Nature</option>
                                    <option value="Part time">Part time</option>
                                    <option value="Full time">Full time</option>
                                    
                                </select>
                        </div>
                        <div class="input-box" >
                            <textarea name="jdis" class="form-control" rows="5" placeholder="Job Description" required></textarea>
                        </div><br><br>
                        <div class="input-box" >
                            <textarea name="jres" class="form-control" rows="5" placeholder="Responsibility" required></textarea>
                        </div><br><br>
                        <div class="input-box"  >
                                <select name="jqual" class="form-select border-0" required>
                                    <option value="">Qualification</option>
                                    <option value="+2">+2</option>
                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                </select>

                        </div><br>   
                                           
                        <div class="submit" >
                            <button type="submit" class="btn1" value="submit" name="submit">Submit</button>
                        </div>
                        
                    </form> 
                </div>  
            </div>
            <br>
            <br>
</body>
</html>
