<?php
require_once '../../controller/database.php';
require_once '../../models/invoices.php';
     class Appointments {
        private $db;

        public function __construct() {
            $this->db = new Database();

        }

        public function getAll() {
            $sql = "SELECT 
                appointments.id, 
                customers.name AS customer_name, 
                customers.phone AS customer_phone, 
                cars.name AS car_name, 
                carTypes.type AS car_type,
                cars.license_plate AS car_license_plate, 
                GROUP_CONCAT(ServiceCategories.name SEPARATOR ', ') AS category_names, 
                GROUP_CONCAT(Services.name SEPARATOR ', ') AS service_names, 
                appointments.appointment_date, 
                appointments.appointment_time, 
                appointments.status 
                FROM 
                    appointments
                INNER JOIN 
                    customers ON appointments.customer_id = customers.id
                INNER JOIN 
                    cars ON appointments.car_id = cars.id
                INNER JOIN 
                    carTypes ON appointments.car_type_id = carTypes.id
                INNER JOIN 
                    appointments_services ON appointments.id = appointments_services.appointment_id
                INNER JOIN 
                    Services ON appointments_services.service_id = Services.id
                INNER JOIN 
                    ServiceCategories ON Services.category_id = ServiceCategories.id
                GROUP BY appointments.id;";

            $result = mysqli_query($this->db->conn, $sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        public function getAllBase() {
            $sql = "SELECT * FROM appointments";
            $result = mysqli_query($this->db->conn, $sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        public function getAppointmentById($id) {
            $sql = "SELECT 
                appointments.id, 
                customers.name AS customer_name, 
                customers.phone AS customer_phone, 
                cars.name AS car_name, 
                carTypes.type AS car_type,
                cars.license_plate AS car_license_plate, 
                GROUP_CONCAT(ServiceCategories.id SEPARATOR ', ') AS category_ids, 
                GROUP_CONCAT(Services.id SEPARATOR ', ') AS service_ids, 
                appointments.appointment_date, 
                appointments.appointment_time, 
                appointments.status 
                FROM 
                    appointments
                INNER JOIN 
                    customers ON appointments.customer_id = customers.id
                INNER JOIN 
                    cars ON appointments.car_id = cars.id
                INNER JOIN 
                    carTypes ON appointments.car_type_id = carTypes.id
                INNER JOIN 
                    appointments_services ON appointments.id = appointments_services.appointment_id
                INNER JOIN 
                    Services ON appointments_services.service_id = Services.id
                INNER JOIN 
                    ServiceCategories ON Services.category_id = ServiceCategories.id
                WHERE appointments.id = ?;";

            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function getAppointmentByIdForInvoice($id) {
            $sql = "SELECT 
                appointments.id, 
                customers.name AS customer_name, 
                customers.phone AS customer_phone, 
                cars.name AS car_name, 
                carTypes.type AS car_type,
                cars.license_plate AS car_license_plate, 
                GROUP_CONCAT(ServiceCategories.name SEPARATOR ', ') AS category_names, 
                GROUP_CONCAT(Services.name SEPARATOR ', ') AS service_names,
                appointments.appointment_date, 
                appointments.appointment_time, 
                appointments.status 
                FROM 
                    appointments
                INNER JOIN 
                    customers ON appointments.customer_id = customers.id
                INNER JOIN 
                    cars ON appointments.car_id = cars.id
                INNER JOIN 
                    carTypes ON appointments.car_type_id = carTypes.id
                INNER JOIN 
                    appointments_services ON appointments.id = appointments_services.appointment_id
                INNER JOIN 
                    Services ON appointments_services.service_id = Services.id
                INNER JOIN 
                    ServiceCategories ON Services.category_id = ServiceCategories.id
                WHERE appointments.id = ?;";

            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function getCustomerByAppointmentId($appointmentId) {
            // Lấy customer_id từ bảng appointments
            $sql = "SELECT customer_id FROM appointments WHERE id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $appointmentId);
            $stmt->execute();
            $result = $stmt->get_result();
            $appointment = $result->fetch_assoc();
        
            // Nếu không tìm thấy cuộc hẹn, trả về null
            if (!$appointment) {
                return null;
            }
        
            // Lấy thông tin khách hàng từ bảng customers
            $sql = "SELECT * FROM customers WHERE id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $appointment['customer_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function getCarByAppointmentId($appointmentId) {
            // Lấy car_id từ bảng appointments
            $sql = "SELECT car_id FROM appointments WHERE id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $appointmentId);
            $stmt->execute();
            $result = $stmt->get_result();
            $appointment = $result->fetch_assoc();
        
            // Nếu không tìm thấy cuộc hẹn, trả về null
            if (!$appointment) {
                return null;
            }
        
            // Lấy thông tin xe từ bảng cars
            $sql = "SELECT * FROM cars WHERE id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $appointment['car_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function addAppointment($customerId, $carId, $car_type_id, $serviceIds, $appointmentDate, $appointmentTime) {
            $sql = "INSERT INTO appointments (customer_id, car_id, car_type_id, appointment_date, appointment_time) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("iiiss", $customerId, $carId, $car_type_id, $appointmentDate, $appointmentTime);
            $stmt->execute();
        
            $appointmentId = $stmt->insert_id;

            // Add invoice
            $invoiceDate = date('Y-m-d H:i:s'); // Use current date and time as invoice date
            $invoice = new Invoice();
            
            $InvoiceId = $invoice->addInvoice($appointmentId, $invoiceDate);
        
            foreach ($serviceIds as $serviceId) {
                $sql = "INSERT INTO appointments_services (appointment_id, service_id) VALUES (?, ?)";
                $stmt = $this->db->conn->prepare($sql);
                $stmt->bind_param("ii", $appointmentId, $serviceId);
                $stmt->execute();
        
                // Get the price of the service for the specific car type
                $sql = "SELECT price FROM ServicePrices WHERE service_id = ? AND car_type_id = ?";
                $stmt = $this->db->conn->prepare($sql);
                $stmt->bind_param("ii", $serviceId, $car_type_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $price = $row['price'];
        
                // Add invoice detail
                $sql = "INSERT INTO InvoiceDetails (invoice_id, service_id, car_type_id, price) VALUES ( ?, ?, ?, ?)";
                $stmt = $this->db->conn->prepare($sql);
                $stmt->bind_param("iiid", $InvoiceId, $serviceId, $car_type_id, $price);
                $stmt->execute();
            }
             $invoice->updateToTalToInvoice();
            $invoice->updateInvoice($appointmentId, $invoiceDate, $InvoiceId);
        
            
        }

        //update appointment
        public function updateAppointment($car_id, $car_type_id, $serviceIds, $appointmentDate, $appointmentTime, $status, $id) {
            $sql = "UPDATE appointments SET car_id = ?, car_type_id = ?, appointment_date = ?, appointment_time = ?, status = ? WHERE id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("iisssi", $car_id, $car_type_id, $appointmentDate, $appointmentTime, $status, $id);
            $stmt->execute();
        
            $sql = "DELETE FROM appointments_services WHERE appointment_id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $sql = "DELETE FROM InvoiceDetails WHERE invoice_id = (SELECT id FROM invoices WHERE appointment_id = ?)";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $appointmentId);
            $stmt->execute();
        
            foreach ($serviceIds as $serviceId) {
                $sql = "INSERT INTO appointments_services (appointment_id, service_id) VALUES (?, ?)";
                $stmt = $this->db->conn->prepare($sql);
                $stmt->bind_param("ii", $id, $serviceId);
                $stmt->execute();

                // Get the price of the service for the specific car type
                $sql = "SELECT price FROM ServicePrices WHERE service_id = ? AND car_type_id = ?";
                $stmt = $this->db->conn->prepare($sql);
                $stmt->bind_param("ii", $serviceId, $car_type_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $price = $row['price'];

                $sql = "INSERT INTO InvoiceDetails (invoice_id, service_id, car_type_id, price) 
                        VALUES ((SELECT id FROM invoices WHERE appointment_id = ?), ?, ?, ?)";
                $stmt = $this->db->conn->prepare($sql);
                $stmt->bind_param("iiid", $appointmentId, $serviceId, $car_type_id,  $price);
                $stmt->execute();
            }

            $invoiceDate = date('Y-m-d H:i:s');
            $sql = "UPDATE invoices SET total = ?, invoice_date = ? WHERE appointment_id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("dsi", $total, $invoiceDate, $appointmentId);
            $stmt->execute();
        }

        public function deleteAppointment($id) {
            $sql = "DELETE FROM appointments WHERE id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();

            $sql = "DELETE FROM appointments_services WHERE appointment_id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();

            // Delete invoice details
            $sql = "DELETE FROM InvoiceDetails WHERE invoice_id = (SELECT id FROM invoices WHERE appointment_id = ?)";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            // Delete invoice
            $sql = "DELETE FROM invoices WHERE appointment_id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
    }
?>