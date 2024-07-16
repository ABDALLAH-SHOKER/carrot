<?php
session_start(); // بدء الجلسة في بداية الملف

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_car";

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من وجود اسم المنتج و user_id في معامل GET
if (isset($_GET['product_name']) && isset($_GET['user_id'])) {
    $product_name = urldecode($_GET['product_name']);
    $user_id = intval($_GET['user_id']);  // الحصول على user_id من معامل GET
    addToCartByName($conn, $product_name, $user_id);
} else {
    echo "اسم المنتج أو معرف المستخدم غير موجود.";
}

$conn->close();

function addToCartByName($conn, $product_name, $user_id) {
    // استرجاع بيانات المنتج باستخدام اسم المنتج
    $sql = "SELECT * FROM products WHERE product_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $product_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // التحقق مما إذا كان المنتج موجودًا بالفعل في السلة لهذا المستخدم
        $sql_check_cart = "SELECT * FROM cartt WHERE product_id = ? AND user_id = ?";
        $stmt_check_cart = $conn->prepare($sql_check_cart);
        $stmt_check_cart->bind_param("ii", $product['id'], $user_id);
        $stmt_check_cart->execute();
        $result_check_cart = $stmt_check_cart->get_result();

        if ($result_check_cart->num_rows > 0) {
            // المنتج موجود بالفعل، زيادة الكمية
            $sql_update_cart = "UPDATE cartt SET quantity = quantity + 1 WHERE product_id = ? AND user_id = ?";
            $stmt_update_cart = $conn->prepare($sql_update_cart);
            $stmt_update_cart->bind_param("ii", $product['id'], $user_id);
            if ($stmt_update_cart->execute()) {
                header("Location: shop.php");
                exit();
            } else {
                echo "حدث خطأ أثناء تحديث كمية المنتج في السلة: " . $stmt_update_cart->error;
            }
        } else {
            // المنتج غير موجود، إدخاله في السلة
            $sql_insert_cart = "INSERT INTO cartt (product_id, product_name, product_price, product_description, image_path, total, quantity, user_id) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert_cart = $conn->prepare($sql_insert_cart);
            $total = $product['product_price']; // حساب المجموع
            $quantity = 1; // الكمية الابتدائية
            $stmt_insert_cart->bind_param("isdsdsii", $product['id'], $product['product_name'], $product['product_price'], $product['product_description'], $product['image_path'], $total, $quantity, $user_id);

            if ($stmt_insert_cart->execute()) {
                header("Location: shop.php");
                exit();
            } else {
                echo "حدث خطأ أثناء إضافة المنتج إلى السلة: " . $stmt_insert_cart->error;
            }
        }
    } else {
        echo "لم يتم العثور على المنتج.";
    }
}
?>
