<?php
//возвращаем массив всех пользователей и хэшей их паролей
function getUsersList(){
    
    $data = file_get_contents( 'data.txt' );
    $users = json_decode( $data, true );
    return $users;
    
}

//проверяем, существует ли пользователь с указанным логином
function existsUser($username){

    $users = (array)getUsersList();
    foreach ($users as $user => $items){
        if ($user === $username){
        return true;
        } 
    }
    return false;
}

//возвращает true тогда, когда существует пользователь с указанным логином 
//и введенный им пароль прошел проверку, иначе — false
function checkPassword($username, $password){

    $users = (array)getUsersList();
    foreach ($users as $user) {
        if (existsUser($username)) {
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
    }
    return false;
    
}

// возвращает либо имя вошедшего на сайт пользователя, либо null
function getCurrentUser(){
    return $_SESSION['currentUser'] ?? null;
}

//функция обратного отсчета до конца акции
function getTimeAct($date){

    $timeOff = $date - time();
    if($timeOff <= 0){
        return false;
    }

    $h = floor(($timeOff%86400)/3600);
    $m = floor(($timeOff%3600)/60);
    $s = $timeOff%60; 

    
    $str = declination('miss',$h,$m,$s);

    return $str;
}

//функция обратного отсчета до др
function getTimeBD($date){

    $fixedDate = strtotime(date('Y') . date('-m-d', $date));
    $today = strtotime( date ("Y-m-d",time()));
    if ($fixedDate < $today){
        $editFixed = strtotime(date("Y-m-d", strtotime("+1 years", $fixedDate)));
        $diff = $editFixed - $today;
    } else {
        $diff = $fixedDate - $today;
    }
    $d = floor($diff/86400);
    if ($d == 0){
        $str = 'С днем рождения! Дарим вам скидку 5% на все услуги!';
        $_SESSION['discount']=5;
    } else {
        $str = 'До вашего дня рождения'.declination($d,'miss','miss','miss');
    }
    
    return $str;

}

//функция для склонения временного остатка:
function declination($d,$h,$m,$s){

    $str = '';
    if ($d!== 'miss'){
        $str.=' '.$d;
        switch(substr($d, -1)){
            case 1: $str.=' день';
            break;
            case 2: case 3: case 4: $str.=' дня';
            break;
            default: $str.=' дней';
        }
    }
    if ($h!=='miss'){
        $str.=' '.$h;
        switch(substr($h, -1)){
            case 1: $str.=' час';
            break;
            case 2: case 3: case 4: $str.=' часа';
            break;
            default: $str.=' часов';
        }
    }
    if ($m!=='miss'){
        $str.=' '.$m;
        switch(substr($m, -1)){
            case 1: $str.=' минута';
            break;
            case 2: case 3: case 4: $str.=' минуты';
            break;
            default: $str.=' минут';
        }
    }
    if ($s!=='miss'){
        $str.=' '.$s;
        switch(substr($s, -1)){
            case 1: $str.=' секунда';
            break;
            case 2: case 3: case 4: $str.=' секунды';
            break;
            default: $str.=' секунд';
        }
    }
    $str.='.';
    return $str;

}


?>