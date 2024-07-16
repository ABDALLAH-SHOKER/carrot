<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_car";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// تسجيل الدخول
if (isset($_POST['login'])) {
    $email_or_username = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email_or_username, $email_or_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            if ($user['type'] == 'individual') {
                header("Location: individual.php");
                exit();
            } elseif ($user['type'] == 'company') {
                header("Location: company.php");
                exit();
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email or username.";
    }
}

// التسجيل
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone_number = $_POST['phone_number'];
    $type = $_POST['type'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO user (username, email, password,confirm_password, phone_number, type) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $email, $hashed_password, $hashed_confirm_password, $phone_number, $type);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;

        header("Location: choose.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// تحديث بيانات المستخدم
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE user SET username = ?, email = ?, phone_number = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $phone_number, $_SESSION['user_id']);

    if ($stmt->execute()) {
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        echo "Profile updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* إضافة لتحسين التوافق مع الشاشات المختلفة */


        /* أسلوب CSS مدمج هنا لتحسين العرض، يمكنك نقله إلى ملف styles.css */
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
        * {
            box-sizing: border-box;
        }

        body {
            background-image: url('img/back.jpeg'); /* استبدل path/to/your/image.jpg بمسار الصورة الخاصة بك */
    background-size: cover; /* يجعل الصورة تمتد لتغطي كل العنصر */
    background-position: center; /* يضبط موقع الصورة في الوسط */
    background-repeat: no-repeat; /* يمنع تكرار الصورة */
         
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
                    0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% {
                opacity: 0;
                z-index: 1;
            }
            
            50%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        footer {
            background-color: #222;
            color: #fff;
            font-size: 14px;
            bottom: 0;
            position: fixed;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
        }

        footer p {
            margin: 10px 0;
        }

        footer i {
            color: red;
        }

        footer a {
            color: #3c97bf;
            text-decoration: none;
        }

       /* إضافة لتحسين التوافق مع الشاشات المختلفة */
/* تنسيق للشاشات الصغيرة */


    </style>
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-up-container">
    <form action="choose.php" method="post">
    <h1><span class="RuaqArabic-Bold">إنشاء حساب</span></h1>
    <span>or use your email for registration</span>
    <input type="text" id="username" name="username" placeholder="Name" required>
    <input type="email" id="email" name="email" placeholder="Email" required>
    <input type="password" id="password" name="password" placeholder="Password" required>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
    <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" required>
    <label for="type_individual" style="margin-right: 20px;">اختيار نوع المستخدم</label>
    <br>

    <!-- إضافة اختيار نوع المستخدم -->
    <div style="display: flex; align-items: center;">
    <input type="radio" id="type_individual"  style="margin-right: 10px;" name="type" value="individual" required>
    <label for="type_individual" style="margin-right: 20px;">فرد</label>
    <label for="type_individual" style="margin-right: 20px;">|</label>

    <input type="radio" id="type_company" style="margin-right: 10px;" name="type" value="company" required>
    <label for="type_company" style="margin-right: 20px;">شركة</label>
</div>


    
    <button type="submit"  name="signup"> sign up </button>
</form>

    </div>
    <div class="form-container sign-in-container">
        <form action="choose.php" method="post">
            <h1>Sign in</h1>
           <br>
            <span>or use your account</span>
           <br>

            <label for="email">Email or Username:</label>
            <input type="text" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <a href="#signUp">  don`t have account?</a>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>


<script>
    
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
</body>
</html>
