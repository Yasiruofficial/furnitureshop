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

    <!-- Cart Items Details -->
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php getCartItems() ?>

        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Total</td>
                    <td>$<span id="totalValueTag"></span></td>
                </tr>
                <tr>
                    <td></td>
                    <td><span href="" id="payment" class="btn">Request Order</span></td>

                </tr>
            </table>
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





<script>
$(document).ready(function() {


    function calculateTotal() {
        let total = 0;
        var inputs = $(".subtotals");

        for (var i = 0; i < inputs.length; i++) {
            total += parseFloat(inputs[i].innerHTML);
        }

        $("#totalValueTag").html(total);

    }

    calculateTotal();


    $(".remove_btn").click(function(e) {

        let pid = e.target.attributes.id.value;

        var formData = new FormData();

        formData.append('removefromcart', 'set');
        formData.append('pid', pid);


        $.ajax({
            url: 'src/server.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != 0) {
                    alert(response);
                    location.reload();
                } else {
                    alert('Error on deleting');
                    location.reload();
                }
            },
        });

    });



    $("#payment").click(function(e) {

        var formData = new FormData();
        formData.append('payment', 'set');

        $.ajax({
            url: 'src/server.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != 0) {
                    console.log(response);
                    alert(response);

                    location.reload();
                } else {
                    alert('Error on Payment');
                    location.reload();
                }
            },
        });

    });


    $(".addtocart_qty").keyup(function(e) {

        let subtotal = 0;
        let id = e.target.attributes.id.value;
        let value = this.value;

        var inputs = $(".addtocart_price");
        var outputs = $(".subtotals");

        for (var i = 0; i < inputs.length; i++) {
            if (id == inputs[i].id) {
                subtotal = value * parseFloat(inputs[i].innerHTML);

                for (var j = 0; j < outputs.length; j++) {
                    if (id == outputs[j].id) {
                        outputs[j].innerHTML = subtotal;
                        calculateTotal();
                    }
                }

            }
        }
    });


});
</script>