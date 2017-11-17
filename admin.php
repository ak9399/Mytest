<?php
include("Database.php")
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"charset="utf-8">
    <title>Admin-panel</title>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="#FFCCCC">
<form method="post" action="admin.php"enctype="multipart/form-data">
    <table width="700" align="center"border="1" bgcolor="white">
        <tr align="center">
            <td colspan="2"><h1>Insert new Product</h1></td>
        </tr>
        <tr>
            <td align="right"><b>Product Title</b></td>
            <td>
                <input type="text" name="product_title" size="50">
            </td>
        </tr>
        <tr>
            <td align="right"><b>Product Category</b></td>
            <td>
                <select name="product_cat">
                    <option>Select Catageory</option>


<?php
$sql = 'SELECT * FROM categories';
$dat = mysqli_query($con,$sql);
while ($row_cat = mysqli_fetch_array($dat))
{
    $cat_id =$row_cat['cat_it'];
    $cat_title =$row_cat['cat_title'];
    echo "<option value='$cat_id'>$cat_title</option>";
}
?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><b>Product Brand</b></td>
            <td>
                <select name="product_brand">
                    <option>Select Brand</option>
                    <?php
                    $sql = 'SELECT * FROM brands';
                    $dat = mysqli_query($con,$sql);
                    while ($row_brands = mysqli_fetch_array($dat))
                    {
                        $brand_id =$row_brands['brand_id'];
                        $brand_title =$row_brands['brand_title'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><b>Product Image1</b></td>
            <td>
                <input type="file" name="product_img1">
            </td>
        </tr>
        <tr>
            <td align="right"><b>Product Image2</b></td>
            <td>
                <input type="file" name="product_img2">
            </td>
        </tr>
        <tr>
            <td align="right"><b>Product Image3</b></td>
            <td>
                <input type="file" name="product_img3">
            </td>
        </tr>
        <tr>
            <td align="right"><b>Product Price</b></td>
            <td>
                <input type="text" name="product_price">
            </td>
        </tr>
        <tr>
            <td align="right"><b>Product Description</b></td>
            <td>
                <textarea name="product_desc" cols="50" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><b>Product Kaywords</b></td>
            <td>
                <input type="text" name="product_keywords">
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                <input type="submit" name="insert_product" value="Insert Product">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
if (isset($_POST['insert_product'])) {
    // text  data variables
    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $status = 'on';
    $product_keywords = $_POST['product_keywords'];

    // image names
    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];

    // image Temporary names
    $temp_name1 = $_FILES['product_img1']['tmp_name'];
    $temp_name2 = $_FILES['product_img2']['tmp_name'];
    $temp_name3 = $_FILES['product_img3']['tmp_name'];

    // validation form
    if ($product_title == '' OR $product_cat == '' OR $product_brand == '' OR $product_price == ''
        OR $product_desc == '' OR $product_keywords == '' OR $product_img1 == '' OR $product_img2 == '' OR $product_img3 == '')
    {
        echo "<script>alert('! fill all fields')</script>";
        exit();
    } else {
// uploading image to its folder
        move_uploaded_file($temp_name1,"product_images/$product_img1");
        move_uploaded_file($temp_name1,"product_images/$product_img2");
        move_uploaded_file($temp_name1,"product_images/$product_img3");
    }

    $insert_product = "INSERT INTO products(cat_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_desc,status)
VALUES('$product_cat','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$status')";
    $run_product = mysqli_query($con,$insert_product);
    if($run_product){
        echo "<script>alert('Product Inserted Successfully')</script>";
    }

}
?>