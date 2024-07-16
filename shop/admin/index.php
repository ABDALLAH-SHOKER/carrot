<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Product</title>
    <!-- إضافة Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <title>carrot Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/img/logoo.ico">

</head>
<body>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

    <div class="container">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_type">اختار النوع</label>
                <select class="form-control" name="product_type" id="product_type" required>
                    <option value="الخضروات">الخضروات</option>
                    <option value="الفواكه">الفواكه</option>
                    <option value="منتجات محلية">منتجات محلية</option>
                    <option value="منتجات مستوردة">منتجات مستوردة</option>
                </select>
            </div>
            <div class="form-group">
                <label for="product_name">اسم المنتج</label>
                <input type="text" class="form-control" name="product_name" id="product_name" required>
            </div>
            <div class="form-group">
                <label for="product_description"> وصف المنتج</label>
                <textarea class="form-control" name="product_description" id="product_description" required></textarea>
            </div>
            <div class="form-group">
                <label for="product_price"> سعر المنتج</label>
                <input type="number" step="0.10" class="form-control" name="product_price" id="product_price" required>
            </div>
            <div class="form-group">
                <label for="image">  اختار صورة المنتج</label>
                <input type="file" class="form-control-file" name="image" id="image" required>
            </div>
            <button type="submit" class="btn btn-primary"> اضافه المنتج</button>
            <div class="mt-5">
               
                <a href="../shop.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button"> <span class="cairo-bold"> الذهاب الى المتجر  </span></a>
                <a href="manage_products.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button"> <span class="cairo-bold"> للتحكم فى المنتجات    </span></a>
    
            </div>
           
          

        </form>
        
    </div>

    <!-- إضافة مكتبة JavaScript الخاصة بـ Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
