<?php
session_start();
require_once "lib.php";
require_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    if (checkEmail($email)) {
        $_SESSION['email'] = $email;
        $code = rand(100000, 999999);
        $_SESSION['code'] = $code;

        $subject = "Lấy lại mật khẩu";
        $name = "";
        $content = "Hãy nhập đoạn code sau <b>$code</b> vào trang web";
        sendMail($email, $subject, $name, $content);

        header("refresh:5; url=otp-verification.php");
        die;
    } else {
        $error = "Email không tồn tại";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
</head>

<body>
    <form action="" method="post">
        <div>
            Nhập vào email muốn lấy lại mật khẩu
        </div>
        <?php if (isset($error)) : ?>
            <div><?= $error ?></div>
        <?php endif ?>
        Email: <input type="email" name="email" id="">
        <button type="submit">Gửi</button>
    </form>
</body>

</html>