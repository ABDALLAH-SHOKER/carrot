
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
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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

    <body class="Cairo">
        
       
        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top" style=" background-color: #303e48;">
    <div class="container topbar bg-color d-none d-lg-block" style=" background-color: #303e48;">
    </div>
    <div class="container px-0"  style=" background-color: #303e48;"> 
        <nav class="navbar navbar-light  navbar-expand-xl"  style=" background-color: #303e48;">
            <!-- comment -->

            <!--<a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">CARROT</h1></a>-->
            <a class="navbar-brand" href="index.php"  style=" background-color: #303e48;">
                <div class="logo-image" style=" background-color: #303e48;">
                    <img src="img/logoo.jpg" class="img-fluid">
                </div>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"  style=" background-color: #303e48;"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarCollapse"  style=" background-color: #303e48;color: white;">
                <div class="navbar-nav mx-auto"  style=" background-color: #303e48;color: white;">
                    <a href="index.php"style=" color: #adc8b8;" class="nav-item nav-link active"><span class="cairo-normal " >الصفحة الرئيسية</span></a>
                    <a href="shop/shop.php" style=" color: #adc8b8;" class="nav-item nav-link"><span class="cairo-normal">المتجر</span></a>
                    <a href="shop/cart.php" style=" color: #adc8b8;" class="nav-item nav-link"><span class="cairo-normal">سلة التسوق</span></a>
                    <a href="contact.html" style=" color: #adc8b8;" class="nav-item nav-link"><span class="cairo-normal">للتواصل مع فريق العمل</span></a>
                   
                </div>
                <div class="d-flex m-3 me-0">
                           
                            <a href="#" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                            </a>
                            <a href="#" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            <a href="logout.php"  class="nav-item nav-link" style=" color: red;"><span class="cairo-normal">تسجيل خروج</span></a>

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


        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary"><span class="cairo-normal">   منتجاتنا مميزة</span></h4>
                        <h1 class="mb-5 display-3 text-primary"><span class="cairo-normal" >أهلا بكم فى موقع  <span class="cairo-bold" style="color:#303e48;"> كاروت</span> </h1>
                        <div class="position-relative mx-auto">
                            <h4 class="mb-3 text-secondary"><span class="cairo-bold-black">    للخضروات والفاكهه المحلية والمستوردة</span></h4>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active rounded">
                                    <img src="img/hero-img-1.png" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                    <a href="upload/shop.php" class="btn px-4 py-2 text-white rounded"><span class="cairo-normal">الفواكه </span></a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="img/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                    <a href="upload/shop.php" class="btn px-4 py-2 text-white rounded"><span class="cairo-normal">الخضروات </span></a>
                                </div>
                                
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="">
                            <h1 class="cairo-bold-yellow">  منــتجـــاتـنـا</h1>
                        </div>
                       
                        <div class="">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                               
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-4">
                                        <span class="text-dark" style="width: 150px;"><span class="cairo-bold"> الخضروات</span></span>
                                    </a>
                                </li>
                      <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                        <span class="text-dark" style="width: 150px;"><span class="cairo-bold"> الفواكه</span></span>
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill " data-bs-toggle="pill" href="#tab-4">
                                        <span class="text-dark" style="width: 150px;"><span class="cairo-bold"> منتجات محلية</span></span>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill " data-bs-toggle="pill" href="#tab-4">
                                        <span class="text-dark" style="width: 150px;"><span class="cairo-bold"> منتجات مستوردة</span></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                    <div id="products-container" class="row"></div>

