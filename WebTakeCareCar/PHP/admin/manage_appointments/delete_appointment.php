<?php
require_once '../../controller/database.php';
require_once '../../models/appointments.php';

// Check if id is provided
if(isset($_GET['id'])) {
    $id = $_GET['id'];

 
    $appointments = new Appointments();


    $result = $appointments->deleteAppointment($id);
    header("Location: manage_appointments.php");
} else {
    echo "No id provided";
}
?>