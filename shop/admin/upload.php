<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_car";

$conn = new mysqli($servername, $username, $password, $dbname);

// تحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_type = $_POST['product_type'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    // تحقق من وجود اسم المنتج في قاعدة البيانات
    $sql = "SELECT * FROM products WHERE product_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $product_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // اسم المنتج موجود بالفعل، أرسل تنبيه
        echo "<script>alert(' اسم المنتج موجود بالفعل , اعد ادخال اسم جديد'); window.history.back();</script>";
    } else {
        // اسم المنتج غير موجود، قم بعملية التحميل
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $sql = "INSERT INTO products (product_type, product_name, product_description, product_price, image_path) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssds", $product_type, $product_name, $product_description, $product_price, $target_file);
        $stmt->execute();
        echo "<script>
        alert('تم إضافة المنتج بنجاح');
        window.location.href = 'index.php';
        </script>";
    }

    $stmt->close();
}

$conn->close();
?>
