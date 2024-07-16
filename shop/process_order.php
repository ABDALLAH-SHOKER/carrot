<?php
require_once('tcpdf_include.php'); // تأكد إنك حاطط المسار الصحيح للملف

// إعداد الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_car";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// الحصول على البيانات من النموذج
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$notes = $_POST['notes'];
$paymentMethod = $_POST['paymentMethod'];
$creditCardNumber = isset($_POST['creditCardNumber']) ? $_POST['creditCardNumber'] : '';
$creditCardExpiry = isset($_POST['creditCardExpiry']) ? $_POST['creditCardExpiry'] : '';
$creditCardCVC = isset($_POST['creditCardCVC']) ? $_POST['creditCardCVC'] : '';

// إدراج البيانات في قاعدة البيانات
$sql = "INSERT INTO orders (name, address, phone, email, notes, payment_method, credit_card_number, credit_card_expiry, credit_card_cvc)
VALUES ('$name', '$address', '$phone', '$email', '$notes', '$paymentMethod', '$creditCardNumber', '$creditCardExpiry', '$creditCardCVC')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";

    // إرسال بريد إلكتروني لتأكيد الطلب
    $mail = new PHPMailer(true);

    try {
        // إعدادات SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // استبدل بـ SMTP server الخاص بك
        $mail->SMTPAuth = true;
        $mail->Username = 'abdallahshoker885@gmail.com'; // استبدل بـ عنوان بريدك الإلكتروني
        $mail->Password = 'sqqh udrm ruyn zuhj'; // استبدل بـ كلمة مرور بريدك الإلكتروني
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // إعدادات البريد الإلكتروني
        $mail->setFrom('abdallahshoker885@gmail.com', 'abdallah shoker');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Order Confirmation';
        $mail->Body    = "Thank you for your order, $name. We will process your order shortly.";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
