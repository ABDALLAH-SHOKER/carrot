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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // استرجاع بيانات المنتج المحدد
    $sql = "SELECT * FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات من النموذج
    $id = $_POST['id'];
    $product_type = $_POST['product_type'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    // تحديث بيانات المنتج في قاعدة البيانات
    $update_sql = "UPDATE products SET product_type=?, product_name=?, product_description=?, product_price=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssdi", $product_type, $product_name, $product_description, $product_price, $id);

    if ($stmt->execute()) {
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <!-- إضافة Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Product</h2>
    <form action="edit_product.php" method="post">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <div class="form-group">
            <label for="product_type">Product Type:</label>
            <select class="form-control" name="product_type" id="product_type" required>
                <option value="الخضروات" <?php if ($product['product_type'] == 'الخضروات') echo 'selected'; ?>>الخضروات</option>
                <option value="الفاكهة" <?php if ($product['product_type'] == 'الفاكهة') echo 'selected'; ?>>الفاكهة</option>
                <option value="منتجات محلية" <?php if ($product['product_type'] == 'منتجات محلية') echo 'selected'; ?>>منتجات محلية</option>
                <option value="منتجات مستوردة" <?php if ($product['product_type'] == 'منتجات مستوردة') echo 'selected'; ?>>منتجات مستوردة</option>
            </select>
        </div>
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $product['product_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <textarea class="form-control" name="product_description" id="product_description" required><?php echo $product['product_description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="product_price">Product Price:</label>
            <input type="number" step="0.01" class="form-control" name="product_price" id="product_price" value="<?php echo $product['product_price']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

<!-- إضافة مكتبة JavaScript الخاصة بـ Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
