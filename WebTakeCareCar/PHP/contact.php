<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/slider.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
</head>
<body>
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

    <!-- slider -->
    <div class="slider">
        <div class="slide" id="slide-1">
            <img src="../assets/images/slider3.jpg" alt="Car 1">
            <div class="caption">
            <h3>Chăm sóc xe ô tô chuyên nghiệp</h3>
            <p>Chúng tôi cung cấp các dịch vụ chăm sóc xe ô tô chất lượng cao, từ rửa xe, bảo dưỡng, sửa chữa đến độ xe theo yêu cầu.</p>
            <a href="./aboutUs.php" class="button">Xem thêm</a>
            </div>
        </div>
        <div class="slide" id="slide-2">
            <img src="../assets/images/slider4.jpg" alt="Car 2">
            <div class="caption">
            <h3>Đa dạng các loại xe ô tô</h3>
            <p>Chúng tôi có nhiều loại xe ô tô để bạn lựa chọn, từ xe hơi, xe tải, xe khách đến xe thể thao, xe sang trọng, xe cổ điển.</p>
            <a href="./aboutUs.php" class="button">Xem thêm</a>
            </div>
        </div>
        <div class="slide" id="slide-3">
            <img src="../assets/images/slider5.jpg" alt="Car 3">
            <div class="caption">
            <h3>Giá cả hợp lý và ưu đãi</h3>
            <p>Chúng tôi luôn cập nhật giá cả cạnh tranh và có nhiều chương trình ưu đãi hấp dẫn cho khách hàng thân thiết và mới.</p>
            <a href="./aboutUs.php" class="button">Xem thêm</a>
            </div>
        </div>
        <div class="slide" id="slide-4">
            <img src="../assets/images/slider6.jpg" alt="Car 4">
            <div class="caption">
            <h3>Tư vấn và hỗ trợ tận tình</h3>
            <p>Chúng tôi có đội ngũ nhân viên tư vấn và hỗ trợ nhiệt tình, sẵn sàng giải đáp mọi thắc mắc và yêu cầu của bạn.</p>
            <a href="./aboutUs.php" class="button" >Xem thêm</a>
            </div>
        </div>
        <div class="controls">
            <span class="dot" onclick="showSlide(1)"></span>
            <span class="dot" onclick="showSlide(2)"></span>
            <span class="dot" onclick="showSlide(3)"></span>
            <span class="dot" onclick="showSlide(4)"></span>
        </div>
    </div>
    <!-- End slider -->

    <!-- start contact -->
    <div class="contact">
        <div class="contact-info">
            <div class="contact-info-list">
                <div class="contact-info-item">
                    <i class="fa-solid fa-house contact-info-icon"></i>
                    <div class="contact-info-heading">Địa chỉ</div>
                    <div class="contact-info-title">8 Nguyễn Cơ Thạch, Mỹ Đình, <br> Nam Từ Liêm, Hà Nội</div>
                </div>

                <div class="contact-info-item">
                    <i class="fa-solid fa-phone contact-info-icon"></i>
                    <div class="contact-info-heading">HOTLINE</div>
                    <div class="contact-info-title">0339898698</div>
                </div>

                <div class="contact-info-item">
                    <i class="fa-solid fa-envelope contact-info-icon"></i>
                    <div class="contact-info-heading">EMAIL</div>
                    <div class="contact-info-title">20213903@eaut.edu.vn</div>
                </div>

                <div class="contact-info-item">
                    <i class="fa-regular fa-clock contact-info-icon"></i>
                    <div class="contact-info-heading">GIỜ LÀM VIỆC</div>
                    <div class="contact-info-title">T2 - CN <br> 7:00 - 19:00</div>
                </div>
            </div>
        </div>

        <div class="contact-form">
            <h1 class="contact-form-heading">Để lại lời nhắn</h1>

            <form class="contact-form-customer" action="" method="POST">
                Họ và Tên* <br>
                <input type="text" name="name" placeholder="Nhập họ và tên" required> <br>
                Số điện thoại* <br>
                <input type="text" name="phone" placeholder="Nhập số điện thoại" required> <br>
                Email <br>
                <input type="email" name="email" placeholder="Nhập email" > <br>
                Lời nhắn <br>
                <textarea name="message" id="" cols="30" rows="10" placeholder="Nhập nội dung" ></textarea> <br>

                <input type="submit" name="submit" value="Gửi" class="contact-form-customer-submit">
            </form>
        </div>
    </div>
    <!-- end contact -->

    <!-- start footer -->
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
                    <li><a href="">Giới thiệu</a></li>
                    <li><a href="">Liên lạc</a></li>
                </ul>
            </div>

            <div class="footer-inf-all-item">
                <h3 class="footer-inf-all-item__heading">Chính sách</h3>
                <ul>
                    <li><a href="">Chính sách bảo mật</a></li>
                    <li><a href="">Chính sách thanh toán</a></li>
                    <li><a href="">Chính sách bán hàng</a></li>
                </ul>
            </div>
            </div>
        </div>
        </div>
        
        <p style="text-align: center; color: #fff; font-size:20px; margin: 0; padding: 20px; border-top: 2px solid #ccc;">© Bản quyền thuộc CleeCarCare</p>
    </div>
    <!-- End Footer -->

    <!-- JS for slider -->
    <script src="../assets/scrips/slider.js"></script>
</body>
</html>