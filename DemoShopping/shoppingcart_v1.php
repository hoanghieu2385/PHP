<?php

// Mang chu thong tin san pham
$products = array(
    array("id" => 1, "name" => "Ao Polo", "price" => 25),
    array("id" => 2, "name" => "Quan Jeans", "price" => 50),
    array("id" => 3, "name" => "Giay Sneakers", "price" => 40)
);

// Kiem tra neu gio hang chua duoc tao, thi tao moi
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Ham them san pham vao gio hang
function addToCart($productID)
{
    global $products;

    foreach ($products as $product) {
        if ($product['id'] == $productID) {
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

// Su dung cac ham de thuc hien cac chuc nang
addToCart( 1);
addToCart(2);
viewCart();

?>