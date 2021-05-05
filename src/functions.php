<?php  


include('conn.php'); 

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}


?>


<!--  Get All Items -->
<?php 

function getAllProducts() {

   global $db;

    $query = "SELECT * FROM product ORDER BY id DESC LIMIT 12";
    $result = mysqli_query($db,$query);

    while($row = mysqli_fetch_assoc($result)){
      
      $back_path = explode("images",$row["img"]);
      

?>

<div class="col-4">
    <a href="product-details.php?id=<?php echo $row["id"]; ?>">
        <img src="<?php echo "images" . $back_path[1] ?>" alt="image" style="
                height:320px;
                object-fit: cover;
                " />
    </a>
    <h4><?php echo $row["name"]; ?></h4>
    <div class="rating">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
    </div>
    <p>$<?php echo $row["price"]; ?></p>
</div>

<?php

    }
}
?>



<!--  Get Item By Id -->

<?php 

function getProductById($id) {

   global $db;

    $query = "SELECT * FROM product where id=". $id ;
    $result = mysqli_query($db,$query);

    while($row = mysqli_fetch_assoc($result)){
      
      $back_path = explode("images",$row["img"]);
      

?>

<div class="row">
    <div class="col-2">

        <img src="<?php echo "images" . $back_path[1] ?>" width="100%" id="ProductImg" alt="image" style="
                height:500px;
                object-fit: cover;
                " />
    </div>
    <div class="col-2">
        <input id="addtocart_id" value="<?php echo $row["id"]; ?>" hidden></p>
        <p><?php echo $row["category"]; ?></p>
        <h2><?php echo $row["name"]; ?></h2>
        <h4>$<?php echo $row["price"]; ?></h4>

        <?php if (!$_SESSION['is_admin']) { ?>

            <input type="number" value="1" id="addtocart_qty" />
            <span href="" id="addtocart_btn" class="btn">Add to Cart</span>

        <?php } ?>



        <h3>Product Details<i class="fa fa-indent"></i></h3>
        <br />
        <p>
            <?php echo $row["description"]; ?>
        </p>
    </div>
</div>
<?php

    }
}
?>



<!--  Get Related Products -->

<?php 

function getRelatedProducts($id) {

   global $db;

    $query = "SELECT category FROM product where id=". $id;
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_assoc($result);
    $category = $row["category"];

    $query = "SELECT * FROM product where category='". $category . "' AND id<>".$id." ORDER bY id DESC LIMIT 4";
    $result = mysqli_query($db,$query);

    while($row = mysqli_fetch_assoc($result)){
      
      $back_path = explode("images",$row["img"]);
      

?>

<div class="col-4">
    <a href="product-details.php?id=<?php echo $row["id"]; ?>">
        <img src="<?php echo "images" . $back_path[1] ?>" alt="image" style="
                height:320px;
                object-fit: cover;
                " />
    </a>
    <h4><?php echo $row["name"]; ?></h4>
    <div class="rating">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
    </div>
    <p>$<?php echo $row["price"]; ?></p>
</div>

<?php

    }
}
?>



<!--  Get Cart Items -->

<?php 

function getCartItems() {

   global $db;

    foreach($_SESSION['cart'] as $key=>$value){

        $query = "SELECT * FROM product where id=". $key;
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_assoc($result);  
        $back_path = explode("images",$row["img"]);

        $total = $row["price"] * $_SESSION['cart'][$key];

?>

<tr>
    <td>
        <div class="cart-info">
            <img src="<?php echo "images" . $back_path[1] ?>" alt="image" />
            <div>
                <p><?php echo $row["name"]; ?></p>
                <small>Price: $<span class="addtocart_price"
                        id="<?php echo $row["id"];?>"><?php echo $row["price"]; ?></span></small>
                <br />
                <a id="<?php echo $row["id"]; ?>" class="remove_btn">Remove</a>
            </div>
        </div>
    </td>
    <td><input type="nunber" class="addtocart_qty" id="<?php echo $row["id"];?>"
            value="<?php echo $_SESSION['cart'][$key] ?>" /></td>

    <td>$<span class="subtotals" id="<?php echo $row["id"]; ?>"><?php echo $total;?></span></td>
</tr>

<?php

    }
}
?>




<!--  Get All Items -->
<?php 

