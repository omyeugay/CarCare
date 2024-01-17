<?php
session_start();
require_once "./models/customers.php";
require './controller/database.php';
require_once './models/user.php';
  if (isset($_POST['register'])) {
      $name = $_POST['reg-name'];
      $phone = $_POST['reg-phone'];
      $email = $_POST['reg-email'];
      $password = $_POST['reg-password'];

      $customers = new Customers();
      $result =  $customers->addCustomer($name, $phone, $email, $password);    
      if ($result) {
        echo "<script>alert('Đăng ký thành công!')</script>";
      } else {
        echo "<script>alert('Đăng ký thất bại!')</script>";
      }  
  }

  

  if (isset($_POST['login'])) {
    $email = $_POST["login-email"]; 
    $password = $_POST["login-password"];

    $user = new User();
    if ($user->loginUser($email, $password)) {
      echo "<script>alert('Đăng nhập thành công!')</script>";
    } else {
      echo "<script>alert('Đăng nhập thất bại!')</script>";
    }
  }

  if (isset($_SESSION['emailUser'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('dangnhap').style.display = 'none';
            document.getElementById('users_join__icon').style.display = 'block';
        });
    </script>";
  }  

  
  
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Clee car care</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/menu.css">
  <link rel="stylesheet" href="../assets/css/slider.css">
  <link rel="stylesheet" href="../assets/css/main-service.css">
  <link rel="stylesheet" href="../assets/css/main-address.css">
  <link rel="stylesheet" href="../assets/css/main-contact.css">
  <link rel="stylesheet" href="../assets/css/login.css">
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
        <li class="navbar-item"></li>
    </ul>

    <div class="users_join">
      <div id="users_join__icon" class="users_join__icon">
        <i class="fa-solid fa-user"></i>
        <div class="user__information">
          <div class="user__information__name">
            <?php
              if (isset($_SESSION['idUser'])) {
                $customers = new Customers();
                $customer = $customers->getCustomerById($_SESSION['idUser']);
                echo '<div class="user__information__select">Tên: ' . $customer['name'] . '</div>';
                echo '<div class="user__information__select">Số Điện Thoại: ' . $customer['phone'] . '</div>';
                echo '<div class="user__information__select">Email: ' . $customer['email'] . '</div>';
              }
            ?>
            <div class="user__information__select">
              <a class="user__information__select-link" href="infoCars.php">Thông Tin Xe</a>
            </div>
          </div>
          <div class="user__information__btn">
            <a href="./logout.php">Đăng xuất</a>
          </div>
        </div>
      </div>
      <div id='dangnhap' class="login-btn"><a class=" login-btn" href="#">Đăng nhập</a></div>
    </div>

    <!-- Login form -->
    <div id="login-form" class="login-form" style="display: none;">
      <form method="post">
        <h2>Đăng Nhập</h2>
        <input type="text" placeholder="Email" name="login-email" id="login-email"><br>
        <div class="password-container">
          <input type="password" name="login-password" id="login-password" placeholder="Password">
          <span class="password-toggle" onclick="togglePassword()">| Hide</span>
        </div>
        <input type="checkbox" id="remember" name="ck">Nhớ mật khẩu<br>
        <input type="submit" name="login" value="Đăng nhập">
        <div class=register-btn><a href="">Đăng ký Tài Khoản</a></div>
      </form>
    </div>

    <!-- Registration form -->
    <div id="register-form" class="form" style="display: none;">
        <form action="" method="post">
          <h2>Đăng Ký</h2>
            <label for="reg-email">Email:</label><br>
            <input type="text" id="reg-email" name="reg-email"><br>
            <label for="reg-password">Mật khẩu:</label><br>
            <input type="password" id="reg-password" name="reg-password"><br>
            <label for="reg-name">Họ và Tên:</label><br>
            <input type="text" id="reg-name" name="reg-name"><br>
            <label for="reg-phone">Số Điện Thoại:</label><br>
            <input type="text" id="reg-phone" name="reg-phone"><br>
            <input type="submit" name="register" value="Đăng ký">
            <div class=login-btn style="margin-top: 20px; text-align: right;"><a class="forLogin login-btn" href="">Đăng Nhập</a></div>

        </form>
    </div>

    <script>
      
      var loginBtn = document.querySelector(".login-btn");
      var loginForm = document.getElementById("login-form");
      var registerBtn = document.querySelector(".register-btn");
      var registerForm = document.getElementById("register-form");

      // When the user clicks the button, open the login form 
      loginBtn.onclick = function(event) {
          event.preventDefault();
          loginForm.style.display = "block";
      }

      registerBtn.onclick = function(event) {
          event.preventDefault();
          loginForm.style.display = "none";
          registerForm.style.display = "block";
      }

      // Get the login form
      var loginForm = document.querySelector(".login-form");

      // When the user clicks anywhere outside of the form, close it
      window.onclick = function(event) {
          if (event.target == loginForm) {
              loginForm.style.display = "none";
          }
      }
    </script>

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

  <!-- Main -->
  <div class="main">
    <div class="main-introduce">
      <div class="content">
        <hr class="-content"> <p style="font-size:24px; display: inline-block; margin: 0; color: #1abc9c">Công nghệ sử dụng</p>
        <h2 style="font-size:28px; font-weight: bold; ">Công nghệ chăm sóc xe ô tô chuẩn Đức</h2>
        <p>Công nghệ chăm sóc xe ô tô đến từ Đức sẽ mang tới cho khách hàng một trải nghiệm hoàn toàn khác biệt tại CleeCarCare. Dịch vụ luôn được cải thiện để khách hàng hài lòng nhất!</p>
  
         <div>Hotline: <p style="color: #234A8B; display: inline-block;   font-weight: bold;">0339898698</p></div>
  
        <div class="see"> <a href="./services" style="display: block; text-decoration: none; color: #fff;">XEM NGAY</a></div>
      </div>
      <div class="bgr-introduce"></div>
    </div>

    <div style="display: flex; justify-content: center; height: 4px;">
      <hr style="width: 50%; background-color: #1abc9c; height: 1px;">
    </div>

    <!-- Start main-decr -->
    <div class="main-decr">
      <div class="decr-list">
        <div class="decr-item">
          <div class="decr-item-img">
            <img class="decr-item-img-carcare" src="../assets/images/carcare.png" alt="">
          </div>
          <h3 class="decr-p">Chăm sóc xe</h3>
          <p class="decr-p">Quy trình chăm sóc bảo dưỡng chuyên nghiệp chuẩn Đức.</p>
        </div>
        <div class="decr-item">
        <div class="decr-item-img">
            <img class="decr-item-img-chemistry" src="../assets/images/chemistry.png" alt="">
          </div>
          <h3 class="decr-p">Hóa chất an toàn</h3>
          <p class="decr-p">Sử dụng hóa chất nhập khẩu chính hãng từ các thương hiệu hàng đầu đến từ Đức.</p>
        </div>
        <div class="decr-item">
        <div class="decr-item-img">
            <img class="decr-item-img-repair" src="../assets/images/repair.png" alt="">
          </div>
          <h3 class="decr-p">Thiết bị hiện đại</h3>
          <p class="decr-p">Sử dụng trang thiết bị hiện đại trong từng khâu chăm sóc xe.</p>
        </div>
      </div>
    </div>
    <!-- End main-decr -->

    <div style="display: flex; justify-content: center; height: 4px;">
      <hr style="width: 50%; background-color: #1abc9c; height: 1px;">
    </div>

    <!-- Start serviece -->
    <div class="main-service">
      <div class="content service-content">
        <hr class="-content"> <p style="font-size:24px; display: inline-block; margin: 0; color: #1abc9c">Dịch vụ chăm sóc</p>
        <div class="service-booking"><a href="./booking.php" class="service-booking__link">Đặt lịch ngay</a></div>
      </div>

      <div class="service-list">
        <div class="service-item">
          <img class="service-item__img" src="../assets/images/chamsocnoithat.jpg" alt="Car 3">
          <div class="service-item-content">
            <div class="service-count">1</div>
            <div class="service-heading">Chăm sóc nội thất</div>
            <div class="service-item__btn"> <a class="service-item__btn-link" href="https://www.facebook.com/">Xem thêm dịch vụ </a></div>
          </div>
        </div>

        <div class="service-item">
          <img class="service-item__img" src="../assets/images/slider3.jpg" alt="Car 3">
          <div class="service-item-content">
            <div class="service-count">2</div>
            <div class="service-heading">Chăm sóc ngoại thất</div>
            <div class="service-item__btn"> <a class="service-item__btn-link" href="https://www.facebook.com/">Xem thêm dịch vụ </a></div>
          </div>
        </div>

        <div class="service-item">
          <img class="service-item__img" src="../assets/images/slider4.jpg" alt="Car 3">
          <div class="service-item-content">
            <div class="service-count">3</div>
            <div class="service-heading">Chăm sóc khoang máy</div>
            <div class="service-item__btn"> <a class="service-item__btn-link" href="https://www.facebook.com/">Xem thêm dịch vụ </a></div>
          </div>
        </div>

        <div class="service-item">
        <img class="service-item__img" src="../assets/images/ceramic.jpg" alt="Car 3">
            <div class="service-item-content">
            <div class="service-count">4</div>
            <div class="service-heading">Phủ CERAMIC</div>
            <div class="service-item__btn"> <a class="service-item__btn-link" href="https://www.facebook.com/">Xem thêm dịch vụ </a></div>
          </div>
        </div>

        <div class="service-item">
          <img class="service-item__img" src="../assets/images/chamsockinh.jpg" alt="Car 3">
          <div class="service-item-content">
            <div class="service-count">5</div>
            <div class="service-heading">Chăm sóc kính</div>
            <div class="service-item__btn"> <a class="service-item__btn-link" href="https://www.facebook.com/">Xem thêm dịch vụ </a></div>
          </div>
        </div>

        <div class="service-item">
          <img class="service-item__img" src="../assets/images/slider6.jpg" alt="Car 3">
          <div class="service-item-content">
            <div class="service-count">6</div>
            <div class="service-heading">Dịch vụ khác</div>
            <div class="service-item__btn"> <a class="service-item__btn-link" href="https://www.facebook.com/">Xem thêm dịch vụ </a></div>
          </div>
        </div>
        
      </div>
    </div>
    <!-- End service -->

    <div style="display: flex; justify-content: center; height: 4px;">
      <hr style="width: 50%; background-color: #1abc9c; height: 1px;">
    </div>

    <div class="main-contact">
      <div class="main-contact__title">Liên hệ tư vấn ngay</div>
      <div class="main-contact__heading">Trải nghiệm dịch vụ chăm sóc cao cấp từ CleeCarCare</div>
      <div class="main-contact__btn"><a href="./contact.php" class="main-contact__btn-link">Liên hệ</a></div>
    </div>

    <div class="main-address">
      <div class="address-wrap">
        <div class="address-img">
        </div>

        <div class="address-content">
          <div class="address-content__name">
            <hr style="width: 64px; background-color: #1abc9c; height: 1px; float: left; margin-top: 15px; "><p style="font-size:24px; display: inline-block; margin: 0; color: #1abc9c; margin-left: 12px;">Địa chỉ</p>
            <div class="address-content__heading">CleeCarCare</div>
            <div class="address-content__title">Hotline: <p style="color:#234A8B; font-weight: bold; display: inline-block; margin: 6px 0;">0339898698</p></div>
            <div class="address-content__title-address">8 Nguyễn Cơ thạch, Mỹ Đình, Nam Từ Liêm, Hà Nội</div>
          </div>
        </div>
      </div>
    </div>
  </div>

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

  <script src="../assets/scrips/slider.js"></script>
</body>
</html>