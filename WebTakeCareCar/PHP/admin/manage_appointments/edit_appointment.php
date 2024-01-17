<?php
    require_once '../../models/appointments.php';
    require_once '../../models/customers.php';
    require_once '../../models/cars.php';
    require_once '../../models/car_types.php';
    require_once '../../models/service_categories.php';
    require_once '../../models/services.php';

    $appointments = new Appointments();
    $allAppointments = $appointments->getAll();
    $customers = new Customers();
    $allCustomers = $customers->getAll();
    $cars = new Cars();
    $allCars = $cars->getAll();
    $serviceCategories = new ServiceCategory();
    $services = new Services();
    $allServices = $services->getAllBase();
    $carTypes = new CarTypes();
    
    
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        if (!isset($_GET['id'])) {
            die('No id parameter provided in the URL.');
        }
        $appointment_id = $_GET['id'];
            $appointment = $appointments->getAppointmentById($appointment_id);
            $customerByAppointmentId = $appointments->getCustomerByAppointmentId($appointment_id);
            if (!isset($customerByAppointmentId['id'])) {
                die('No customer found for this appointment.');
            }
            $carByCustomerId = $cars->getByCustomerId($customerByAppointmentId['id']);
            $serviceIds = explode(', ', $appointment['service_ids']);
            $servicesById = [];
            foreach ($serviceIds as $id) {
                $servicesById[] = $services->getServiceByIdBase($id);
            }
        
            $categoryIds = explode(', ', $appointment['category_ids']);
            $categoriesById = [];
            foreach ($categoryIds as $id) {
                $categoriesById[] = $serviceCategories->getCategoryById($id);
            }
    }
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $car_id = $_POST['car_id'];
        $cars = new Cars();
        $car = $cars->getCarTypeIdById($_POST['car_id']);
        $car_type_id = $car['car_type_id'];
        $service_ids = $_POST['service_id'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $status = $_POST['status'];
        $appointment_id = $_POST['appointment_id'];

        $appointments->updateAppointment($car_id, $car_type_id, $service_ids, $appointment_date, $appointment_time, $status, $appointment_id);
        header('Location: manage_appointments.php');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
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
<h1 style="text-align: center">Chỉnh Sửa Lịch Hẹn</h1>
    <hr>
    <div class="container">
        
        <form action="edit_appointment.php" method="post">
            <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
            <div class="form-group">
                <label for="customer_id">Khách hàng:</label>
                
                <input type="text" id="customer_id" name="customer_id" value="<?php echo $appointment['customer_name']?>" disabled>
            </div>

            <div class="form-group">
                <label for="customer_phone">Số điện thoại:</label>
                <input type="text" id="customer_phone" name="customer_phone" value="<?php echo $appointment['customer_phone']?>" disabled>
            </div>

            <div class="form-group">
                <label for="car_id">Biển Số Xe:</label>
                <select id="car_id" name="car_id">
                    <?php
                    foreach ($carByCustomerId as $car) {
                        $selected = '';
                        if ($car['license_plate'] == $appointment['car_license_plate']) {
                            $selected = 'selected';
                        }
                        echo "<option value='" . $car['id'] . "' " . $selected . ">" . $car['license_plate'] . "</option>";
                    }
                    ?>
                </select>

            </div>

            <div class="form-group">
                <label for="category_id">Loại dịch vụ:</label>
                <select id="category_id" name="category_id[]" multiple>
                    <?php
                    $allCategories = $serviceCategories->getAll();
                    foreach ($allCategories as $category) {
                        $selected = '';
                        foreach ($categoriesById as $categoryById) {
                            if ($category['id'] == $categoryById['id']) {
                                $selected = 'selected';
                                break;
                            }
                        }
                        echo "<option value='" . $category['id'] . "' " . $selected . ">" . $category['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="service_id">Dịch vụ:</label>
                <select id="service_id" name="service_id[]" multiple>
                    <?php
                    foreach ($allServices as $service) {
                        $selected = '';
                        foreach ($servicesById as $serviceById) {
                            if ($service['id'] == $serviceById['id']) {
                                $selected = 'selected';
                                break;
                            }
                        }
                        echo "<option value='" . $service['id'] . "' " . $selected . ">" . $service['name'] . "</option>";
                    }
                    ?>
                </select>
                <div class="form-group" id="selected_services"></div>
            </div>
            

            <div class="form-group">
                <label for="appointment_date">Ngày hẹn:</label>
                <input type="date" id="appointment_date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $appointment['appointment_date']; ?>">
        
                <label for="appointment_time">Giờ hẹn:</label>
                <input type="time" id="appointment_time" name="appointment_time" min="07:00" max="19:00" value="<?php echo $appointment['appointment_time']; ?>">
            </div> 
            
            <div class="form-group">
                <label for="status">Trạng thái:</label>
                <select id="status" name="status">
                    <option value="Đã Đặt" <?php echo $appointment['status'] == 'Đã Đặt' ? 'selected' : ''; ?>>Đã Đặt</option>
                    <option value="Đã Hoàn Thành" <?php echo $appointment['status'] == 'Đã Hoàn Thành' ? 'selected' : ''; ?>>Đã Hoàn Thành</option>
                    <option value="Đã Hủy" <?php echo $appointment['status'] == 'Đã Hủy' ? 'selected' : ''; ?>>Đã Hủy</option>
                </select>
            </div>
            
            <div class="form-group">
                <input type="button" value="Hủy" onclick="window.location.href='manage_appointments.php'">
                <input type="submit" value="Cập Nhật Lịch Hẹn">
            </div>

        </form>
    </div>

    <script>
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

            customerCars[selectedCustomerId].forEach(function(car) {
                var option = document.createElement('option');
                option.value = car.id;
                option.text = car.license_plate;
                if (car.id == <?= $appointment['car_id'] ?>) {
                    option.selected = true;
                }
                carSelect.add(option);
            });
        });

        document.getElementById('service_id').addEventListener('change', function() {
            var selectedOptions = Array.from(this.selectedOptions).map(function(option) {
                return option.text;
            });
            document.getElementById('selected_services').textContent = selectedOptions.join(', ');
        });

        // Trigger the change event to populate the selected services on page load
        document.getElementById('service_id').dispatchEvent(new Event('change'));

        // Trigger the change event to populate the car select on page load
        document.getElementById('customer_id').dispatchEvent(new Event('change'));
    </script>
</body>
</html>