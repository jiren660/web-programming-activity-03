<?php
session_start();
if(!isset($_SESSION['product_data'])) {
    header("Location: index.php");
    exit;
}

$data = $_SESSION['product_data'];

// we format here the price and dateee
$formatted_price = number_format($data['price'], 2);
$formatted_date = date("M-d-Y", strtotime($data['expiration_date']));
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Product</title>
    <link rel="stylesheet" href="css/vpStyle.css">
</head>
<body>
    <div class="details-container">
        <img src="img/shopee.png" alt="Logo">
        <h2>Product Details</h2>
        <p><strong>Product Name:</strong> <?php echo htmlspecialchars($data['product_name']); ?></p>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($data['category']); ?></p>
        <p><strong>Price:</strong> ₱<?php echo $formatted_price; ?></p>
        <p><strong>Stock Quantity:</strong> <?php echo htmlspecialchars($data['stock_quantity']); ?></p>
        <p><strong>Expiration Date:</strong> <?php echo $formatted_date; ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($data['status']); ?></p>
        <a href="redirect.php">Continue</a>
    </div>
</body>
</html>
