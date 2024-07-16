<?php
require_once('tcpdf_include.php');

// Collect form data
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$notes = $_POST['notes'];
$paymentMethod = $_POST['paymentMethod'];
$creditCardNumber = $_POST['creditCardNumber'] ?? null;
$creditCardExpiry = $_POST['creditCardExpiry'] ?? null;
$creditCardCVC = $_POST['creditCardCVC'] ?? null;

// Collect table data
$tableData = json_decode($_POST['tableData'], true);

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company');
$pdf->SetTitle('Order Details');
$pdf->SetSubject('Order Details');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Title
$pdf->Cell(0, 10, 'Order Details', 0, 1, 'C');

// Customer Details
$pdf->Cell(0, 10, 'Customer Details', 0, 1);
$pdf->MultiCell(0, 10, "Name: $name\nAddress: $address\nPhone: $phone\nEmail: $email\nNotes: $notes\nPayment Method: $paymentMethod", 0, 'L');

// Table Headers
$pdf->Cell(0, 10, 'Products', 0, 1);
$pdf->SetFillColor(240, 240, 240);
$pdf->Cell(30, 10, 'Image', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'Product Name', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Price', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Quantity', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Total', 1, 1, 'C', 1);

// Table Data
foreach ($tableData as $row) {
    $pdf->Cell(30, 10, '', 1); // Placeholder for image
    $pdf->Cell(50, 10, $row['productName'], 1);
    $pdf->Cell(30, 10, $row['productPrice'], 1);
    $pdf->Cell(20, 10, $row['quantity'], 1);
    $pdf->Cell(30, 10, $row['total'], 1, 1);
}

// Close and output PDF document
$pdf->Output('order_details.pdf', 'I');
?>
