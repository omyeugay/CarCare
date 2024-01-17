<?php
    require_once '../../controller/database.php';
    require_once '../../models/invoices.php';
    require_once '../../models/appointments.php';
    require_once '../../models/service_categories.php';
    require_once '../../models/services.php';
    require_once '../../models/invoiceDetails.php';
    session_start();

    $appointments = new Appointments();
    $services = new Services();
    $serviceCategories = new ServiceCategory();
    $invoice = new Invoice();
    $invoiceDetails = new InvoiceDetails();


    if (isset($_GET['id'])) {
        $appointmentId = $_GET['id'];
        $appointment = $appointments->getAppointmentById($appointmentId);
        $AllInvoiceDetail = $invoiceDetails->getInvoiceDetailsByInvoiceIdByAppointmentId($appointmentId);
        $totals = $invoice->getTotalByAppointmentId($appointmentId);
        $totalValues = [];
        foreach ($totals as $total) {
            $totalValues[] = $total['total'];
        }
    }

    $allServices = $services->getAllBase();
    $allServiceCategories = $serviceCategories->getAll();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Chăm Sóc Xe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .invoice {
            max-width: 60%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-top: 50px;
            border-radius: 5px;
        }
        .invoice h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .invoice .info_customer {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice .info_customer div {
            flex-basis: 45%;
        }
        .invoice .info_customer div div {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }
        .invoice table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice table th, .invoice table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .invoice table th {
            background-color: #f9f9f9;
            color: #333;
        }

        td {
            text-align: center;
        }

        .btn {
            width: 80px;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-top: 20px ;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <h1>Hóa Đơn Chăm Sóc Xe</h1>
        <div class="info_customer">
            <div class="customer">
                <div >Tên Khách Hàng: <?php echo $appointment['customer_name']?></div>
                <div>Số Điện Thoại: <?php echo $appointment['customer_phone']?></div>
            </div>

            <div class="car">
                <div>Tên Xe: <?php echo $appointment['car_name']?></div>
                <div>Biển Số Xe: <?php echo $appointment['car_license_plate']?></div>
                <div>Loại Xe: <?php echo $appointment['car_type']?></div>
            </div>
        </div>

        <table>
            <tr>
                
                <th>Dịch Vụ</th>
                <th>Giá</th>
            </tr>
            <?php                  
                    foreach ($AllInvoiceDetail as $invoiceDetail) {
                        echo "<tr>";
                        echo "<td>" . $invoiceDetail['name'] . "</td>";
                        echo "<td>" . $invoiceDetail['price'] . "</td>";
                        echo "</tr>";
                    }           
            ?>
            <tr>
                <td colspan="2" style="text-align: right; padding-right: 177px">Tổng Tiền: <?php echo $totalValues[0]?></td> 
            </tr>
        </table>

        <div class="btn" onclick="exportToExcel()"><a style="display:block; text-decoration: none; color: #fff" href="export_to_excel.php?id=<?php echo $appointmentId; ?>">excel</a></div>
        <div class="btn"><a style="display:block; text-decoration: none; color: #fff" href="../manage_appointments/manage_appointments.php">Trở lại</a></div>             

        <script>
        // function exportToExcel() {
        //     window.location.href = 'export_to_excel.php';
        // }
        // </script>
    </div>
</body>
</html>