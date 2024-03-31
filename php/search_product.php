<?php

// Start output buffering
ob_start();

// Include the file
include '../json/products.json';

// Get the contents of the buffer
$products = ob_get_contents();

// Clean (erase) the output buffer and turn off output buffering
ob_end_clean();

// Now $fileContent contains the contents of the included file

if (isset($_GET)) {
    $name = $_GET['name'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Savoria - Your food tent</title>
    <link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/main.css" />

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />

    <style>
        /* Styling for the container */


        /* Styling for the "No products found" message */
        .no-products-message {
            text-align: center;
            padding: 20px;
            background-color: #f8d7da;
            /* Red background color, you can change it */
            border: 1px solid #f5c6cb;
            /* Border color */
            color: #721c24;
            /* Text color */
            margin: 10px auto;
            /* Margin to center the message */
            width: 80%;
            /* Adjust width as needed */
            border-radius: 4px;
            /* Rounded corners */
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="header__nav">
            <a class="header__brand" href="../../index.php">
                <img src="../img/savoria-logo.svg" alt="Logo" />
            </a>
            <ul class="header__list">
                <li class="header__list-item"><a href="../index.php">Home</a></li>
                <li class="header__list-item">
                    <a href="../html/about.html">About</a>
                </li>
                <li class="header__list-item">
                    <a href="../html/contact.html">Contact</a>
                </li>

                <li class="header__list-item header__search">
                    <form action="../php/search_product.php" method="get">
                        <input type="text" placeholder="Search..." name="name" value="<?php echo isset($_GET) ? $_GET['name'] : ''  ?>" />
                        <button type="submit">Search</button>
                    </form>
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <!-- end .header -->
    <main class="main">
        <section class="container products">
            <h3 class="title"><span>Chilean food</span></h3>
            <div class="products__content">
                <div class="products__item">

                </div>
                <!-- end .products__item -->

            </div>

            <div class="no-products-message">
                <p>Sorry,No products found.</p>
            </div>


            <!-- end .products -->
        </section>
    </main>
    <!-- end .main -->
    <footer class="footer">
        <div class="footer__items">
            <div class="footer__item">
                <img class="footer__item-brand" src="../../img/savoria-logo-white.svg" alt="Logo" />
            </div>
            <!-- end .footer__item -->
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
            <!-- end .footer__item -->
        </div>
        <div class="footer__copyright">
            <p>Savoria&copy; 2023, all rights reserved</p>
        </div>
        <!-- end .footer__copyright -->
    </footer>
    <!-- end .footer -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js" integrity="sha512-C1zvdb9R55RAkl6xCLTPt+Wmcz6s+ccOvcr6G57lbm8M2fbgn2SUjUJbQ13fEyjuLViwe97uJvwa1EUf4F1Akw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- script to initialize magnify popup -->
    <script>
        $(document).ready(function() {
            $(".image-link").magnificPopup({
                type: "image",
            });
            var productsJson = <?php echo $products; ?>;
            var input_product_name = '<?php echo $name; ?>';
            console.log(typeof productsJson);

            $.each(productsJson.products, function(index, product) {

                var p_name = product.name;
                if (input_product_name == p_name) {
                    $('.no-products-message').hide();
                    var productHtml = `
                <div class="products__item">
                    <div class="products__item-main">
                    <div class="products__item-thumb">
                            <a class="image-link" href="../img/${product.imgSrc}">
                                <img class="img-responsive" src="../img/${product.imgSrc}" alt="${product.name}"/>
                            </a>
                            <h6 class="products__item-thumb__on-sale">On sale</h6>
                        </div>
                        <div class="products__item-main">
                            <h4 class="products__item-title">${product.name}</h4>
                            <p class="products__item-info">
                                <span class="price">${product.price}</span> -
                                <span class="units">${product.packaging}</span>
                            </p>
                            <div class="products__item-actions">
                                <a class="button button--white" href="../html/products/product-details.html">Read more</a>
                                <button class="button">Add to cart</button>
                            </div>
                        </div>
                        </div>
                    </div>`;
                } else {

                }

                $(".products__content").append(productHtml);
            });
        });
    </script>
</body>

</html>