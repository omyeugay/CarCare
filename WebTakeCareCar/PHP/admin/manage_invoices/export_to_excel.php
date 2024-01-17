<?php
    require_once '../../controller/database.php';
    require_once '../../models/invoices.php';
    require_once '../../models/appointments.php';
    require_once '../../models/service_categories.php';
    require_once '../../models/services.php';
    require_once '../../models/invoiceDetails.php';

    $appointments = new Appointments();
    $allAppointments = $appointments->getAll();
    $services = new Services();
    $serviceCategories = new ServiceCategory();
    $invoiceDetails = new InvoiceDetails();
    $invoice = new Invoice();
    // Check if the appointment ID is set
    if (isset($_GET['id'])) {
        // Get the appointment ID
        $appointmentId = $_GET['id'];

        // Get the appointment details
        $appointment = $appointments->getAppointmentById($appointmentId);

        // Get the invoice details
        $AllInvoiceDetail = $invoiceDetails->getInvoiceDetailsByInvoiceIdByAppointmentId($appointmentId);

        // Get the total
        $totals = $invoice->getTotalByAppointmentId($appointmentId);
        $totalValues = [];
        foreach ($totals as $total) {
            $totalValues[] = $total['total'];
        }

        // Open a new CSV file
        $file = fopen('invoice.csv', 'w');

        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        // Add the h1 tag
        fputcsv($file, array_map(function($value) { return mb_convert_encoding($value, 'UTF-8', 'auto'); }, ['Hóa Đơn Chăm Sóc Xe']));

        fputcsv($file, ['Tên Khách Hàng', $appointment['customer_name']]);
        fputcsv($file, ['Số Điện Thoại', $appointment['customer_phone']]);
        fputcsv($file, ['Tên Xe', $appointment['car_name']]);
        fputcsv($file, ['Biển Số Xe', $appointment['car_license_plate']]);
        fputcsv($file, ['Loại Xe', $appointment['car_type']]);

        // Add the column names
        fputcsv($file, array_map(function($value) { return mb_convert_encoding($value, 'UTF-8', 'auto'); }, ['Dịch Vụ', 'Giá']));

        // Add the invoice details
        foreach ($AllInvoiceDetail as $invoiceDetail) {
            fputcsv($file, array_map(function($value) { return mb_convert_encoding($value, 'UTF-8', 'auto'); }, [$invoiceDetail['name'], $invoiceDetail['price']]));
        }

        // Add the total
        fputcsv($file, array_map(function($value) { return mb_convert_encoding($value, 'UTF-8', 'auto'); }, ['Tổng Tiền', $totalValues[0]]));

        // Close the CSV file
        fclose($file);

        header('Location: manage_invoices.php');
        header('LOCATION: invoice.csv');
    }
?>