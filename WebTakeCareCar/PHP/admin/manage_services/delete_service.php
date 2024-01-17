<?php
require_once '../../controller/database.php';
require_once '../../models/services.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $services = new Services();
    $result = $services->deleteService($id);
    
    if($result) {
    
        header("Location: manage_services.php");
    } else {
        echo "Error deleting service";
    }
} else {
    echo "No id provided";
}

?>