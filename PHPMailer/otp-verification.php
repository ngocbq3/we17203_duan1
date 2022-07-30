<?php
session_start();

$email = $_SESSION['email'];
$code = $_SESSION['code'];
if ($email == false) {
    header("location: login.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['code'];
    if ($code != $otp) {
        $error = "Mã xác nhận không đúng";
    } else {
        session_destroy();
        header("location:new-password.php");
        die;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra otp</title>
</head>

<body>
    <form action="" method="post">
        <div>
            Kiểm tra mã OTP
        </div>
        <?php if (isset($error)) : ?>
            <h3><?= $error ?></h3>
        <?php endif ?>
        Nhập mã 6 số: <input type="text" name="code" id="">
        <br>
        <button type="submit">Xác nhận</button>
    </form>
</body>

</html>