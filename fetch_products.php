<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test_car";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $product_type = $_POST['product_type'];

    $sql = "SELECT product_type, product_name, product_description, image_path FROM products WHERE product_type = ? LIMIT 8";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $product_type);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);

    $stmt->close();
    $conn->close();
}
?>
