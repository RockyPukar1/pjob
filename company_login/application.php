<?php
function getJobApplications($c_id) {
    $conn = new mysqli('localhost', 'root', '', 'login');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM job_applications WHERE company_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $c_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $jobApplications = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $jobApplications[] = $row;
        }
    }

    $stmt->close();
    $conn->close();

    return $jobApplications;
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include('common/head.php'); ?>

<body>
    <?php include('common/nav.php'); ?>
    <div class='container-xxl py-5'>
        <div class='container'>
            <h1 class='text-center mb-5 wow fadeInUp' data-wow-delay='0.1s'>Job Applications</h1>

            <?php
            if (isset($_GET['c_id'])) {
                $c_id = $_GET['c_id'];

                $jobApplications = getJobApplications($c_id);

                if (!empty($jobApplications)) {
                    echo '<table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Application ID</th>
                                    <th>User ID</th>
                                    <th>Job ID</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Cover Letter</th>
                                    <th>Resume Filename</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

                    foreach ($jobApplications as $application) {
                        $applicationId = $application['application_id'];
                        echo "<tr>
                                <td>{$application['application_id']}</td>
                                <td>{$application['user_id']}</td>
                                <td>{$application['job_id']}</td>
                                <td>{$application['a_name']}</td>
                                <td>{$application['email']}</td>
                                <td>{$application['cover_letter']}</td>
                                <td>{$application['resume_filename']}</td>
                                    
                                
                            
                          
                              </tr>";
                    }

                    echo '</tbody></table>';
                } else {
                    echo "No job applications found for company with c_id $c_id.";
                }
            }
            ?>
        </div>
    </div>



    <?php include('../common/footer.php'); ?>
