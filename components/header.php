<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<style>
@keyframes example {
    from {
        margin: 0% auto;
    }

    to {
        margin: 5% auto;
    }
}

.add_product {
    width: 50%;
    margin: 0 auto;
}

.add_product_input {
    background-color: #ffe7e7;
    width: 100%;
    height: 30px;
    margin-top: 30px;
    border-radius: 4px;
    border: none;
    border-bottom: 1px solid black;

}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
}


.modal-content {
    border-radius: 10px;
    background-color: #ffe7e7;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;

    animation-name: example;
    animation-duration: 0.5s;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>


<?php 

if(session_status() == PHP_SESSION_NONE){
    //session has not started
    session_start();
} 
include('src/conn.php');

?>

<div class="navbar">
    <div class="logo">
        <a href="index.php">
            <img src="images/logo.png" alt="" width="125px" /></a>
    </div>
    <nav>
        <ul id="MenuItems">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>


            <?php if (isset($_SESSION['user_email'])) { ?>

            <?php if($_SESSION['is_admin']) { ?>

            <li><a href="adminproducts.php">My Products</a></li>
            <li id="myBtn"><img src="images/add.png" alt="" width="30px" height="30px" /></li>

            <?php } ?>

            <li><a href="src/server.php?logout=1">Logout</a></li>

            <?php  } else { ?>

            <li><a href="account.php">Login/Register</a></li>

            <?php  } ?>



            <!-- TODo: 22:20 -->
        </ul>
    </nav>

    <?php if (isset($_SESSION['user_email'])) { ?>

        <?php if (!$_SESSION['is_admin']) { ?>

            <a href="cart.php"><img src="images/cart.png" alt="" width="30px" height="30px" /></a>

        <?php } ?>

    <?php } ?>


    <img src="images/menu.png" alt="" class="menu-icon" onclick="menutoggle()" />
</div>




<!--Modal-->

<div id="myModal" class="modal">

    <div class="modal-content">
        <span class="close">&times;</span>

        <form id="form" class="add_product" method="post" enctype="multipart/form-data">
            <h2> ADD PRODUCTS </h2>
            <input type="text" class="add_product_input" name="name" placeholder="Name" id="add_product_name_id" /><br>
            <input type="text" class="add_product_input" name="description"  placeholder="Description"
                id="add_product_description_id" /><br>
            <select class="add_product_input" name="category" id="add_product_category_id">
                <option value="Living Room">Living Room</option>
                <option value="Bed room">Bed Room</option>
                <option value="Kitchen Room">Kitchen Room</option>
                <option value="Office Room">Office Room</option>
            </select>
            <input type="number" class="add_product_input" name="price" placeholder="Price" id="add_product_price_id" /><br>
            <input type="number" class="add_product_input" name="offer" placeholder="Offer" id="add_product_offer_id" /><br>
            <input type="number" class="add_product_input" name="iqty" placeholder="Initial Quantity" id="add_product_iqty_id" /><br>
            <input type="file" class="add_product_input" name="image" placeholder="Image" id="add_product_img_id" /><br>
            <input type="text" hidden name="product_add" value="set"/><br>
            <input type="submit" name="product_add" style="
                width:100%;
                margin-top:20px;
                background-color:#04aa6d;
                height:50px;
                border-radius:10px;
                color:white;
                font-weight: bold;
                font-size: 20px;
            "value="ADD"/>
        </form>
    </div>

</div>


<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<script>
$(document).ready(function() {

    $("#form").on('submit', (function(e) {
        e.preventDefault();

        let name = $('#add_product_name_id')[0].value;
        let description = $('#add_product_description_id')[0].value;
        let category = $('#add_product_category_id')[0].value;
        let price = $('#add_product_price_id')[0].value;
        let offer = $('#add_product_offer_id')[0].value;
        let iqty = $('#add_product_iqty_id')[0].value;
        let img = $('#add_product_img_id')[0].files;

        // Check file selected or not
        if (
            name != "" &&
            description != "" &&
            category != "" &&
            price != "" &&
            offer != "" &&
            iqty != "" &&
            img.length > 0
        ) {

            $.ajax({
                url: 'src/server.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        alert(response);
                        $("#form")[0].reset(); 
                    } else {
                        alert('file not uploaded');
                        $("#form")[0].reset();
                    }
                },
            });
        } else {
            alert("Please Fill all the Fields");
        }
    }));

});
</script>