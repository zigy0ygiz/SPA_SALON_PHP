<?php

session_start();

$data = file_get_contents( 'data.txt' );
$users = json_decode( $data, true );

$userBirthday = $_POST['birthday'] ?? null;
$username = $_SESSION['currentUser'];

$users[$username]['birthday'] = $userBirthday;
$_SESSION['userBirthday'] = $userBirthday;

file_put_contents( 'data.txt', json_encode( $users ) );

header('Location: index.php');

?>