<script>
$(document).ready(function() {
    function fetchProducts(productType) {
        $.ajax({
            url: 'fetch_products.php',
            type: 'POST',
            data: { product_type: productType },
            success: function(data) {
                var products = JSON.parse(data);
                var html = '';

                products.forEach(function(product) {
                    var imagePath = 'shop/' + product.image_path; // تحديث مسار الصورة

                    html += `
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item">
                                <div class="fruite-img">
                                   <img src="${imagePath}" class="img-fluid w-100 rounded-top" alt="الصورة مش موجودة">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                    <span class="cairo-bold-black">${product.product_type}</span>
                                </div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                     <h4><span class="cairo-bold">${product.product_name}</span></h4>
                                     <p><span class="cairo-bold">${product.product_description}</span></p>
                                </div>
                            </div>
                        </div>`;
                });

                $('#products-container').html(html);
            }
        });
    }

    // Fetch default products (الخضروات) on page load
    fetchProducts('الخضروات');

    $('.nav-item a').on('click', function(e) {
        e.preventDefault();
        
        var productType = $(this).find('.cairo-bold').text().trim();
        
        fetchProducts(productType);
    });
});
</script>
                     <div class="mt-5">
                        <h2><span class="cairo-bold-yellow"> لـلـمزيد  </span></h2>
                        <a href="shop/shop.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button"> <span class="cairo-bold"> الذهاب الى المتجر  </span></a>
                    </div>
                </div>      
            </div>
        </div>
        <!-- Fruits Shop End-->


        <!-- Featurs Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary">
                                <img src="img/featur-1.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                        <h5 class="text-white"> <span class="cairo-bold"> تفاح منعش </span></h5>
                                        <h3 class="mb-0"><span class="cairo-bold">  %خصم 20 </span></h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="img/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <h5 class="text-white"> <span class="cairo-bold-green">  طعم ممتع  </span></h5>
                                        <h3 class="mb-0"><span class="cairo-bold">  توصيل مجانى  </span></h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-primary rounded border border-primary">
                                <img src="img/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-secondary text-center p-4 rounded">
                                        <h5 class="text-white"> <span class="cairo-bold">  الخضار المميز  </span></h5>
                                        <h3 class="mb-0"><span class="cairo-bold">  %خصم 30 </span></h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs End -->


        <!-- Vesitable Shop Start-->
        <div class="container-fluid vesitable py-5">
            <div class="container py-5"id="tab-5">
                <h1 class="mb-0"><span class="cairo-bold">أفضل المنتجات</span></h1>
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><span class="cairo-bold">خضروات</span></div>
                        <div class="p-4 rounded-bottom">
                            <h4><span class="cairo-bold">الطماطم </span></h4>
                            <p><span class="cairo-bold">مكون أساسى فى معظم الأكلات </span></p>
                            
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><span class="cairo-bold">خضروات</span></div>
                        <div class="p-4 rounded-bottom">
                            <h4><span class="cairo-bold">البطاطس </span></h4>
                            <p><span class="cairo-bold">مكون أساسى فى معظم الأكلات </span></p>
                            
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-3.png" class="img-fluid w-100 rounded-top bg-light" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><span class="cairo-bold">فاكهه</span></div>
                        <div class="p-4 rounded-bottom">
                            <h4><span class="cairo-bold">الموز </span></h4>
                            <p><span class="cairo-bold">من أفيد الفواكهه ذات الفائدة العاليه     </span></p>
                            
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-4.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><span class="cairo-bold">خضروات</span></div>
                        <div class="p-4 rounded-bottom">
                            <h4><span class="cairo-bold">الفلف الأحمر </span></h4>
                            <p><span class="cairo-bold">مكون أساسى فى معظم الأكلات </span></p>
                            
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><span class="cairo-bold">خضروات</span></div>
                        <div class="p-4 rounded-bottom">
                            <h4><span class="cairo-bold">البطاطس </span></h4>
                            <p><span class="cairo-bold">مكون أساسى فى معظم الأكلات </span></p>
                            
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><span class="cairo-bold">خضروات</span></div>
                        <div class="p-4 rounded-bottom">
                            <h4><span class="cairo-bold">البقدونس </span></h4>
                            <p><span class="cairo-bold">مكون أساسى فى معظم الأكلات </span></p>
                            
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><span class="cairo-bold">خضروات</span></div>
                        <div class="p-4 rounded-bottom">
                            <h4><span class="cairo-bold">البطاطس </span></h4>
                            <p><span class="cairo-bold">مكون أساسى فى معظم الأكلات </span></p>
                            
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><span class="cairo-bold">خضروات</span></div>
                        <div class="p-4 rounded-bottom">
                            <h4><span class="cairo-bold">البقدونس </span></h4>
                            <p><span class="cairo-bold">مكون أساسى فى معظم الأكلات </span></p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vesitable Shop End -->


        <!-- Banner Section Start-->
        <div class="container-fluid banner bg-secondary my-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white"><span class="cairo-bold">التفاح الممتاز     </span></h1>
                            <p class="fw-normal display-3 text-dark mb-4"><span class="cairo-bold">فى متجرنا     </span></p>
                            <p class="mb-4 text-dark"><span class="cairo-bold">    متاح لدينا أغلب الفاكهه الصحيه  </span></p>
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="img/baner-1.png" class="img-fluid w-100 rounded" alt="">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                                <h1 style="font-size: 100px;">1</h1>
                                <div class="d-flex flex-column">
                                    <span class="h2 mb-0">20ريال</span>
                                    <span class="h4 text-muted mb-0">kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Section End -->


        <!-- Bestsaler Product Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                
                <div class="row g-4">
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="img/best-product-1.jpg" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a  class="h5"><span class="cairo-bold">  البرتقال   </span></a>
                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3"><span class="cairo-bold">    10 ريال </span></h4>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="img/best-product-2.jpg" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a  class="h5"><span class="cairo-bold">  التوت   </span></a>
                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3"><span class="cairo-bold">    10 ريال </span></h4>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="img/best-product-3.jpg" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a  class="h5"><span class="cairo-bold">  الموز   </span></a>                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3"><span class="cairo-bold">    10 ريال </span></h4>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="img/best-product-4.jpg" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a  class="h5"><span class="cairo-bold">  المشمش   </span></a>                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3"><span class="cairo-bold">    10 ريال </span></h4>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="img/best-product-5.jpg" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a  class="h5"><span class="cairo-bold">  العنب   </span></a>                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3"><span class="cairo-bold">    10 ريال </span></h4>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="img/best-product-6.jpg" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a  class="h5"><span class="cairo-bold">  التفاح   </span></a>                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3"><span class="cairo-bold">    10 ريال </span></h4>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                   
                    
                </div>
            </div>
        </div>
        <!-- Bestsaler Product End -->


        <!-- Fact Start -->
     
        <!-- Fact Start -->


        <!-- Tastimonial Start -->
  
        <!-- Tastimonial End -->

        <div class="col-lg-11 col-md-4 col-sm-6">
                    <div class="d-flex justify-content-end pt-3">
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-black-50 footer pt-5 mt-5" style="background-image: url('img/footer.png'); background-size: cover; background-position: center; min-height: 500px;">
   
     
</div>

        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright  py-4"style=" background-color: #d2e8de;" >
            <div class="container">
                <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
    <span  style=" color: black;">
        <a href="index.php">
            <img src="img/Carrot-arab.png" alt="CARROT Logo" class="img-fluid" style="max-width: 20%; height: auto;">
        </a>
        , All right reserved.</span>
