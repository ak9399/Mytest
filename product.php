<?php
include("Database.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <title>e-Store</title>
    <link rel="stylesheet" href="style.css" media="all">
</head>
<!-- 1:main header area start -->
<body>
<div class="main_wrapper">
    <div class="header_wrapper">
        <!-- 1.1:header area start -->
        <div id="b">
            <h1 style="background-color: white;">
                <a href="home.php">e-Store</a></h1>
        </div>
        <!-- creating form start-->
        <!-- 1.1:End -->
        <div class="f1">
            <form method="get" action="home.php" enctype="multipart/form-data" style="float: left;" >
                <input type="text" name="Search" style="width:500px; height:35px; border-radius:40px; border-color:red;">
                <input type="submit" name="submit" value="Search" style="height:40px; width:80px; border-radius:20px; background-color:#FF9966;">
            </form>
        </div>
    </div>


    <div id="navbar">
        <!-- 1.2:Navigation Area start -->
        <ul id="menu">
            <li><a href="home.php">Home</a></li>
            <li><a href="details.php">All Products</a></li>
            <li><a href="#">Sign Up</a></li>
            <li><a href="#">MyCart</a></li>
            <li><a href="#">My Account</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="search.php">Filter Search</a></li>

        </ul>

        <!-- 1.2:End -->
    </div>

    <div class="contant_wrapper">
        <!-- 1.3:Contant Area start -->
        <div id="right_contant1">
            <?php
            function cart()
            {
                if(isset($_GET['add_cart']))
                {
                    global $con;
                    $ip_add=getRealIpAddr();
                    $p_id=$_GET['add_cart'];
                    $check_pro ="SELECT * FROM cart WHERE ip_add = '$ip_add' AND p_id ='$p_id'";
                    $run_check =mysqli_query($con,$check_pro);
                    if(mysqli_num_rows($run_check)>0)
                    {
                        echo "";
                    }
                    else{
                        $q ="INSERT INTO cart(p_id,ip_add) VALUES ('$p_id','$ip_add')";
                        $run_q =mysqli_query($con,$q);
                    }
                }
            }
            ?>
            <div id="headline">
                <div id="headline_content">

                    <b>Welcome Guest</b>
                    <b style="color:white;">shopping cart:</b>
                    <span>- Items: - Price:</span>

                </div>
            </div>
            <div id="product_box1">
                <?php
                function getRealIpAddr()
                {
                    if(!empty($_SERVER['HTTP_CLIENT_IP']))
                        // check ip from share internet
                    {
                        $ip=$_SERVER['HTTP_CLIENT_IP'];
                    }
                    elseif (!empty($_SERVER['HTTP_X_FORWARD_FOR']))
                        // to check ip is pass from proxy
                    {
                        $ip=$_SERVER['HTTP_X_FORWARD_FOR'];
                    }
                    else{
                        $ip=$_SERVER['REMOTE_ADDR'];
                    }
                    return $ip;
                }
                echo getRealIpAddr();
                ?>
                <?php
                if(isset($_GET['pro_id'])) {
                    $product_id=$_GET['pro_id'];
                    $get_product = "SELECT * FROM products WHERE product_id ='$product_id'";
                    $run_product = mysqli_query($con, $get_product);
                    while ($row_products = mysqli_fetch_array($run_product)) {
                        $pro_id = $row_products['product_id'];
                        $pro_title = $row_products['product_title'];
                        $pro_cat = $row_products['cat_id'];
                        $pro_brand = $row_products['brand_id'];
                        $pro_desc = $row_products['product_desc'];
                        $pro_price = $row_products['product_price'];
                        $pro_image = $row_products['product_img1'];
                        echo "<div id='single_product'><h3>$pro_title</h3>
                    <img src='../admin_area/product_images/$pro_image' width='180' height='180'>
                    <br/>
                    <p><b>Price: &#8377; $pro_price </b></p>
                    <a href='cart.php?add_cart=$pro_id'><button>Add to Cart</button></a>
                    <p>$pro_desc</p>
                    
                    
                    </div>";
                    }
                }

                ?>

            </div>
        </div>


        <!-- 1.3:SEnd -->
    </div>
    <div class="footer">
        <!-- 1.4:Footer Are0a start -->
        <h5 style="color:black;text-align:center;">e-Store &#169; 2017</h5>
        <!-- 1.4: End -->
    </div>
</div>
<!-- 1:main header area End -->

</body>
</html>