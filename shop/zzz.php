<!DOCTYPE html>
<html lang="en">

<head>
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
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_car";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استعلام لجلب بيانات المنتجات مع مجموع الأسعار
$sql = "
SELECT 
    cartt.product_name, 
    cartt.product_price, 
    cartt.total, 
    cartt.quantity, 
    products.image_path,
    (SELECT SUM(total) FROM cartt) AS total_price_sum
FROM 
    cartt
INNER JOIN 
    products 
ON 
    cartt.product_name = products.product_name;
";

$result = $conn->query($sql);

// متغير لتخزين مجموع السعر
$total_price_sum = 0;
$delivery= 10;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_price_sum = $row["total_price_sum"];
    $result->data_seek(0); // إعادة مؤشر النتيجة إلى الصف الأول
}
?>


        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block"></div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a class="navbar-brand" href="index.html">
                        <div class="logo-image">
                              <img src="img/logo-web.jpg" class="img-fluid">
                        </div>
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.html" class="nav-item nav-link"><span class="cairo-normal">الصفحة الرئيسية</span></a>
                            <a href="shop.html" class="nav-item nav-link"><span class="cairo-normal">المتجر</span></a>
                            <a href="cart.html" class="nav-item nav-link active"><span class="cairo-normal">سلة التسوق</span></a>
                            <a href="chackout.html" class="nav-item nav-link"><span class="cairo-normal">الدفع</span></a>
                            <a href="contact.html" class="nav-item nav-link"><span class="cairo-normal">للتواصل مع فريق العمل</span></a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6"><span class="cairo-normal">أهلا بكم فى سلة التسوق     </span></h1>
         
        </div>
        <!-- Single Page Header End -->

        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><span class="cairo-bold">   صورة المنتج   </span></th>
                            <th scope="col"><span class="cairo-bold">اسم المنتج</span></th>
                            <th scope="col"><span class="cairo-bold">سعر المنتج</span></th>
                            <th scope="col"><span class="cairo-bold">كمية المنتج</span></th>
                            <th scope="col"><span class="cairo-bold">الاجمالى</span></th>
                            <th scope="col"><span class="cairo-bold">حذف</span></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<th scope="row">
                <div class="d-flex align-items-center">
                    <img src="' . $row["image_path"] . '" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                </div>
              </th>';
        echo '<td>
                <p class="mb-0 mt-4"><span class="cairo-bold">' . $row["product_name"] . '</p>
              </td>';
        echo '<td>
                <p class="mb-0 mt-4"><span class="cairo-bold">' . $row["product_price"] . ' ريال</p>
              </td>';
        echo '<td>
                <div class="input-group quantity mt-4" style="width: 100px;">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control form-control-sm text-center border-0 quantity-input" value="' . $row["quantity"] . '" data-price="' . $row["product_price"] . '" data-name="' . $row["product_name"] . '">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
              </td>';
        echo '<td>
                <p class="mb-0 mt-4 total-price"><span class="cairo-bold">' . $row["total"] . ' ريال</p>
              </td>';
        echo '<td>';
        if(isset($row['product_name'])) {
            echo '<a href="delete_row.php?delete_product_name=' . $row['product_name'] . '" class="btn btn-md rounded-circle bg-light border mt-4">';
            echo '    <i class="fa fa-times text-danger"></i>';
            echo '</a>';
        } else {
            echo 'اسم المنتج غير متوفر';
        }
        echo '</td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found.</td></tr>";
}
$conn->close();
?>
                        </tbody>
                    </table>
                </div>
                <div class="center-div" style=" margin-left: 40%;">
    <button type="button" id="updateButton" class="btn border-secondary rounded-pill px-4 py-3 text-primary">
        <span class="cairo-normal">تحديث الكمية</span>
    </button>
