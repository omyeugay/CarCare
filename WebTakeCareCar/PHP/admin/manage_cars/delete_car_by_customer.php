<?php
require_once '../../controller/database.php';
require_once '../../models/cars.php';

// Check if id is provided
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Create a new instance of Cars
    $cars = new Cars();

    // Delete the car
    $result = $cars->deleteCar($id);

    if($result) {
        // Redirect to manage cars page
        header("Location: ../../infoCars.php");
    } else {
        echo "Error deleting car";
    }
} else {
    echo "No id provided";
}
?>