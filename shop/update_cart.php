<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_car";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];

    // اجلب سعر المنتج
    $sql_price = "SELECT product_price FROM cartt WHERE product_name='$product_name'";
    $result = $conn->query($sql_price);
    $row = $result->fetch_assoc();
    $product_price = $row['product_price'];

    // حساب الإجمالي الجديد
    $total = $quantity * $product_price;

    // تحديث الكمية والإجمالي في قاعدة البيانات
    $sql_update = "UPDATE cartt SET quantity='$quantity', total='$total' WHERE product_name='$product_name'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
