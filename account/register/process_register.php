<?php 
$fullname = $email = $msg = '';
if(!empty($_POST)) {
    $fullname = getPost('fullname');
    $email = getPost('email');
    $pwd = getPost('password');
    if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd) <6) {
    } else {
        $userExist = executeResult("SELECT * FROM user WHERE email = '$email'",true);
        if($userExist != null) {
            $msg = '*Email đã được đăng ký,vui lòng đăng ký lại';
        } else {
            $sql = "INSERT INTO user (fullname,email,password,role_id) VALUES ('$fullname','$email','$pwd',2)";
            execute($sql);
            $_SESSION['email'] = $email;
            header('Location: ../../');
            die();
        }
    }
}
