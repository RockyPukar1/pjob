<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    
    <link rel="stylesheet" href="fonts/css/all.css">
    <link rel="stylesheet" href="homepage.css">
    
</head>
<body>
<div class="back">    
        

        <div class="container">
            <div class="content">
                        <h1 class="logo1">PINJOB </h1><br><br>
                    
                        <div class="text1">
                            <h2>Welcome! <br> <span>TO   PINJOB </span></h2>
                        </div>

                        <p> A perfect place to find job.</p>

                        <div class="social-item">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-google"></i></a>
                        </div>                   
            </div>

                <div class="log-box">
                    <div class="form-box login">
                        <form action="" method="post">
                            <h2>Sign in</h2>
                            <div class="input-box">
                                <span class="icon"><i class="fa-solid fa-user"></i></span>                
                                <input type="text" class="input"  name="username" > 
                                <label for="username">Username</label>               
                            </div>
                            <div class="input-box"> 
                                <span class="icon"> <i class="fa-solid fa-lock"></i></span>            
                                <input type="password" class="input" name="password" >
                                <label for="password">Password</label>   
                            </div>
                            <div class="remember-forgot">
                                <label><input type="checkbox">Remember me</label>
                                <a href="#">Forgot password?</a>
                            </div>
                            <div class="submit">
                                <input type="submit" class="btn" value="Sign in"  name="login_user">
                            </div>
                            <div class="login-register">
                                <p>Don't have an account? <a href="#" class="register-link">Sign up</a></p>
                            </div>
                        </form> 
                    </div>

                    <div class="form-box register">
                        <form method="" action="">                           
                            <h2>Sign Up </h2>
                            <div class="input-box">
                                <span class="icon"><i class="fa-solid fa-user"></i></span>                
                                <input type="text" class="input" name="username"  required> 
                                <label for="username">Username</label>               
                            </div>
                            <div class="input-box">
                                <span class="icon"><i class="fa-regular fa-envelope"></i></span>                
                                <input type="email" class="input" name="email" required> 
                                <label for="email">email</label>               
                            </div>
                            <div class="input-box"> 
                                <span class="icon"> <i class="fa-solid fa-lock"></i></span>            
                                <input type="password" class="input" name="password" required>
                                <label for="password">Password</label>   
                            </div>
                            <div class="input-box"> 
                                <span class="icon"> <i class="fa-solid fa-lock"></i></span>            
                                <input type="password" class="input" name="cpassword" required>
                                <label for="contact no.">Confirm Password</label>   
                            </div>
                            <div class="remember-forgot">
                                <label><input type="checkbox" required>I agree to the terms & conditions.</label>
                                
                            </div>
                            <div class="submit">
                                <button type="submit" name="save" class="btn">Signup</button>
                            </div>
                            <div class="login-register">
                                <p>Already have an account? <a href="#" class="login-link">Sign in</a></p>
                            </div>
                        </form> 
                    </div> 

                </div>

        </div>
</div>  

    <script src="homepage.js"></script>
</body>
</html>