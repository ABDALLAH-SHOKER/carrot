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

// حذف المنتج إذا تم الضغط على زر الحذف
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_products.php");
    exit();
}

// استرجاع البيانات من قاعدة البيانات
$sql = "SELECT id, product_type, product_name, product_description, product_price, image_path FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <!-- إضافة Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
<div class="container mt-4">
    
    <div class="mt-12">
    <h2 style="text-align: center;">التحكم فى المنتجات</h2>
               <a href="../shop.php" class='btn btn-primary btn-sm' type="button"> <span class="cairo-bold"> الذهاب الى المتجر  </span></a>
               <a href="index.php" class='btn btn-primary btn-sm' type="button"> <span class="cairo-bold">  لاضافه منتج     </span></a>
  
           </div>
           <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Type</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["product_type"] . "</td>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td>" . $row["product_description"] . "</td>";
                    echo "<td>" . $row["product_price"] . "</td>";
                    echo "<td><img src='" . $row["image_path"] . "' width='50'></td>";
                    echo "<td>";
                    echo "<a href='edit_product.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>تعديل</a> ";
                    echo "<a href='manage_products.php?delete=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"متاكد من الحذف ؟\");'>حذف</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>لا يوجد منتجات لعرضها</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- إضافة مكتبة JavaScript الخاصة بـ Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