function getMostFamousProducts() {

   global $db;

    $query = "SELECT *,SUM(qty),product_id FROM customer_product JOIN product on product.id =customer_product.product_id   GROUP BY product_id ORDER BY SUM(qty) DESC LIMIT 12";
    $result = mysqli_query($db,$query);

    while($row = mysqli_fetch_assoc($result)){
      
        $back_path = explode("images",$row["img"]);
?>


<div class="col-4">

    <a href="product-details.php?id=<?php echo $row["id"]; ?>">
        <img src="<?php echo "images" . $back_path[1] ?>" alt="image" style="
                height:320px;
                object-fit: cover;
                " />
    </a>

    <h4><?php echo $row["name"]; ?></h4>
    <div class="rating">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
    </div>
    <p>$<?php echo $row["price"]; ?></p>
    <p>Total sales : <?php echo $row["SUM(qty)"]; ?></p>
</div>


<?php

    }
}
?>




<!--  Get All Items -->
<?php 

function getMostFamousOne() {

   global $db;

    $query = "SELECT *,SUM(qty),product_id FROM customer_product JOIN product on product.id =customer_product.product_id   GROUP BY product_id ORDER BY SUM(qty) DESC LIMIT 1";
    $result = mysqli_query($db,$query);

    while($row = mysqli_fetch_assoc($result)){
      
        $back_path = explode("images",$row["img"]);
?>


<div class="offer">
    <div class="small-container">
        <div class="row">
            <div class="col-2">
                <img src="<?php echo "images" . $back_path[1] ?>" class="offer-img" alt="image" style="
                width:400px;
                height:320px;
                object-fit: cover;
                " />
            </div>
            <div class="col-2">
                <p>Exclusively available on Sachini Furniture </p>
                <h1><?php echo $row["name"]; ?></h1>
                <small><?php echo $row["description"]; ?></small><br />
                <a href="product-details.php?id=<?php echo $row["id"]; ?>" class="btn">Buy Now &#8594;</a>
            </div>
        </div>
    </div>
</div>


<?php

    }
}
?>




<!--  Get All Items -->
<?php 

function getLatestProducts() {

   global $db;

    $query = "SELECT * FROM product GROUP BY category ORDER BY id DESC";
    $result = mysqli_query($db,$query);

    while($row = mysqli_fetch_assoc($result)){
      
        $back_path = explode("images",$row["img"]);
?>


<div class="col-4">

    <a href="product-details.php?id=<?php echo $row["id"]; ?>">
        <img src="<?php echo "images" . $back_path[1] ?>" alt="image" style="
                height:320px;
                object-fit: cover;
                " />
    </a>

    <h4><?php echo $row["name"]; ?></h4>
    <div class="rating">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
    </div>
    <p>$<?php echo $row["price"]; ?></p>
    <p><?php echo $row["category"]; ?></p>
</div>


<?php

    }
}
?>




<!--  Get All Items -->
<?php 

function getAdminProducts() {



   global $db;

    $company_id = $_SESSION['id'];
    
    // $query = "SELECT *,SUM(qty),product_id FROM customer_product JOIN product on product.id =customer_product.product_id GROUP BY product_id ";
    $query = "SELECT * FROM product WHERE company_id = ".$company_id;
    $adminProducts = mysqli_query($db,$query);


    while($row = mysqli_fetch_assoc($adminProducts)){

        $query = "SELECT SUM(qty) FROM customer_product WHERE product_id=" . $row['id'] . " AND is_shipped = 0";
        $pendingorders = mysqli_query($db,$query);
        $pendingordersData = mysqli_fetch_assoc($pendingorders);

        $query = "SELECT SUM(qty) FROM customer_product WHERE product_id=" . $row['id'];
        $totalsale = mysqli_query($db,$query);
        $totalsaleData = mysqli_fetch_assoc($totalsale);

        $back_path = explode("images",$row["img"]);
?>


<tr>
    <td>
        <div class="cart-info">
            <img src="<?php echo "images" . $back_path[1] ?>" alt="image" />
            <div>
                <p><?php echo $row["name"]; ?></p>
                <small>Price: $<span class="addtocart_price"
                        id="<?php echo $row["id"];?>"><?php echo $row["price"]; ?></span></small>
                <br />

                <?php if($pendingordersData['SUM(qty)'] != 0){ ?>

                <a id="<?php echo $row["id"]; ?>" class="shiporder_btn">Ship Orders</a> |

                <?php } ?>

                <a id="<?php echo $row["id"]; ?>" class="removeitem_btn">Remove Item</a>
            </div>
        </div>
    </td>

    <td><?php echo $row["category"]; ?></td>
    <td><?php echo $pendingordersData['SUM(qty)'] == 0 ? 0 : $pendingordersData['SUM(qty)'] ?></td>
    <td><?php echo $totalsaleData['SUM(qty)'] == 0 ? 0 : $totalsaleData['SUM(qty)'] ?></td>

</tr>


<?php

    }
}
?>