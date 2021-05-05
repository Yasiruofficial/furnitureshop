<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sachini Furniture</title>
    <link rel="stylesheet" href="style.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,200&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

</head>

<body>

    <div class="header">
        <div class="container">

            <?php include_once("components/header.php");?>
            <?php include_once("src/functions.php");?>

            <div class="row">
                <div class="col-2">
                    <h1>
                        Design creates culture<br />
                        Culture shapes values<br /><br />
                        Values determine the <b>"FUTURE"</b>
                    </h1>
                    <p>
                        <b>Our mission</b> is to carefully design and manufacture furniture with respect for people,the
                        environment and the materials used
                    </p>
                    <a href="products.php" class="btn">Explore Now &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="images/image1.png" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!----- Featurd Categories--------->
    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="images/bf.jpg" alt="" />
                </div>
                <div class="col-3">
                    <img src="images/id.jpg" alt="" />
                </div>
                <div class="col-3">
                    <img src="images/wf.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!----- Featurd Products--------->
    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <div class="row">

            <?php getMostFamousProducts() ?>

        </div>
        <h2 class="title">Latest Products</h2>
        <div class="row">

            <?php getLatestProducts() ?>

        </div>
    </div>

    <!-------- Offer --------->

    <?php getMostFamousOne() ?>

    <!------ Testimonial  ------>
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>

                    <p>
                        All our dreams can come true, if we have the courage to pursue them
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img style="width:80px;" src="images/user.jfif" alt="" />
                    <h3>Sachini</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Brands -->

    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="images/damro.jpg" alt="" />
                </div>
                <div class="col-5">
                    <img src="images/arpico.png" alt="" />
                </div>
                <div class="col-5">
                    <img src="images/lionco.png" alt="" />
                </div>
                <div class="col-5">
                    <img src="images/ceylon.png" alt="" />
                </div>
                <div class="col-5">
                    <img src="images/cf.png" alt="" />
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->

    <?php include_once("components/footer.php");?>

    <!-- JS for Toggle menu -->
    <script>
    var MenuItems = document.getElementById("MenuItems");

    MenuItems.style.maxHeight = "0px";

    function menutoggle() {
        if (MenuItems.style.maxHeight == "0px") {
            MenuItems.style.maxHeight = "200px";
        } else {
            MenuItems.style.maxHeight = "0px";
        }
    }
    </script>
</body>

</html>