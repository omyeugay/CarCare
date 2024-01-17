<?php
    class InvoiceDetails {
        private $db;

        public function __construct() {
            $this->db = new Database();

        }

        public function getInvoiceDetailsByInvoiceIdByAppointmentId($appointmentId) {
            $sql = "SELECT services.name as name, price FROM InvoiceDetails
                    INNER JOIN services ON InvoiceDetails.service_id = services.id
                     WHERE invoice_id = (SELECT id FROM Invoices WHERE appointment_id = ?)";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $appointmentId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
?>