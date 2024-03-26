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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- jQuery Modal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
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
                    <a href="#" type="button" class="button" id="openModal">Open Modal</button>
                </div>
            </div>
        </section>

        <!-- Modal HTML -->
        <div id="myModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Email</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="updateEmailForm" method="post" action="update_email.php">
                            <div class="form-group">
                                <label for="newEmail">New Email:</label>
                                <input type="email" class="form-control" id="newEmail" name="newEmail">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button to trigger modal -->





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