</div>
                    <div class="col-md-6 my-auto text-center text-md-end text-black">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom"style=" color: black;" href="https://wa.me/201065583199?text=">abdallah shoker
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
    <script>
    // انتظر حتى تحميل المستند
    document.addEventListener("DOMContentLoaded", function() {
        // العثور على جميع الأزرار "Add to cart"
        var addToCartButtons = document.querySelectorAll(".btn-add-to-cart");

        // تكرار عبر كل زر "Add to cart"
        addToCartButtons.forEach(function(button) {
            // إضافة حدث النقر إلى كل زر
            button.addEventListener("click", function(event) {
                // منع تحميل الصفحة
                event.preventDefault();

                // احتفظ بالعنصر الذي يحتوي على المعلومات التي تريد إضافتها إلى سلة التسوق
                var item = button.closest(".fruite-item");

                // استخراج معلومات العنصر
                var itemName = item.querySelector("h4").innerText;
                var itemPrice = item.querySelector(".fs-5").innerText;

                // إنشاء عنصر جديد لسلة التسوق
                var cartItem = document.createElement("div");
                cartItem.innerHTML = '<p>' + itemName + ' - ' + itemPrice + '</p>';

                // العثور على عنصر سلة التسوق
                var cart = document.getElementById("cart");

                // إضافة العنصر إلى سلة التسوق
                cart.appendChild(cartItem);
            });
        });
    });
</script>
<script>
    // انتظر حتى تحميل المستند
    document.addEventListener("DOMContentLoaded", function() {
        // العثور على جميع الأزرار "Add to cart"
        var addToCartButtons = document.querySelectorAll(".btn-add-to-cart");

        // تكرار عبر كل زر "Add to cart"
        addToCartButtons.forEach(function(button) {
            // إضافة حدث النقر إلى كل زر
            button.addEventListener("click", function(event) {
                // منع تحميل الصفحة
                event.preventDefault();

                // احتفظ بالعنصر الذي يحتوي على المعلومات التي تريد إضافتها إلى سلة التسوق
                var item = button.closest(".fruite-item");

                // استخراج معلومات العنصر
                var itemName = item.querySelector("h4").innerText;
                var itemPrice = item.querySelector(".fs-5").innerText;

                // إنشاء عنصر جديد لسلة التسوق
                var cartItem = document.createElement("div");
                cartItem.innerHTML = '<p>' + itemName + ' - ' + itemPrice + '</p>';

                // العثور على عنصر سلة التسوق
                var cart = document.getElementById("cart");

                // إضافة العنصر إلى سلة التسوق
                cart.appendChild(cartItem);
            });
        });
    });
</script>
<script>
    // استهداف زر الإضافة إلى السلة باستخدام محدد الصفاري
    var addToCartButtons = document.querySelectorAll('.btn-add-to-cart');

    // حلقة تسمح بإضافة حدث النقر إلى كل زر
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // العثور على العنصر الذي يحتوي على اسم المنتج
            var productNameElement = this.parentNode.parentNode.querySelector('h4');

            // الحصول على اسم المنتج من العنصر
            var productName = productNameElement.innerText;

            // إضافة اسم المنتج إلى صفحة cart.html عن طريق تخزينه في localStorage
            // يمكنك تعديل هذا الجزء لتناسب هيكل صفحة cart.html الخاصة بك
            var cartItems = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];
            cartItems.push(productName);
            localStorage.setItem('cartItems', JSON.stringify(cartItems));

            // رسالة تأكيد بأنتج اضافة الى السلة
            alert('تمت إضافة المنتج ' + productName + ' إلى السلة بنجاح!');
        });
    });
</script>

    </body>

</html>