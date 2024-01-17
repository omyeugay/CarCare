<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/aboutUs.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/slider.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
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

    <div class="aboutUs">
        <div class="aboutUs__content">
            <div class="aboutUs__content__heading">
                <h1>Về CleeCarCare</h1>
            </div>

            <div class="aboutUs__content__title">
                <div class="aboutUs__content__text">
                    <h2>Bảo dưỡng xe</h2>
                    <p>Kì bảo dưỡng lại đến, thế nhưng quảng đường đến hãng và thời gian chờ đợi khiến ta nản lòng. Có nơi nào khác uy tín và chất lượng để gởi gắm chiếc xe của mình không? <br>
    
                        Cũng đã từng nản lòng và thắc mắc như thế, đội ngũ CleeCarCare cùng các đối tác đã và đang cung cấp dịch vụ bảo dưỡng xe ngoài hãng với
                        những ưu điểm vượt trội về chất lượng sản phẩm  cũng như tối ưu thời gian sử dụng để các chủ xe yên tâm đường dài, tiết kiệm thời gian.
                        Dầu nhớt Rheinol nhập khẩu trực tiếp từ CHLB Đức. <br>
                        Dầu hộp số, dầu trợ lực lái, dầu thắng tiêu chuẩn mới nhất từ Rheinol. <br>
                        Các loại lọc thương hiệu châu Âu và lọc chính hãng: Lọc gió động cơ, lọc gió máy lạnh và lọc dầu động cơ. <br>
                        Chất vệ sinh động cơ, vệ sinh hệ thống nhiên liệu, vệ sinh mâm, đĩa, thắng từ Rheinol. <br>
                        Phụ kiện, phụ tùng chính hãng hoặc tương tự từ châu Âu với nguồn gốc sản phẩm rõ ràng. <br>
                        Đội ngũ kĩ thuật là các kĩ sư ô tô được đào tạo bài bản cùng với kinh nghiệm thực tế đảm bảo am hiểu được các dòng xe khác nhau.
                    </p>
                </div>
    
                <div class="aboutUs__content__img">
                    <img src="../assets/images/chamsocnoithat.jpg" alt="Ảnh quy trình chăm sóc xe">
                </div>
            </div>

            <div class="aboutUs__content__title">
                <div class="aboutUs__content__text">
                    <h2>Chăm sóc xe</h2>
                    <p>Chăm sóc xe đã trở nên ngày càng phổ biến và thậm chí trở nên đơn giản với các chủ xe khi có rất nhiều sản phẩm hỗ trợ đang được bán trên thị trường cũng như rất nhiều trung tâm chăm sóc xe cung cấp đầy đủ dịch vụ. <br>
                        CleeCarCare nâng tầm chăm sóc với sự chú trọng chi tiết từ nguồn nước sử dụng đã qua lọc cho đến sử dụng các sản phẩm có nguồn gốc xuất xứ từ châu Âu. <br>
                        Sản phẩm vệ sinh nội thất, ngoại thất Sonax / Rheinol (Đức) <br>
                        Thiết bị vệ sinh, máy tạo hơi nước nóng Lavor (Ý) <br>
                        Sản phẩm đáng bóng 3M (Mĩ) <br>
                        Sản phẩm phủ Q2 Coating (CCM - Đức) <br>
                        Dung dịch phủ sát khuẩn Bacoban (Đức) <br>
                        Đội ngũ kĩ thuật viên có kinh nghiệp và luôn được đào tạo để cập nhật kĩ thuật, phương pháp mới. <br>
                        CleeCarCare - CHĂM SÓC XE, CHĂM SÓC TƯƠNG LAI
                    </p>
                </div>
    
                <div class="aboutUs__content__img">
                    <img src="../assets/images/slider3.jpg" alt="Ảnh Quy trình chăm sóc xe">
                </div>
            </div>

        </div>
    </div>

    <!-- start footer -->
    <div class="footer">
        <div class="footer-inf">
        <div class="footer-inf-company">
            <img src="../assets/images/cleecarcare-high-resolution-logo-white-transparent.png" alt="ảnh logo CleeCarCare" class="footer-inf-company__img">
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
    <script src="../assets/scrips/slider.js"></script>

</body>
</html>