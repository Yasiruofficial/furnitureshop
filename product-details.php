<?php 
    if(!isset($_REQUEST['id'])){
        header('location: products.php');
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Products - Sachini Furniture</title>
    <link rel="stylesheet" href="style.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,200&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

</head>

<body>
    <div class="container">

        <?php include_once("components/header.php");?>
        <?php include_once("src/functions.php");?>

    </div>

    <!-- Single Products Detail -->
    <div class="small-container single-product">

        <?php getProductById($_REQUEST['id']); ?>

    </div>

    <!-- Title -->
    <div class="small-container">
        <div class="row row-2">
            <h2>Related Products</h2>
            <p>View More</p>
        </div>
    </div>

    <!-- Similar Products -->

    <div class="small-container">
        <div class="row">
            <?php getRelatedProducts($_REQUEST['id']); ?>
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

    <!-- js for product gallery -->
    <script>
    var ProductImg = document.getElementById("ProductImg");
    var smallImg = document.getElementsByClassName("small-img");
    smallImg[0].onclick = function() {
        ProductImg.src = smallImg[0].src;
    };
    smallImg[1].onclick = function() {
        ProductImg.src = smallImg[1].src;
    };
    smallImg[2].onclick = function() {
        ProductImg.src = smallImg[2].src;
    };
    smallImg[3].onclick = function() {
        ProductImg.src = smallImg[3].src;
    };
    </script>

    <script>
    $(document).ready(function() {
        $("#addtocart_btn").click(function() {

            let qty = $("#addtocart_qty").val();
            let pid = $("#addtocart_id").val();

            var formData = new FormData();
            
            formData.append('addtocart', 'set');
            formData.append('pid', pid);
            formData.append('qty', qty);


            if (qty > 0) {

                $.ajax({
                    url: 'src/server.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response != 0) {
                            alert(response);
                       
                        } else {
                            alert('Error on adding');
                        }
                    },
                });
            } else {
                alert("Quantity should be grater than 0");
            }
           
        })
    });
    </script>

</body>

</html>