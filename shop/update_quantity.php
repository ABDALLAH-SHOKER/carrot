<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// استيراد المتغيرات المرسلة عبر POST
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_car";

$conn = new mysqli($servername, $username, $password, $dbname);
$productName = $_POST['productName'];
$newQuantity = $_POST['quantity'];

// اتصال بقاعدة البيانات وتحديث الكمية للمنتج
// يفترض أن $conn هو الاتصال بقاعدة البيانات الخاصة بك
// يمكنك استخدام إمكانات mysqli أو PDO
$query = "UPDATE products SET quantity = '$newQuantity' WHERE product_name = '$productName'";
if ($conn->query($query) === TRUE) {
    echo "تم تحديث الكمية بنجاح!";
} else {
    echo "حدث خطأ أثناء تحديث الكمية: " . $conn->error;
}
?>
