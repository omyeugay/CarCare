<?php
require_once './controller/database.php';
    require_once './models/service_categories.php';
    require_once './models/services.php';
    require_once './models/service_prices.php';

    $serviceCategories = new ServiceCategory();
    $services = new Services();
    $servicePrices = new ServicePrices();


    $serviceCategoriesList = $serviceCategories->getAll(); 
    $servicesList = $services->getAllBase();
    $servicePricesList = $servicePrices->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dịch vụ</title>
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/slider.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
    <link rel="stylesheet" href="../assets/css/services.css">
</head>
<body>
    <div class="wrap-services">
        <!-- start navbar -->
        <div class="navbar">
            <!-- Menu -->
            <div class="toggle">&#9776;</div>
            <div class="menu" id="menu">
            <div class="menu-icon">
                <i class="close-icon fa-solid fa-xmark"></i>
            </div>
            <ul class="menu-list">
                <li class="menu-item"><a class="menu-item-link" href="./main.php">Trang chủ</a></li>
                <li class="menu-item"><a class="menu-item-link" href="./services.php">Dịch vụ</a></li>
                <li class="menu-item"><a class="menu-item-link" href="./aboutUs.php">Giới thiệu</a></li>
                <li class="menu-item"><a class="menu-item-link" href="./contact.php">Liên hệ</a></li>
                <li class="menu-item"><a class="menu-item-link" href="./booking.php">Đặt lịch ngay</a></li>
            </ul>
            </div>

            <script>
            // Phần viết javascript để xử lý sự kiện mở đóng thanh menu
            var closeIcon = document.querySelector(".close-icon");
            var toggle = document.querySelector(".toggle");
            var menu = document.getElementById("menu");

            toggle.onclick = function() {
            toggle.classList.toggle("active");
            if (toggle.classList.contains("active")) {
                menu.style.left = "0";
                toggle.style.display = "none";
            } else {
                menu.style.left = "-300px";
            }
            }

            closeIcon.onclick = function() {
            toggle.classList.remove("active");
            toggle.style.display = "block";
            menu.style.left = "-300px";
            }
            </script>
            <!-- End menu -->

            <ul class="navbar-list">
                <li class="navbar-item"><a class="navbar-link" href="./main.php">Trang chủ</a></li>
                <li class="navbar-item"><a class="navbar-link" href="./services.php">Dịch vụ</a></li>
                <li class="navbar-item"><a class="navbar-link" href="#"><img class="navbar-img" src="../assets/images/cleecarcare-high-resolution-logo-white-transparent.png" alt="Ảnh logo CleeCarCare"></a></li>
                <li class="navbar-item"><a class="navbar-link" href="./aboutUs.php">Giới thiệu</a></li>
                <li class="navbar-item"><a class="navbar-link" href="./contact.php">Liên hệ</a></li>
            </ul>

            <div class="navbar-booking">
            <a href="./booking.php" class="navbar-booking__link">Đặt lịch ngay</a>
            </div>
        </div>
        <!-- End navbar -->
        <div class="services grid wide">
            <div class="services-intro row">
                <div class="services-intro-left c-5">
                    <h1 class="services-intro-heading">CleeCarCare <br> Dịch vụ chăm sóc xe</h1>
                    <h2 class="services-intro-heading2">Chuyên nghiệp</h2>
                </div>
    
                <div class="c-7">
                    <img src="../assets/images/slider4.jpg" alt="">
                </div>
            </div>
    
            <div class="services-info row">
                <div class="services-info-item c-2">
                    <i class="fa-regular fa-clock services-info-icon"></i>
                    <div class="services-info-heading">Tiết kiệm thời gian</div>
                    <div class="services-info-title">Đội ngũ vận hành có kinh nghiệm lâu năm trong lĩnh vực chăm sóc xe, giúp đảm bảo thời gian chất lượng cho từng quý khách hàng.</div>
                </div>
    
                <div class="services-info-item c-2">
                    <i class="fa-solid fa-seedling services-info-icon"></i>
                    <div class="services-info-heading">Tư vấn tận tâm</div>
                    <div class="services-info-title">Sau khi kiểm tra xe, đội ngũ vận hành sẽ tư vấn cho khách hàng về tình trạng của xe và đưa ra gói dịch vụ phù hợp, giúp “xế cưng” luôn trong tình trạng tốt nhất.</div>
                </div>
    
                <div class="services-info-item c-2">
                    <i class="fa-solid fa-gear services-info-icon"></i>
                    <div class="services-info-heading">Thiết bị hiện đại</div>
                    <div class="services-info-title">Sử dụng trang thiết bị hiện đại giúp đảm bảo được tính nguyên vẹn của xe cũng đồng thời giúp xe quay trở lại hiệu suất cao nhất</div>
                </div>
    
                <div class="services-info-item c-2">
                    <i class="fa-solid fa-hand-sparkles services-info-icon"></i>
                    <div class="services-info-heading">Làm sạch triệt để</div>
                    <div class="services-info-title">Đa dạng gói rửa xe giúp làm sạch từ trong ra ngoài. Sử dụng chất tẩy rửa có thành phần tự nhiên, an toàn và bảo vệ môi trường.</div>
                </div>
            </div>
    
            <div class="service-list">
                <?php
                foreach($serviceCategoriesList as $serviceCategory) {
                    echo '<div class="service-list-heading">';
                    echo '<h2 class="service-list-heading-title">' . $serviceCategory['name'] . '</h2>';
                    echo '</div>';
                    echo '<Table>';
                    echo '<tr>';
                    echo '<th>STT</th>';
                    echo '<th>Dịch Vụ</th>';
                    echo '<th>Xe 4 Chỗ</th>';
                    echo '<th>Xe 7 Chỗ</th>';
                    echo '<th>Xe 16 Chỗ</th>';
                    echo '</tr>';
                    $count = 1;
                    foreach($servicesList as $service) {
                        if($service['category_id'] == $serviceCategory['id']) {
                            echo '<tr>';
                            echo '<td><div class="">'.$count.'</div></td>';
                            echo '<td><div class="">' . $service['name'] . '</div></td>';
                            $count++;
                            foreach($servicePricesList as $servicePrice) {
                                if($servicePrice['service_id'] == $service['id']) {
                                    echo '<td><div class="">' . $servicePrice['price'] . '</div></td>';
                                }
                            }
                            echo '</tr>';
                        }
                    }
                    echo '</Table>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-inf">
        <div class="footer-inf-company">
            <img src="../assets/images/cleecarcare-high-resolution-logo-white-transparent.png" alt="" class="footer-inf-company__img">
            <div class="footer-inf-company__address"><p>8 Nguyễn Cơ Thạch, Mỹ Đình, Nam Từ Liêm, Hà Nội</p></div>
            <div class="footer-inf-company__contact">
            <p style="display: inline-block; border-right: 2px solid #fff;"><i class="fa-solid fa-phone"></i> 0339898698</p>
            <p style="display: inline-block; "><i class="fa-solid fa-envelope"></i> 20213903@gmail.com</p>
            </div>
        </div>

        <div class="footer-inf-all">
            <div class="footer-inf-all-list">
            <div class="footer-inf-all-item">
                <h3 class="footer-inf-all-item__heading">Dịch vụ</h3>
                <ul>
                <li><a href="">Chăm sóc Nội thất</a></li>
                <li><a href="">Chăm sóc Ngoại thất</a></li>
                <li><a href="">Chăm sóc Khoang máy</a></li>
                <li><a href="">Chăm sóc Phủ CERAMIC</a></li>
                <li><a href="">Chăm sóc Kính</a></li>
                </ul>
            </div>

            <div class="footer-inf-all-item">
                <h3 class="footer-inf-all-item__heading">Công ty</h3>
                <ul>
                <li><a href="./aboutUs.php">Giới thiệu</a></li>
                <li><a href="">Liên lạc</a></li>
                </ul>
            </div>

            <div class="footer-inf-all-item">
                <h3 class="footer-inf-all-item__heading">Chính sách</h3>
                <ul>
                <li><a href="#">Chính sách bảo mật</a></li>
                <li><a href="#">Chính sách thanh toán</a></li>
                <li><a href="#">Chính sách bán hàng</a></li>
                </ul>
            </div>
            </div>
        </div>
        </div>
        
        <p style="text-align: center; color: #fff; font-size:20px; margin: 0; padding: 20px; border-top: 2px solid #ccc;">© Bản quyền thuộc CleeCarCare</p>
    </div>
  <!-- End Footer -->

</body>
</html>