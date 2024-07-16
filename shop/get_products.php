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
$dbname = "test_car";       // تأكد من استخدام اسم قاعدة البيانات الصحيح

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استرداد الفئة المحددة من الطلب
$category = $_GET['category'];

// استعلام SQL لاسترداد المنتجات بناءً على الفئة المحددة
$sql = "SELECT * FROM products WHERE product_type = '$category'";
$result = $conn->query($sql);
$count_query = "SELECT product_type, COUNT(*) AS count FROM products GROUP BY product_type";
$count_result = $conn->query($count_query);

// إنشاء عناصر HTML لعرض المنتجات
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="col-md-6 col-lg-6 col-xl-4">';
        echo '    <div class="rounded position-relative fruite-item">';
        echo '        <div class="fruite-img">';
        echo '            <img src="' . $row["image_path"] . '" class="img-fluid w-100 rounded-top" alt="">';
        echo '        </div>';
        echo '        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><span class="cairo-bold-black">' . $row["product_type"] . '</span></div>';
        echo '        <div class="p-4 border border-secondary border-top-0 rounded-bottom">';
        echo '            <h4><span class="cairo-bold">' . $row["product_name"] . '</span></h4>';
        echo '            <p><span class="cairo-bold">' . $row["product_description"] . '</span></p>';
        echo '            <p class="text-dark fs-5 fw-bold mb-0"><span class="cairo-bold">' . $row["product_price"] . ' كيلو / ريال</span></p>';
        echo '            <a href="add_to_cart.php?product_name=' . urlencode($row["product_name"]) . '" class="btn border border-secondary rounded-pill px-3 text-primary">';
        echo '                <i class="fa fa-shopping-bag me-2 text-primary"></i> <span class="cairo-bold">إضافة الى السلة</span>';
        echo '            </a>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo "لا توجد منتجات متاحة لهذه الفئة";
}
$conn->close();
?>
