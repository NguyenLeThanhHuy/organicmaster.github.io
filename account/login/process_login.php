<?php
$email = $msg = '';
if(!empty($_POST)) {
    $email = getPost('email');
    $pwd = getPost('password'); 
    // Check email có đúng với thông tin đã đăng kí không
    $sql = "SELECT * FROM user WHERE email='$email' and password='$pwd'";
    $userExist = executeResult($sql,true);
    if($userExist == null) {
        $msg = '*Đăng nhập không thành công,vui lòng kiểm tra lại thông tin';
    }else {
        $_SESSION['email'] = $email;
        header('Location: ../../');
        die();
    }
}
