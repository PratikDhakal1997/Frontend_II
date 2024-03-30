<?php
// session_start();
include 'get_user.php';
if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    // Set the link URL and text based on the session variable
    $linkUrl = "#"; // Example link
    $linkText = "Welcome, " . htmlspecialchars($_SESSION["username"]);
    $profileLink = "php/profile.php";
} else {
    // Default link URL and text if the session variable is not set
    $linkUrl = "./php/login_register.php"; // Example link
    $linkText = "Login";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savoria - Your food tent</title>
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <style>
        .artdiv {
            padding: 5px;
            margin: 5px;
            background-color: #80ff80;
        }

        #editForm {
            display: none;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            text-transform: uppercase;
            cursor: pointer;
        }

        /* Hero section */
        .hero {
            background-color: #f9f9f9;
            padding: 50px 0;
            text-align: center;
        }

        /* Profile container */
        .container-profile {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Profile card */
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px #E23F58;
            padding: 30px;
        }

        /* Profile picture */
        .profile-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        /* Name */
        .name {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        /* Username */
        .username {
            font-size: 18px;
            color: #666;
            margin-bottom: 5px;
        }

        /* Edit button */
        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Form container */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Input labels */
        label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        /* Input fields */
        input[type="text"],
        input[type="password"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        /* Error message */
        .error-message {
            color: #d9534f;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 15px;
        }

        /* Submit button */
        #savebtn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #savebtn:hover {
            background-color: #0056b3;
        }

        /* Dropdown */
        .input-dropdown select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='%23212121'%3E%3Cpath d='M7 10l5 5 5-5H7z'/%3E%3C/svg%3E") no-repeat 95% 50%;
            background-size: 12px;
        }

        /* Logout button */
        #logoutbtn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            /* Added margin top for spacing */
        }

        #logoutbtn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="header__nav">
            <a class="header__brand" href="../index.php">
                <img src="../img/savoria-logo.svg" alt="Logo" />
            </a>
            <ul class="header__list">
                <li class="header__list-item">
                    <a href="../index.php">Home</a>
                </li>
                <li class="header__list-item">
                    <a href="../html/about.html">About</a>
                </li>
                <li class="header__list-item">
                    <a href="../html/contact.html">Contact</a>
                </li>
                <?php
                if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

                ?>
                    <li class="header__list-item active">
                        <a href="#">view profile</a>
                    </li>
                <?php
                }
                ?>
                <li class="header__list-item">
                    <a href="<?php echo $linkUrl; ?>"><?php echo $linkText; ?></a>
                </li>


            </ul>
        </nav>
    </header>
    <!-- close .header -->

    <?php
    if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

    ?>
        <section class="hero">
            <div class="container-profile">
                <div class="card">
                    <div class="">
                        <img src="../img/profile.png" class="profile-picture" alt="Profile Picture">
                    </div>
                    <p class="name"><?php echo $details['first_name'] ?> <?php echo $details['last_name'] ?></p>
                    <p class="username"> email: <?php echo $details['email']  ?> </p>
                    <p class="username">phone: <?php echo $details['phone'] ?></p>
                    <p class="username">address: <?php echo $details['address'] ?></p>
                    <p class="username">postal_code: <?php echo $details['postal_code'] ?></p>
                    <p class="username">dob: <?php echo $details['dob'] ?></p>
                    <p class="username">gender: <?php echo $details['gender'] ?></p>
                    <button id="editbtn" class="btn">Edit</button>
                    <a id="logoutbtn" href="logout.php" class="btno">Logout</a> <!-- Logout button added here -->

                </div>
            </div>
        </section>

        <div id="editForm">
            <form action="edit_profile.php" id="edit_profile" method="post">
                <input type="hidden" id="artid">
                <label for="firstname">Firstname:</label><br>
                <input type="text" id="firstname" name="firstname" value="<?php echo $details['first_name'] ?>" required><br>
                <div id="firstnameMessage"></div> <br>
                <label for=" lastname">Lastname:</label><br>
                <input type="text" id="lastname" name="lastname" value="<?php echo $details['last_name'] ?> " required><br>
                <div id="lastnameMessage"></div> <br>

                <label for="phone">Phone:</label><br>
                <input type="text" id="phone" name="phone" value="<?php echo $details['phone'] ?>" title="Must be 10 digits" pattern="[1-9]{1}[0-9]{9}" minlength="10" required><br>
                <div id="phoneMessage"></div> <br>
                <label for="address">Address:</label><br>
                <input type="text" id="address" name="address" value="<?php echo $details['address'] ?>" required><br>
                <div id="addressMessage"></div> <br>

                <input id="savebtn" type="submit" class="btn">
            </form>
        </div>





    <?php
    }
    ?>
    <footer class="footer">
        <div class="footer__items">
            <div class="footer__item">
                <img class="footer__item-brand" src="../img/savoria-logo-white.svg" alt="Logo" />
            </div>
            <div class="footer__item">
                <h3 class="footer__item-title">Contact</h3>
                <ul class="footer__item-list">
                    <li>
                        <address>265 Yorkland Blvd #400, North York, ON M2J 1S5</address>
                    </li>
                    <li><a href="mailto:contact@savoria.ca">contact@savoria.ca</a></li>
                    <li><a href="tel:+14164852098">+1 (416) 485-2098</a></li>
                </ul>
            </div>
        </div>
        <div class="footer__copyright">
            <p>Savoria&copy; 2023, all rights reserved</p>
        </div>
    </footer>
