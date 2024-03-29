			
<?php
// Start or resume a session
session_start();

// Check if the page was reloaded
if (isset($_SESSION['page_load_count'])) {
    $_SESSION['page_load_count']++;

    // If reloaded, clear and destroy the session
    if ($_SESSION['page_load_count'] > 1) {
        if(!(isset($_SESSION["login"]) && $_SESSION["login"] == "true")){
            session_unset();
            session_destroy();
        }
    }
} else {
    // Initialize page load count
    $_SESSION['page_load_count'] = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in & Sign up Form</title>
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Sign In Form -->
                <form id="signForm" method="post" action="../php/login.php" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" id="Email" name="Email" placeholder="Email" onkeyup='emailCheck();'/>
                    </div>
                    <div id="emailMessgage"></div>
                    <?php
                        if ((isset($_SESSION["login"]) && $_SESSION["login"] == "true") && 
                            (isset($_SESSION["userExist"]) && $_SESSION["userExist"] != "true")) {
                            echo "<div id='invalidUsername' style='color:red; text-align:center;'>Username Invalid.</div>";
                        }
                    ?>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="pswd" name="Password" placeholder="Password"  onkeyup='passwordCheck();' required>
                    </div>
                    <div id="passwordMessgage"></div>
                    <?php
                        if (isset($_SESSION["passwordExist"]) && $_SESSION["passwordExist"] == "false") {
                            echo "<div id='invalidPassword' style='color:red; text-align:center;'>Password Invalid.</div>";
                        }
                    ?>
                    <input type="submit" value="Login" class="btn solid" />
                    <p class="social-text">Or Sign in with social platforms</p>
                    <div class="social-media">
                        <a href="https://www.facebook.com" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.google.com" class="social-icon"><i class="fab fa-google"></i></a>
                        <a href="https://www.linkedin.com" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </form>

                <!-- Sign Up Form -->
                <form id="signUpForm" method="post" class="sign-up-form" action="../php/register.php">
                    <h1 class="title">Sign up</h1>
                    <div class="input-field name-fields">
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" required />
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required />
                    </div>
                    <div class="input-field name-fields">
                        <input type="email" id="email" name="email" placeholder="Email"/>
                        <input type="text" id="phone" name="phone" placeholder="Phone Number" title="Must be 10 digits" pattern="[1-9]{1}[0-9]{9}" required />
                    </div>
					<div class="input-field" style="display: flex; justify-content: space-around; margin: 0; height: 10px;">
                        <div id="email_error"></div>
                        <div id="phone_error"></div>        
                    </div>
                    <div class="span-pos input-field name-fields">              
                        <input name="password" id="password" type="password"  placeholder="password"  required onkeyup='check();'  />                 
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="confirm-password" required onkeyup='check();' /> 
                        <span class="error_msg" id="message"></span>
                    </div>
                    <div id="password_msg"></div>

                    <div class="input-field name-fields">     
                        <input type="text" id="address" name="address" placeholder="Address" required />
                        <input type="text" id="postal_code" name="postal_code" placeholder="Postal Code" required />  
                    </div>
                    <div class="input-field input-dropdown">
                        <input type="text" placeholder="DOB" id="datepicker" name="datepicker" required>  

                        <select name="mySelect" id="mySelect">
                            <option value="">Gender</option>
                            <option value="male">MALE</option>
                            <option value="female">FEMALE</option>
                            <option value="other">Prefer Not to say</option>     
                        </select>
                    </div>
                    <div id="gender_error"></div>

                    <input type="submit" class="btn" value="Sign up" />
                    <p class="social-text">Or Sign up with social platforms</p>
                    <div class="social-media">
                        <a href="https://www.facebook.com" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.twitter.com" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.gmail.com" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="https://www.linkedin.com" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <!--Left Rigtt Pannel for Animation -->
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h1>New here?</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button type="submit" class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h1>One of us?</h1>
                    <p>Please login with your personal info</p>
                    <button type="submit" class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/login.js"></script>
</body>
</html>