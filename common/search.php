<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0" placeholder="Keyword" />
                            </div>
                                <?php
                                // Database connection
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "login";

                                // Create a database connection
                                $conn = mysqli_connect($servername, $username, $password, $dbname);

                                // Check the database connection
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                // Retrieve categories from the database
                                $categoryQuery = "SELECT * FROM `category`";
                                $categoryResult = mysqli_query($conn, $categoryQuery);

                                ?>

                                <div class="col-md-4">
                                    <select class="form-select border-0">
                                        <option selected>Category</option>
                                        <?php
                                        if (mysqli_num_rows($categoryResult) > 0) {
                                            while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                                                $categoryId = $categoryRow['id'];
                                                $categoryName = $categoryRow['cname'];

                                                echo "<option value='$categoryId'>$categoryName</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            <div class="col-md-4">
                                <select class="form-select border-0">
                                    <option selected>Location</option>
                                    <option value="1">Kathmandu</option>
                                    <option value="2">Lalitpur</option>
                                    <option value="3">Bhaktapur</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search End -->