</body>

</html>

<script>
    $(document).ready(function() {


        $('.card').mouseenter(function() {


            $(this).animate({
                // Define the CSS properties you want to animate
                width: '700px', // Expand the width
                height: '600px', // Expand the height
                marginLeft: '50px', // Move the card to the right
                marginTop: '50px' // Move the card down
            }, 500); // Animation duration in milliseconds
        });

        $('.card').mouseleave(function() {
            $(this).animate({
                // Define the CSS properties you want to animate
                width: '500px', // Expand the width
                height: '400px', // Expand the height
                marginLeft: '50px', // Move the card to the right
                marginTop: '50px' // Move the card down
            }, 500); // Animation duration in milliseconds

        });
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd", // Set date format to YYYY-MM-DD
            changeYear: true, // Enable changing the year
            changeMonth: true, // Enable changing the month
            yearRange: "1950:2008" // Limit the year range from 1950 to 2008
        });

        $("button").click(function() {
            console.log('here');

            //open the edit form as a modal
            $("#editForm").dialog({
                title: "Edit Profile Details",
                width: 500,
                modal: true,
                // buttons: {
                //     "Save": function() {


                //     }
                // }
            });

            // Slide down animation to open the edit form
            $("#editForm").slideDown({
                duration: 500, // Animation duration in milliseconds
                easing: "swing", // Animation easing type
                complete: function() { // Optional callback function
                    // Focus on the first input field after animation completion
                    $("#firstname").focus();
                }
            });
        });

        $("#edit_profile").on("submit", function(e) {
            // Perform HTML5 validation check
            if (this.checkValidity()) {
                // Initialize jQuery validation
                $(this).validate({
                    rules: {
                        firstname: {
                            required: true,
                        },
                        lastname: {
                            required: true // Ensure a selection is made
                        },

                        phone: {
                            required: true,
                            minlength: 10
                        }

                    },
                    messages: {
                        firstname: {
                            required: "Please enter your firstname",
                        },
                        lastname: {
                            required: "Please select your gender"
                        },
                        phone: {
                            required: "Please enter a phone number.",
                            minlength: "Please enter at least 10 digits."
                        }

                    },
                    errorPlacement: function(error, element) {
                        // Custom placement for error messages
                        if (element.attr("name") == "email") {
                            error.appendTo("#email_error");
                        } else if (element.attr("name") == "mySelect") {
                            error.appendTo("#gender_error");
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });




                // Prevent form submission if validation fails
                if (!$(this).valid() || !check()) {
                    e.preventDefault();
                }
            } else {
                // Prevent form submission if HTML5 validation fails
                e.preventDefault();
            }

        });


    });

    // Function to validate email format
    var emailCheck = function() {
        var email = document.getElementById('Email').value;
        var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/; // Regex for email validation

        if (regex.test(email)) {
            document.getElementById('emailMessgage').innerHTML = '';
            return true;
        } else {
            document.getElementById('emailMessgage').style.color = 'red';
            document.getElementById('emailMessgage').innerHTML = 'Enter Valid Email Format';
            return false;
        }
    };

    // Function to validate password length
    var passwordCheck = function() {
        var password = document.getElementById('password').value;
        console.log(password)
        var regex = /^.{8,}$/; // Regex for minimum 8 characters

        if (regex.test(password)) {
            document.getElementById('passwordMessage').innerHTML = '';
            return true;
        } else {
            document.getElementById('passwordMessage').style.color = 'red';
            document.getElementById('passwordMessage').innerHTML = 'length should be 8 digit long';
            return false;
        }
    };
</script>