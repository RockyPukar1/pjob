<?php include ('common/head.php') ?>

<body>
    <?php include ('common/navbar.php') ?>


    <!-- sign in box. -->
    <br>
    <div class="reg-box">
        <div class="form-box register">
            <form method="POST" action="connectcomp.php" enctype="multipart/form-data" onsubmit="return checkPasswords()">
                <h2 style="color: #00B074;"> Company <br>Sign up</h2>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="input" name="username" required>
                    <label for="username">Company name</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" class="input" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"> <i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="input" id="password" name="password" required>
                    <label for="password">Password</label>
                    <span class="toggle-password" style="color: gray;"
                        onclick="togglePasswordVisibility('password', 'eye-icon1')"><i
                            class="fa-solid fa-eye eye-icon1"></i></span>
                </div>

                <div class="input-box">
                    <span class="icon"> <i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="input" id="cpassword" name="cpassword" required>
                    <label for="cpassword">Confirm Password</label>
                    <span class="toggle-password" style="color: gray;"
                        onclick="togglePasswordVisibility('cpassword', 'eye-icon2')"><i
                            class="fa-solid fa-eye eye-icon2"></i></span>
                </div>

                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-map-marker"></i></span>
                    <input type="text" class="input" name="address" required>
                    <label for="address">Company Address</label>
                </div>
                <div class="logo-box">
                    <label for="logo" class="logo-label">Company Logo</label>
                    <span class="icon"><i class="fa-solid fa-upload"></i></span>
                    <input type="file" class="input" name="logo" accept="image/*" required>

                </div>
                <div class="description-box">
                    <label for="description" class="description-label">Company Description</label>
                    <span class="icon"><i class="fa-solid fa-align-left"></i></span>
                    <textarea class="input" name="description" required></textarea>

                </div>
                <div class="submit">
                    <button type="submit" name="save" class="btn1">Signup</button>
                </div>
                <div class="login-register">
                    <p>Already have an account? <a href="signincomp.php" class="login-link">Sign in</a></p>
                </div>
            </form>

        </div>
    </div>


    <!-- Sign up box. -->
    <script>
        function togglePasswordVisibility(inputField, iconClass) {
            var passwordInput = document.getElementById(inputField);
            var eyeIcon = document.querySelector("." + iconClass);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>


    <?php include ('common/footer.php') ?>