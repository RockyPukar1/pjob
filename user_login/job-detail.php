
<?php
session_start(); // Start the session

// Check if the company is signed in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // The company is signed in
    $user =$_SESSION["u_name"];
    $email = $_SESSION['email'];
    

    // Continue with the desired code for a signed-in company
    // For example, display the company's dashboard or perform authorized actions

} else {
    // The company is not signed in
    // Redirect the company to the login page or display an error message
    header("Location: ../signinusr.php");
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
$username = "u_name";

$query = "SELECT email, u_id FROM users WHERE u_name = '$username'";

$result = mysqli_query($connection, $query);

// Check if the query was successful and retrieve the email value
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $userid= $row['u_id'];

    // Set the username and email session variables
    $_SESSION['u_id'] = $userid;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    
}



?>
<?php
// Database credentials
$hostname = 'localhost';  
$username = 'root';       
$password = '';   
$database = 'login';      

// Create a connection
$con = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Check if the job ID is provided in the URL
if (isset($_GET['j_id'])) {
    $jobId = $_GET['j_id'];

    // Retrieve the job details from the "jobs" table
    $query = "SELECT * FROM jobs WHERE j_id = $jobId"; // Make sure to use the correct column name (e.g., 'j_id')
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch job data
        $jobData = mysqli_fetch_assoc($result);
        $jobTitle = $jobData["j_title"];
        $jobAddress = $jobData["j_address"];
        $jobNature = $jobData["j_nature"];
        $minSalary = $jobData["min_salary"];
        $maxSalary = $jobData["maximum_salary"];
        $detail = $jobData["j_description"];
        $respo = $jobData["j_responsibility"];
        $qual = $jobData["j_qualification"];
        $date = $jobData["date_added"];
        $companyId = $jobData["c_id"]; // Assuming the foreign key column is named 'c_id'

        // Close the result set
        mysqli_free_result($result);

        // Now retrieve the company details from the "companies" table based on the fetched company ID
        $queryCompany = "SELECT * FROM company WHERE c_id = $companyId";
        $resultCompany = mysqli_query($con, $queryCompany);

        if ($resultCompany && mysqli_num_rows($resultCompany) > 0) {
            // Fetch company data
            $companyData = mysqli_fetch_assoc($resultCompany);
            $companyName = $companyData["c_name"];
            $companyLocation = $companyData["c_add"];
            $companydetail = $companyData["c_detail"];
            $companylogo = $companyData["c_logo"];
            // ... and other company-related data

            // Close the company result set
            mysqli_free_result($resultCompany);
        } else {
            // Company data not found or error occurred
            // Handle the case where the company data is not found in the database
            $companyName = "Company Not Found";
            $companyLocation = "N/A";
            // ... and other default values for company data
        }
    } else {
        // Job not found or error occurred
        // Handle the case where the job is not found in the database
        $jobTitle = "Job Not Found";
        $jobAddress = "N/A";
        // ... and other default values for job data
    }
} else {
    // Handle the case where the job ID is not provided in the URL
    $jobTitle = "Invalid Job ID";
    $jobAddress = "N/A";
    // ... and other default values for job data
}

