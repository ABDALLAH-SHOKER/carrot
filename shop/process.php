<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_car";

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// الحصول على البيانات من النموذج
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$notes = $_POST['notes'];
$paymentMethod = $_POST['paymentMethod'];

$creditCardNumber = isset($_POST['creditCardNumber']) ? $_POST['creditCardNumber'] : null;
$creditCardExpiry = isset($_POST['creditCardExpiry']) ? $_POST['creditCardExpiry'] : null;
$creditCardCVC = isset($_POST['creditCardCVC']) ? $_POST['creditCardCVC'] : null;

// إعداد جملة SQL لإدراج البيانات في قاعدة البيانات
$sql = "INSERT INTO orders (name, address, phone, email, notes, paymentMethod, creditCardNumber, creditCardExpiry, creditCardCVC)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// إعداد البيان
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $name, $address, $phone, $email, $notes, $paymentMethod, $creditCardNumber, $creditCardExpiry, $creditCardCVC);

// تنفيذ جملة SQL
if ($stmt->execute() === TRUE) {
    echo "Order placed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// إغلاق الاتصال بقاعدة البيانات
$stmt->close();
$conn->close();
?>
