<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";  // عادةً ما يكون السيرفر المحلي هو "localhost"
$username = "root";         // اسم المستخدم الافتراضي لـ XAMPP هو "root"
$password = "";             // عادةً ما تكون كلمة المرور الافتراضية فارغة في XAMPP
$dbname = "test_car";  // تأكد من استخدام اسم قاعدة البيانات الصحيح

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق مما إذا تم استقبال قيمة "product_name"
if (isset($_GET['delete_product_name'])) {
    // استقبال قيمة "product_name" من الرابط
    $product_name = $_GET['delete_product_name'];

    // عمل الاستعلام لحذف الصف المرتبط بقيمة "product_name"
    $sql = "DELETE FROM cartt WHERE product_name = '$product_name'";

    // تنفيذ الاستعلام
    if ($conn->query($sql) === TRUE) {
        header("Location: cart.php");
        exit();
    } else {
        echo "حدث خطأ أثناء محاولة حذف الصف: " . $conn->error;
    }
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