// Close the connection
mysqli_close($con);
?>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is authenticated and has a user ID.
    // Replace 'your_user_id_variable_name' with the actual variable holding the user ID after authentication.
    if (!isset($_SESSION['u_id'])) {
        echo "User not authenticated.";
        exit;
    }

    // Retrieve the user ID from the session
    $user_id = $_SESSION['u_id'];

    // Get the job ID from the form data (hidden input field)
    $job_id = $_POST['jid'];

    // Get the company ID from the form data (hidden input field)
    $company_id = $_POST['company_id']; // Assuming you have added the hidden input field for company_id in the HTML form.

    // Connect to the database (Replace 'your_host', 'your_username', 'your_password', and 'your_database' with appropriate credentials)
    $conn = new mysqli('localhost', 'root', '', 'login');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the application already exists for the same job and user
    $check_sql = "SELECT COUNT(*) AS count FROM job_applications WHERE job_id = ? AND user_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $job_id, $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        // Application already exists, do not insert again
        echo '<script>alert("Application already submitted for this job!");</script>';
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        // Application does not exist, proceed with insertion

        // Sanitize and store form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $cover_letter = $_POST["cover_letter"];
        $resume_filename = $_FILES["resume"]["name"];

        // You should move the uploaded file to a designated folder on your server and store the file path in the database.
        // For simplicity, we'll just store the filename in the database.

        // Insert data into the database
        $insert_sql = "INSERT INTO job_applications (company_id, user_id, job_id, a_name, email, cover_letter, resume_filename) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("iiissss", $company_id, $user_id, $job_id, $name, $email, $cover_letter, $resume_filename);

        if ($stmt->execute()) {
            echo '<script>alert("Application submitted successfully!");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<?php include( 'common/head.php') ?>

<body>
   
<?php include( 'common/nav.php') ?>

        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown"><?php echo $jobTitle; ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        
                        <li class="breadcrumb-item text-white active" aria-current="page"><?php echo $jobTitle; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->


        <!-- Job Detail Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gy-5 gx-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-5">
                    <img class="flex-shrink-0 img-fluid border rounded" src="../uploads/<?php echo $companylogo; ?>" alt="" style="width: 80px; height: 80px;">
                    <div class="text-start ps-4">
                        <h3 class="mb-3"><?php echo $jobTitle; ?></h3>
                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo $jobAddress; ?></span>
                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?php echo $jobNature; ?></span>
                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>NRs <?php echo $minSalary; ?> - NRs <?php echo $maxSalary; ?></span>
                    </div>
                </div>

                <div class="mb-5">
                    <h4 class="mb-3">Job description</h4>
                    <p><?php echo $detail; ?></p>
                    <h4 class="mb-3">Responsibility</h4>
                    <p><?php echo $respo; ?></p>                    
                    <h4 class="mb-3">Qualifications</h4>
                    <p><?php echo $qual; ?></p>                    

                    <p></p>
                    
                </div>
                <div class="col-lg-4">
                <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Job Summery</h4>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Published On: <?php echo $date; ?></p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Vacancy: 123 Position</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: <?php echo $jobNature; ?></p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Salary: NRs <?php echo $minSalary; ?> - NRs <?php echo $maxSalary; ?></p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Location: <?php echo $jobAddress; ?></p>
                    
                </div>
                <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Company Detail</h4>
                    <?php echo $companydetail; ?>
                </div>
            </div>

<div class="">
    <h4 class="mb-4">Apply For The Job</h4>
    <form action="job-detail.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="company_id" value="<?php echo $companyId; ?>">

        <div class="row g-3">

            <div class="col-12 col-sm-6">
                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
            </div>
            <div class="col-12 col-sm-6">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
            </div>
            <div class="col-12 col-sm-6">
                <input type="file" class="form-control bg-white" name="resume" accept=".pdf, .txt, .doc, .docx" required>
            </div>
            <div class="col-12">
                <textarea class="form-control" rows="5" name="cover_letter" placeholder="Coverletter" required></textarea>
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Apply Now</button>
            </div>

        </div>
        <input type="hidden" name="jid" value="<?php echo htmlspecialchars($jobId); ?>">

    </form>
</div>
            <div class="col-lg-4">
                <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Job Summery</h4>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Published On: <?php echo $date; ?></p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Vacancy: 123 Position</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: <?php echo $jobNature; ?></p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Salary: NRs <?php echo $minSalary; ?> - NRs <?php echo $maxSalary; ?></p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Location: <?php echo $jobAddress; ?></p>
                    
                </div>
                <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Company Detail</h4>
                    <?php echo $companydetail; ?>
                </div>
            </div>
    </div>
</div>

        <!-- Job Detail End -->


        <?php include( '../common/footer.php') ?>
