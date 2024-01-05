<?php
session_start();

// Mang chu thong tin san phẩm
$products = array(
    array("id" => 1, "name" => "Ao Polo", "price" => 25),
    array("id" => 2, "name" => "Quan Jeans", "price" => 50),
    array("id" => 3, "name" => "Giày Sneakers", "price" => 40)
);

// Kiem tra neu gio hang chua duoc tao, thi tao moi
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Ham them san pham vao gio hang
function addToCart($productId)
{
    global $products;

    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            $_SESSION['cart'][] = $product;
            echo "Da them" . $product['name']. " vao gio hang." . "<br>";
            return;
        }
    }

    echo "San pham khong ton tai";
}

// Ham hien thi gio hang
function viewCart()
{
    if (empty($_SESSION['cart'])) {
        echo "Gio Hang trong";
    } else {
        echo "<h2>Gio hang cua ban: </h2>";
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $item) {
            echo $item['name'] . " - $" . $item['price'] . "<br>";
            $totalPrice += $item['price'];
        }

        echo "<strong>Tong gia tri: $" .@$totalPrice . "</strong>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>

    <h1>Trang mua sam PHP</h1>

<!--    Form them san pham vao gio hang-->
    <form method="post">
        <label for="productId">Chon San pham:</label>
        <select name="productId" id="productId">
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['id']; ?> ">
                                <?php echo $product['name']; ?>     - $<?php echo $product['price']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="addToCart">Them vao gio hang</button>
    </form>

<!--    Hien thi hio hang-->
    <?php
    if (isset($_POST['addToCart']) && isset($_POST['productId'])) {
        addToCart($_POST['productId']);
    }
    viewCart();
    ?>
</body>

</html>
