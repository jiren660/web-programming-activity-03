<?php
session_start(); 

$product_name = $category = $price = $stock_quantity = $expiration_date = $status = "";
$product_name_error = $category_error = $price_error = $stock_quantity_error = $expiration_date_error = $status_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //here we sanitize the input data
    $product_name = trim(htmlspecialchars($_POST["product_name"] ?? ""));
    $category = trim(htmlspecialchars($_POST["category"] ?? ""));
    $price = trim(htmlspecialchars($_POST["price"] ?? ""));
    $stock_quantity = trim(htmlspecialchars($_POST["stock_quantity"] ?? ""));
    $expiration_date = trim(htmlspecialchars($_POST["expiration_date"] ?? ""));
    $status = trim(htmlspecialchars($_POST["status"] ?? ""));

    //we validate the inputs in this swction
    if (empty($product_name)) $product_name_error = "Product name is required";
    if (empty($category)) $category_error = "Category is required";
    if (empty($price) || !is_numeric($price) || $price < 0) $price_error = "Valid price is required";
    if (empty($stock_quantity) || !is_numeric($stock_quantity) || $stock_quantity < 0) $stock_quantity_error = "Valid stock is required";
    if (empty($expiration_date) || strtotime($expiration_date) < strtotime(date("Y-m-d"))) $expiration_date_error = "Valid future date is required";
    if (empty($status)) $status_error = "Status is required";

    // if there is no errors, then we store data in session then redirecf
    if (empty($product_name_error) && empty($category_error) && empty($price_error) &&
        empty($stock_quantity_error) && empty($expiration_date_error) && empty($status_error)) {
        
        $_SESSION['product_data'] = [
            'product_name' => $product_name,
            'category' => $category,
            'price' => $price,
            'stock_quantity' => $stock_quantity,
            'expiration_date' => $expiration_date,
            'status' => $status
        ];

        header("Location: viewproduct.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SHOPLIFTY - Product Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<!-- Difference between GET and POST:

GET shows the form data in the URL after you click submit.
POST hides the form data so it doesn’t show in the URL and is more secure. -->
<div class="title">
  <img src="img/shopee.png" alt="">
  <h1>SHOPLIFTY</h1>
</div>

<form action="" method="post">
    <label>Product Name: </label><br>
    <input type="text" name="product_name" value="<?php echo $product_name; ?>"><br>
    <p style="color:red;"><?php echo $product_name_error; ?></p>

    <label>Category: </label><br>
    <select name="category">
        <option value="">-- Select Category --</option>
        <option value="Category A" <?php if($category=="Category A") echo "selected"; ?>>Category A</option>
        <option value="Category B" <?php if($category=="Category B") echo "selected"; ?>>Category B</option>
        <option value="Category C" <?php if($category=="Category C") echo "selected"; ?>>Category C</option>
        <option value="Category D" <?php if($category=="Category D") echo "selected"; ?>>Category D</option>
    </select><br>
    <p style="color:red;"><?php echo $category_error; ?></p>

    <label>Price (₱):</label><br>
    <input type="number" name="price" step="0.01" value="<?php echo $price; ?>"><br>
    <p style="color:red;"><?php echo $price_error; ?></p>

    <label>Stock Quantity: </label><br>
    <input type="number" name="stock_quantity" min="0" value="<?php echo $stock_quantity; ?>"><br>
    <p style="color:red;"><?php echo $stock_quantity_error; ?></p>

    <label>Expiration Date: </label><br>
    <input type="date" name="expiration_date" value="<?php echo $expiration_date; ?>"><br>
    <p style="color:red;"><?php echo $expiration_date_error; ?></p>

    <label>Status: </label><br>
    <input type="radio" name="status" value="active" <?php if($status=="active") echo "checked"; ?>> Active<br>
    <input type="radio" name="status" value="inactive" <?php if($status=="inactive") echo "checked"; ?>> Inactive<br>
    <p style="color:red;"><?php echo $status_error; ?></p><br>

    <input type="submit" value="Save Product">
</form>
</body>
</html>
