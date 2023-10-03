<?php
include 'functions.php';
session_start();

$username = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

//ПАРОЛИ ПОЛЬЗОВАТЕЛЕЙ
// 'admin' => ['password' => '132'],
// 'mari1987' => ['password' => '132'],
// 'sohya1999' => ['password' => '132'],
// 'andrey1993' => ['password' => '132'],


$data = file_get_contents( 'data.txt' );
$users = json_decode( $data, true );

if (null !== $username && null !== $password) {

    if (checkPassword($username, $password)) {
        $_SESSION['auth'] = true; 
        $_SESSION['currentUser'] = $username;
        
        if ($users[$_SESSION['currentUser']]['datelog']){
            $_SESSION['date'] = $users[$_SESSION['currentUser']]['datelog'];
        }else {
            $_SESSION['date'] = time();
            $users[$_SESSION['currentUser']]['datelog']=$_SESSION['date'];
        }

        $_SESSION['userBirthday'] = $users[$_SESSION['currentUser']]['birthday'] ?? null;
        $_SESSION['discount'] = 2;

    } else {
        $_SESSION['errorMsg'] = 'Неверный логин или пароль';
    }
} else {
    $_SESSION['errorMsg'] = 'Введите данные для входа';
}

file_put_contents( 'data.txt', json_encode( $users ) );
    
$auth = $_SESSION['auth'] ?? null;

// если авторизованы
if ($auth) {
    header('Location: index.php');
} else {
    header('Location: login.php');
}

?>