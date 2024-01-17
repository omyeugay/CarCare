<?php
    require_once '../../models/appointments.php';
    require_once '../../models/customers.php';
    require_once '../../models/cars.php';
    require_once '../../models/car_types.php';
    require_once '../../models/service_categories.php';
    require_once '../../models/services.php';

    $customers = new Customers();
    $allCustomers = $customers->getAll();

    $cars = new Cars();
    $allCars = $cars->getAll();
    

    $serviceCategories = new ServiceCategory();
    $allServiceCategories = $serviceCategories->getAll();

    $services = new Services();
    $allServices = $services->getAll();

    $carTypes = new CarTypes();
    $allCarTypes = $carTypes->getAll();

    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_id = $_POST['customer_id'];
        $car_id = $_POST['car_id'];
        $car = $cars->getCarTypeIdById($_POST['car_id']);
        $car_type_id = $car['car_type_id'];
        
        $service_ids = $_POST['service_id']; // Giả sử service_id là một mảng chứa các ID dịch vụ
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        // Giả sử trạng thái mặc định khi tạo cuộc hẹn là 'pending'
    
        $appointments = new Appointments();
        $appointment_id = $appointments->addAppointment($customer_id, $car_id, $car_type_id, $service_ids, $appointment_date, $appointment_time);
            header("Location: manage_appointments.php");
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Đặt Lịch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            float: right;
            margin-right: 10px;
            width: 100px;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        .form-group input[type="button"] {
            float: right;
            width: 100px;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
        }
        .form-group input[type="button"]:hover {
            background-color: #4cae4c;
        }

        .form-group input[type="date"], .form-group input[type="time"] {
            width: 150px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Đặt Lịch Chăm Sóc Xe</h1>
    <hr>
    <div class="container">
        
        <form action="add_appointment.php" method="post">
            <div class="form-group">
                <label for="customer_id">Khách hàng:</label>
                <select id="customer_id" name="customer_id">
                    <?php          
                    foreach ($allCustomers as $customer) {
                        echo "<option value='" . $customer['id'] . "'>" . $customer['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" disabled>
            </div>
    
            <div class="form-group">
                <label for="car_id">Biển Số Xe:</label>
                <select id="car_id" name="car_id">
                    <?php
                    
                    foreach ($allCars as $car) {
                        echo "<option value='" . $car['id'] . "'>" . $car['plate_license'] . "</option>";
                    }
                    ?>
                </select>           
            </div>
    
            <div class="form-group">
                <label for="category_id">Loại Dịch Vụ:</label>
                <select id="category_id" name="category_id" multiple>
                    <?php   
                    foreach ($allServiceCategories as $serviceCategory) {
                        echo "<option value='" . $serviceCategory['id'] . "'>" . $serviceCategory['name'] . "</option>";
                    }
                    ?>
                </select>

                <div class="form-group" id="selected_categories"></div>
            </div>
    
            <div class="form-group">
                <label for="service_id">Dịch vụ:</label>
                <select id="service_id" name="service_id[]" multiple>
                    <?php
                    foreach ($allServices as $service) {
                        echo "<option value='" . $service['id'] . "'>" . $service['name'] . "</option>";
                    }
                    ?>
                </select>

                <div class="form-group" id="selected_services"></div>
            </div>
    
            <div class="form-group">
                <label for="appointment_date">Ngày hẹn:</label>
                <input type="date" id="appointment_date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>">
        
                <label for="appointment_time">Giờ hẹn:</label>
                <input type="time" id="appointment_time" name="appointment_time" min="07:00" max="19:00 ">

            </div>   
            
            <div class="form-group">
                <input type="button" value="Hủy" onclick="window.location.href='manage_appointments.php'">
                <input type="submit" value="Đặt Lịch">
            
            </div>

        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('car_id').disabled = true;
        document.getElementById('service_id').disabled = true;

        // TỰ động điền số điện thoại và biển số xe khi chọn khách hàng
        var customerPhones = {
            <?php foreach ($allCustomers as $customer): ?>
                <?= $customer['id'] ?>: '<?= $customer['phone'] ?>',
            <?php endforeach; ?>
        };

        var customerCars = {
            <?php foreach ($allCustomers as $customer): ?>
                <?= $customer['id'] ?>: [
                    <?php
                    $customerCars = $cars->getByCustomerId($customer['id']);
                    foreach ($customerCars as $car) {
                        echo "{id: " . $car['id'] . ", license_plate: '" . $car['license_plate'] . "'},";
                    }
                    ?>
                ],
            <?php endforeach; ?>
        };

        document.getElementById('customer_id').addEventListener('change', function() {
            var selectedCustomerId = this.value;
            document.getElementById('phone').value = customerPhones[selectedCustomerId];

            var carSelect = document.getElementById('car_id');
            carSelect.innerHTML = '';
            carSelect.disabled = false;

            customerCars[selectedCustomerId].forEach(function(car) {
                var option = document.createElement('option');
                option.value = car.id;
                option.text = car.license_plate;
                carSelect.add(option);
            });
            
        });

        document.getElementById('service_id').addEventListener('change', function() {
            var selectedServiceIds = Array.from(this.selectedOptions).map(option => option.value);

            var selectedServicesDiv = document.getElementById('selected_services');
            selectedServicesDiv.innerHTML = '';

            selectedServiceIds.forEach(function(serviceId) {
                // Thêm dịch vụ đã chọn vào phần tử selected_services
                var serviceOption = document.querySelector('#service_id option[value="' + serviceId + '"]');
                var serviceDiv = document.createElement('div');
                serviceDiv.textContent = serviceOption.textContent;
                selectedServicesDiv.appendChild(serviceDiv);
            });
        });




        // Tự động điền dịch vụ khi chọn loại dịch vụ
        var servicesByCategory = {
        <?php foreach ($allServiceCategories as $serviceCategory): ?>
            <?= $serviceCategory['id'] ?>: [
                <?php
                $servicesInCategory = $services->getByCategoryId($serviceCategory['id']);
                foreach ($servicesInCategory as $service) {
                    echo "{id: " . $service['id'] . ", name: '" . $service['name'] . "'},";
                }
                ?>
            ],
        <?php endforeach; ?>
        };

        document.getElementById('category_id').addEventListener('change', function() {
            var selectedCategoryIds = Array.from(this.selectedOptions).map(option => option.value);

            var serviceSelect = document.getElementById('service_id');
            serviceSelect.innerHTML = '';
            serviceSelect.disabled = false;

            var selectedCategoriesDiv = document.getElementById('selected_categories');
            selectedCategoriesDiv.innerHTML = '';

            selectedCategoryIds.forEach(function(categoryId) {
                servicesByCategory[categoryId].forEach(function(service) {
                    var option = document.createElement('option');
                    option.value = service.id;
                    option.text = service.name;
                    serviceSelect.add(option);
                });

                // Thêm loại dịch vụ đã chọn vào phần tử selected_categories
                var categoryOption = document.querySelector('#category_id option[value="' + categoryId + '"]');
                var categoryDiv = document.createElement('div');
                categoryDiv.textContent = categoryOption.textContent;
                selectedCategoriesDiv.appendChild(categoryDiv);
            });
        });

        // Kiểm tra thời gian hẹn
        var appointmentTimeInput = document.getElementById('appointment_time');

        appointmentTimeInput.addEventListener('change', function() {
            var currentTime = new Date();
            var currentHour = currentTime.getHours();
            var currentMinute = currentTime.getMinutes();

            var selectedTime = this.value.split(':');
            var selectedHour = parseInt(selectedTime[0]);
            var selectedMinute = parseInt(selectedTime[1]);

            if (selectedHour < currentHour || (selectedHour == currentHour && selectedMinute <= currentMinute)) {
                alert('Vui lòng chọn một thời gian trong tương lai.');
                this.value = '';
            }
        });
    });
</script>
</body>
</html>