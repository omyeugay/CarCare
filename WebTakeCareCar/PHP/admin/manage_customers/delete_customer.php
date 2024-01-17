<?php
require_once '../../controller/database.php';
require_once '../../models/customers.php';

$customers = new Customers();
$id = $_GET['id'];

if ($customers->deleteCustomer($id)) {
    header("Location: manage_customers.php");
} else {
    echo "Error deleting customer";
}
?>