</div>
                <div class="mt-5">
        <form method="POST" action="">
            <input type="text" name="discount_code" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="ادخل كود الخصم">
            <button type="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary">
                <span class="cairo-normal">تطبيق الخصم</span>
            </button>
        </form>
    </div>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test_car";

    // إنشاء الاتصال
    $conn = new mysqli($servername, $username, $password, $dbname);

    // التحقق من الاتصال
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // قيمة الشحن
    $delivery = 10;

    // التحقق من إرسال كود الخصم
    if (isset($_POST["discount_code"]) && !empty($_POST["discount_code"])) {
        $discount_code = $conn->real_escape_string($_POST["discount_code"]);

        // الحصول على قيمة الخصم بناءً على اسم الخصم المدخل
        $discount_sql = "SELECT number FROM copoun WHERE name = '$discount_code'";
        $discount_result = $conn->query($discount_sql);

        if ($discount_result->num_rows > 0) {
            $discount_row = $discount_result->fetch_assoc();
            $discount_percentage = (double)$discount_row["number"];

            // حساب مجموع الأسعار من جدول cartt
            $total_sql = "SELECT SUM(total) AS total_price_sum FROM cartt";
            $total_result = $conn->query($total_sql);
            $total_row = $total_result->fetch_assoc();
            $total_price_sum = (double)$total_row["total_price_sum"];

            // حساب القيمة بعد الخصم
            $new_total_price_sum = $total_price_sum - ($total_price_sum * $discount_percentage / 100);

            // عرض النتيجة بعد الخصم وإضافة قيمة الشحن
            $result_message_with_discount = " ريال " . ($new_total_price_sum);
            $result_message_with_discount_delvery =  " ريال " .($new_total_price_sum)+$delivery;

            $result_message_without_discount = "إجمالي السعر بدون خصم مع الشحن: ريال " . ($total_price_sum + $delivery);

        } else {
            $result_message = "كود الخصم غير صالح.";
        }
    } else {
        // إذا لم يتم إدخال كود الخصم، احتساب إجمالي السعر بشكل عادي
        $total_sql = "SELECT SUM(total) AS total_price_sum FROM cartt";
        $total_result = $conn->query($total_sql);
        $total_row = $total_result->fetch_assoc();
        $total_price_sum = (double)$total_row["total_price_sum"];

        // إضافة قيمة الشحن
        $total_price_sum += $delivery;

        // عرض النتيجة بدون خصم
        $result_message = "إجمالي السعر مع الشحن: ريال " . $total_price_sum;

        // عرض النتيجة بدون خصم وإضافة قيمة الشحن
  
    }

    $conn->close();
}
?>
    

    <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4" dir="rtl">
                                <h1 class="display-6 mb-4"><span class="cairo-normal">مجموع    </span> <span class="fw-normal"><span class="cairo-normal">السلة     </span></span></h1>
                                <div class="d-flex justify-content-between mb-4" dir="rtl">
                                    <h5 class="mb-0 me-4"><span class="cairo-normal">مجموع المنتجات :   </span> </h5>

                                    <p class="mb-0"> <span class="cairo-normal">ريال    </span> <?php echo $total_price_sum; ?></p>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4"><span class="cairo-normal">بعد الخصم :   </span> </h5>
                                    <div>
        <?php if (isset($result_message_with_discount)) : ?>
            <p class="cairo-bold-yellow"> تم خصم %  <?php echo  $discount_percentage; ?></p>
        <?php endif; ?>
    </div>

                                    <div>
        <?php if (isset($result_message_with_discount)) : ?>
            <p class="cairo-normal">   <?php echo $result_message_with_discount; ?></p>
        <?php endif; ?>
    </div>
                                </div>
                              
                                <div class="d-flex justify-content-between ">
                                    <h5 class="mb-0 me-4"><span class="cairo-normal">التوصيل </span> </h5>
                                    <div class="">
                                    <p class="cairo-normal">ريال 10</p>
                                    
                                    </div>
                                </div>
                                <p class="mb-0 text-end"> <span class="cairo-bold-yellow">تضاف الى قيمة الفاتورة    </span>  </p>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between align-items-center" dir="rtl">
        <h5 class="mb-0 ps-4 me-4"><span class="cairo-normal">الاجمالى : </span></h5>
        <div class="center-div2" style="  margin-left: 10%;">
            <?php if (isset($total_price_sum)) : ?>
                <?php if (isset($result_message_with_discount)) : ?>
                    <p class="cairo-bold"><span class="cairo-bold-yellow">المجموع بعد الخصم :</span><?php echo $result_message_with_discount_delvery ?></p>
                <?php else : ?>
                    <p class="cairo-normal">ريال <?php echo ($total_price_sum) +$delivery; ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
                        <a href=" chackout.php"> <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button"><span class="cairo-bold">    الذهاب الى الدفع </span>  </button></a>    
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- Cart Page End -->
 <!-- Footer Start -->
 <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(255, 191, 0, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-primary mb-0"><span class="cairo-bold-yellow">  كاروت   </span> </h1>
                                <p class="text-secondary mb-0"> <span class="cairo-bold-green">  متجر الكترونى   </span></p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mx-auto">
                              
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-whatsapp"></i></a>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3"dir="rtl"><span class="cairo-bold">  لماذا تستخدم موقعنا ؟     </span></h4>
                            <p class="mb-4" dir="rtl"><span class="cairo-bold">  امكانية استبدال المنتجات مع وجود عدة عروض تتاح فى معظم الأوقات   </span></p>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6"dir="rtl">
                        <div class="d-flex flex-column text-start footer-item"dir="rtl">
                            <h4 class="text-light mb-3"dir="rtl"><span class="cairo-bold"dir="rtl">     معلومات عن الموقع   </span></h4>
                            <a class="btn-link" href="index.html"><span class="cairo-bold"dir="rtl">      الصفحة الرئيسية       </span></a>
                            <a class="btn-link" href="contact.html"><span class="cairo-bold"dir="rtl">      للتواصل مع فريق العمل    </span></a>

                            
                        </div>
                    </div>
                 
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3"><span class="cairo-bold"dir="rtl">      للتواصل مع  المتجر    </span></h4>
                            <p><span class="cairo-bold"dir="rtl">      العنوان : 123 , المملكة العربية السعودية   </span></p>
                            <p><span class="cairo-bold"dir="rtl"> التليفون : 070055153966 , 7977377059    </span></p>
                     

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="index.html"><i class="fas fa-copyright text-light me-2"></i>CARROT
                        </a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom" href="https://wa.me/201065583199?text=">abdallah shoker
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
document.getElementById("updateButton").addEventListener("click", function() {
    // توجيه المستخدم إلى الصفحة الجديدة عند الضغط على الزر
    window.location.href ="cart.php";
});
</script>
    <script>
        $(document).ready(function() {
            $('.btn-plus, .btn-minus').off('click');  // إزالة الأحداث المرتبطة سابقا

            $('.btn-plus').on('click', function() {
                var $input = $(this).parent().siblings('.quantity-input');
                var quantity = parseInt($input.val());
                var price = $input.data('price');
                var productName = $input.data('name');
                var newQuantity = quantity + 1;
                $input.val(newQuantity);
                var newTotal = newQuantity * price;
                $(this).closest('tr').find('.total-price').text(newTotal + ' $');
                updateCart(productName, newQuantity);
            });

            $('.btn-minus').on('click', function() {
                var $input = $(this).parent().siblings('.quantity-input');
                var quantity = parseInt($input.val());
                if (quantity > 1) {
                    var price = $input.data('price');
                    var productName = $input.data('name');
                    var newQuantity = quantity - 1;
                    $input.val(newQuantity);
                    var newTotal = newQuantity * price;
                    $(this).closest('tr').find('.total-price').text(newTotal + ' $');
                    updateCart(productName, newQuantity);
                }
            });

            function updateCart(productName, newQuantity) {
                $.ajax({
                    url: 'update_cart.php',
                    method: 'POST',
                    data: {
                        product_name: productName,
                        quantity: newQuantity
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    </script>

</body>

</html>
