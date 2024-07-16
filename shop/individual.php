<?php
session_start();

// التحقق من القيم المخزنة في الجلسة


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
$count_query = "SELECT product_type, COUNT(*) AS count FROM products GROUP BY product_type";
$count_result = $conn->query($count_query);
// Set number of items per page
$items_per_page = 12;

// Get the current page number from URL, default is 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Ensure the page number is at least 1

// Calculate the offset for SQL query
$offset = ($page - 1) * $items_per_page;

// Get total number of items
$total_items_result = $conn->query("SELECT COUNT(*) as count FROM products");
$total_items_row = $total_items_result->fetch_assoc();
$total_items = $total_items_row['count'];

// Calculate total number of pages
$total_pages = ceil($total_items / $items_per_page);

// Fetch items for the current page
$sql = "SELECT product_type, product_name, product_description, product_price, image_path FROM products LIMIT $offset, $items_per_page";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Carrot Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/img/logoo.ico">
    <style>
        .search-container {
        background-color: #f2f2f2;
        border-radius: 30px;
        padding: 10px 20px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 400px; /* تحديد أقصى عرض للبحث */
        margin: 0 auto; /* توسيط البحث على الشاشة */
    }

    .search-input {
        flex: 1;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 20px;
    }

    .search-icon {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 10px;
        margin-left: 10px;
        cursor: pointer;
    }

    .search-icon i {
        font-size: 20px;
    }

    #search-result {
        margin-top: 10px;
    }
        .fruite-item {
            height: 500px;
            overflow: hidden;
        }

        .fruite-img img {
            width: 250px; 
            height: 300px; 
            object-fit: cover;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .pagination .page-item .page-link {
            color: #007bff;
        }

        .pagination .page-item .page-link:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>

<!-- Spinner Start -->
<div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
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
                    <a href="../index.html" class="nav-item nav-link"><span class="cairo-normal">الصفحة الرئيسية</span></a>
                    <a href="shop.php" class="nav-item nav-link active"><span class="cairo-normal">المتجر</span></a>
                    <a href="cart.php" class="nav-item nav-link"><span class="cairo-normal">سلة التسوق</span></a>
                    <a href="../contact.html" class="nav-item nav-link"><span class="cairo-normal">للتواصل مع فريق العمل</span></a>
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
    <h1 class="text-center text-white display-6"><span class="cairo-normal">أهلا بكم فى المتجر</span></h1>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4"><span class="cairo-normal">منتجات كــاروت الطازجة</span></h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
             <div class="col-xl-3">
    <div class="search-container">
    <input type="search" id="search-input" class="form-control p-3" placeholder="ابحث ب اسم المنتج" aria-describedby="search-icon-1" onkeyup="searchFunction(this)">
<span id="search-icon-1" class="input-group-text p-3" onclick="clearSearch()"><i class="fa fa-times"></i></span>

    </div>
    <div id="search-result"></div> <!-- هنا سيتم عرض نتائج البحث -->
</div>
                    <div class="col-lg-12">
                        <div class="pagination d-flex justify-content-center mt-5">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>" class="rounded">&laquo;</a>
                            <?php endif; ?>
                            
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a href="?page=<?php echo $i; ?>" class="rounded <?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?>" class="rounded">&raquo;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3" >
                                    <h4><span class="cairo-bold">الانواع</span></h4>
                                    <ul class="list-unstyled fruite-categorie" dir="rtl">
        <li>
        <div class="d-flex justify-content-between fruite-name">
    <a href="#الخضروات">
        <i class="fas fa-carrot me-2"></i>
        <span></span>
        <span class="cairo-bold">الخضروات</span>
    </a>
    <?php
    // استعلام SQL لجلب عدد العناصر للفئة "الخضروات"
    $count_vegetables_query = "SELECT COUNT(*) AS count FROM products WHERE product_type = 'الخضروات'";
    $count_vegetables_result = $conn->query($count_vegetables_query);
    if ($count_vegetables_result->num_rows > 0) {
        while ($row = $count_vegetables_result->fetch_assoc()) {
            echo "<span>(" . $row["count"] . ")</span>";
        }
    }
    ?>
</div>
        </li>
        <li>
        <div class="d-flex justify-content-between fruite-name">
    <a href="#الفواكه">
        <i class="fas fa-apple-alt me-2"></i>
        <span></span>
        <span class="cairo-bold">الفواكه</span>
    </a>
    <?php
    // استعلام SQL لجلب عدد العناصر للفئة "الفواكه"
    $count_fruits_query = "SELECT COUNT(*) AS count FROM products WHERE product_type = 'الفواكه'";
    $count_fruits_result = $conn->query($count_fruits_query);
    if ($count_fruits_result->num_rows > 0) {
        while ($row = $count_fruits_result->fetch_assoc()) {
            echo "<span>(" . $row["count"] . ")</span>";
        }
    }
    ?>
</div>
        </li>
        <li>
        <div class="d-flex justify-content-between fruite-name">
    <a href="#منتجات محلية">
        <i class="fas fa-apple-alt me-2"></i>
        <span></span>
        <span class="cairo-bold">منتجات محلية</span>
    </a>
    <?php
    // استعلام SQL لجلب عدد العناصر للفئة "منتجات محلية"
    $count_local_products_query = "SELECT COUNT(*) AS count FROM products WHERE product_type = 'منتجات محلية'";
    $count_local_products_result = $conn->query($count_local_products_query);
    if ($count_local_products_result->num_rows > 0) {
        while ($row = $count_local_products_result->fetch_assoc()) {
            echo "<span>(" . $row["count"] . ")</span>";
        }
    }
    ?>
</div>
        </li>
        <li>
        <div class="d-flex justify-content-between fruite-name">
    <a href="#منتجات مستورده">
        <i class="fas fa-apple-alt me-2"></i>
        <span></span>
        <span class="cairo-bold">منتجات مستوردة</span>
    </a>
    <?php
    // استعلام SQL لجلب عدد العناصر للفئة "منتجات مستوردة"
    $count_imported_products_query = "SELECT COUNT(*) AS count FROM products WHERE product_type = 'منتجات مستوردة'";
    $count_imported_products_result = $conn->query($count_imported_products_query);
    if ($count_imported_products_result->num_rows > 0) {
        while ($row = $count_imported_products_result->fetch_assoc()) {
            echo "<span>(" . $row["count"] . ")</span>";
        }
    }
    ?>
</div>
        </li>
        <!-- Add other list items here -->
    </ul>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <h4>Filter by Price</h4>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1">
                                    <label class="btn btn-outline-primary" for="btnradio1"> $10</label>
                                    
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
                                    <label class="btn btn-outline-primary" for="btnradio2">$30</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
                                    <label class="btn btn-outline-primary" for="btnradio3">$50</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="tab-content">
                            <!-- جميع المنتجات -->
                            <div id="products-container" class="tab-pane fade show p-0 active">
                            <div class="row g-4 justify-content-between">
        <?php
        
 // تأكد من بدء الجلسة في بداية الملف

// افترض أن user_id موجود في الجلسة
$user_id = $_SESSION['user_id']; // تأكد من تخزين user_id في الجلسة عند تسجيل دخول المستخدم
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
                echo '            <a href="add_to_cart.php?product_name=' . urlencode($row["product_name"]) . '&user_id=' . $user_id . '" class="btn border border-secondary rounded-pill px-3 text-primary">';
                echo '                <i class="fa fa-shopping-bag me-2 text-primary"></i> <span class="cairo-bold">إضافة الى السلة</span>';
                echo '            </a>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
        } else {
            echo "لا توجد منتجات متاحة لهذه الفئة";
        }
        ?>
    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="pagination d-flex justify-content-center mt-5">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>" class="rounded">&laquo;</a>
                            <?php endif; ?>
                            
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a href="?page=<?php echo $i; ?>" class="rounded <?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?>" class="rounded">&raquo;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

 <!-- Footer start -->
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
                            <a href="../index.html"class="btn-link" ><span class="cairo-normal">الصفحة الرئيسية</span></a>
                            <a href="shop.php" class="btn-link"><span class="cairo-normal">  المتجر  </span></a>
                            <a href="cart.php" class="btn-link"><span class="cairo-normal">  سلة التسوق  </span></a>
                            <a href="../contact.html" class="btn-link"><span class="cairo-normal"> للتواصل مع فريق العمل</span></a>

                            
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
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('.fruite-categorie li').on('click', function(){
            // قم بإخفاء جميع العناصر غير النشطة
            $('.fruite-item').hide();
            
            // العثور على اسم الفئة المحددة
            var categoryName = $(this).find('.cairo-bold').text().trim();

            // إظهار العناصر التي تتطابق مع اسم الفئة المحددة
            $('.fruite-item').each(function() {
                if ($(this).find('.cairo-bold-black').text().trim() === categoryName) {
                    $(this).show();
                }
            });
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script>
function searchFunction(input) {
    var filter, divs, i, txtValue, searchResult;
    filter = input.value.toUpperCase();
    divs = document.querySelectorAll('.fruite-item');
    searchResult = document.getElementById('search-result');
    searchResult.innerHTML = ""; // تفريغ النتائج السابقة

    var found = false; // متغير لتحديد ما إذا تم العثور على تطابق أم لا

    for (i = 0; i < divs.length; i++) {
        txtValue = divs[i].querySelector('h4').textContent || divs[i].querySelector('h4').innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            divs[i].style.display = ""; // إظهار العنصر إذا تم العثور على تطابق
            found = true; // تعيين المتغير found إلى true إذا تم العثور على تطابق
        } else {
            divs[i].style.display = "none"; // إخفاء العنصر إذا لم يتم العثور على تطابق
        }      
    }

    // إذا لم يتم العثور على أي تطابق، عرض رسالة "لا يوجد هذا الاسم"
    if (!found) {
        searchResult.innerHTML = '<a href="shop.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary">العودة إلى المتجر</a>';
    }
}

function clearSearch() {
    var divs = document.querySelectorAll('.fruite-item');
    for (var i = 0; i < divs.length; i++) {
        divs[i].style.display = ""; // إظهار كافة العناصر
    }
    document.getElementById('search-input').value = ""; // مسح محتوى حقل البحث
    document.getElementById('search-result').innerHTML = ""; // مسح نتيجة البحث
}
</script>


</body>
</html>

