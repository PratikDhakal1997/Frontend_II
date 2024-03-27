<?php
session_start();
include 'get_user.php';
if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    // Set the link URL and text based on the session variable
    $linkUrl = "index.php"; // Example link
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

        #editbtn {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            text-transform: uppercase;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="header__nav">
            <a class="header__brand" href="./index.html">
                <img src="../img/savoria-logo.svg" alt="Logo" />
            </a>
            <ul class="header__list">
                <li class="header__list-item active">
                    <a href="./index.html">Home</a>
                </li>
                <li class="header__list-item">
                    <a href="./html/about.html">About</a>
                </li>
                <li class="header__list-item">
                    <a href="./html/contact.html">Contact</a>
                </li>
                <li class="header__list-item">
                    <a class="header__list-item__cart" href="./html/cart/index.html">Cart <span class="header__list-item__cart-count">7</span></a>
                </li>
                <?php
                if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

                ?>
                    <li class="header__list-item">
                        <a href="<?php echo $profileLink; ?>">view profile</a>
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
                    <div class="profile-picture">
                        <img src="../img/profile.png" class="profile-picture" alt="Profile Picture">
                    </div>
                    <h2 class="name"><?php echo $details['first_name'] ?> <?php echo $details['last_name'] ?></h2>
                    <h3 class="username"> email: <?php echo $details['email']  ?> </h3>
                    <h3 class="username">phone: <?php echo $details['phone'] ?></h3>
                    <h3 class="username">address: <?php echo $details['address'] ?></h3>
                    <h3 class="username">postal_code: <?php echo $details['postal_code'] ?></h3>
                    <h3 class="username">dob: <?php echo $details['dob'] ?></h3>
                    <h3 class="username">gender: <?php echo $details['gender'] ?></h3>
                    <button id="editbtn" style="" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </section>

        <div id="editForm">
            <form>
                <input type="hidden" id="artid">
                <label for="firstname">firstname:</label><br>
                <input type="text" id="firstname" name="firstname" value="<?php echo $details['first_name'] ?>"><br>
                <label for=" lastname">lastname:</label><br>
                <input type="text" id="lastname" name="lastname" value="<?php echo $details['last_name'] ?>"><br>
                <label for="email">email:</label><br>
                <input type="text" id="email" name="email" value="<?php echo $details['email'] ?>"><br>
                <label for="phone">phone:</label><br>
                <input type="number" id="phone" name="phone" value="<?php echo $details['phone'] ?>"><br>
                <label for="address">address:</label><br>
                <input type="text" id="address" name="address" value="<?php echo $details['address'] ?>"><br>
                <label for="postalcode">postalcode:</label><br>
                <input type="text" id="postalcode" name="postalcode" value="<?php echo $details['postal_code'] ?>"><br>
                <label for="dob">dob:</label><br>
                <input type="text" id="dob" name="dob" value="<?php echo $details['dob'] ?>"><br>

                <label for="gender">gender:</label><br>
                <input type="text" id="gender" name="gender" value="<?php echo $details['gender'] ?>"><br>
            </form>
        </div>





    <?php
    }
    ?>
    <footer class="footer">
        <div class="footer__items">
            <div class="footer__item">
                <img class="footer__item-brand" src="./img/savoria-logo-white.svg" alt="Logo" />
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

        $("button").click(function() {
            console.log('here');

            //open the edit form as a modal
            $("#editForm").dialog({
                title: "Edit Profile Details",
                width: 500,
                modal: true,
                buttons: {
                    "Save": function() {
                        //send the edited values to the server
                        console.log('here')

                    }
                }
            });
        });
    });
</script>