<?php
    class Invoice {
        private $db;

        public function __construct() {
            $this->db = new Database();

        }

        // add appointment_id and invoice_date to invoices table
        public function addInvoice($appointmentId, $invoiceDate) {
            $sql = "INSERT INTO invoices (appointment_id, invoice_date) VALUES (?, ?)";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("is", $appointmentId, $invoiceDate);
            $stmt->execute();
            return $stmt->insert_id;
        }


        public function updateToTalToInvoice () {
            $sql = "UPDATE invoices SET total = (SELECT SUM(price) FROM InvoiceDetails WHERE invoice_id = Invoices.id)";
            $result = mysqli_query($this->db->conn, $sql);
        }

        public function updateInvoice ($appointmentId, $invoiceDate, $invoiceId) {
            $sql = "UPDATE invoices SET appointment_id = ?, invoice_date = ? WHERE id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("isi", $appointmentId, $invoiceDate, $invoiceId);
            $stmt->execute();
        }

        public function getTotalByAppointmentId($appointmentId) {
            $sql = "SELECT total FROM Invoices WHERE appointment_id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("i", $appointmentId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

?>
