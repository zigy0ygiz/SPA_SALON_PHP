<?php
session_start();
include 'functions.php' ;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>INSPIRATION</title>
</head>

<body>
    
    <header>
        <h1>SPA-салон INSPIRATION</h1>
    </header>

    <nav>
        <section class="navigation">
            <a href="index.php">Главная</a>
            <a href="about.php">О нас</a>
        </section>

        <section class="entrance">
        
            <?php 
            
            $auth = $_SESSION['auth'] ?? null;
            $_SESSION['errorMsg'] = null;

            if($auth) {
                $currentUser = getCurrentUser();
echo <<<NOTLOGANUSER

Добро пожаловать, $currentUser !
<a href='logout.php'>
&#8676; Выйти
</a> 

NOTLOGANUSER;
            
            } else {

echo <<<LOGANUSER

Авторизуйтесь для получения персонального предложения
<a href='login.php'>
&#8677; Войти
</a>

LOGANUSER;
            }?>
      
        </section>

    </nav>


    <main>
        


        <section class="info">
            <h2>Контакты</h2>
            <address style="font-size: 18pt;">
            <b>Адресс:</b><br>
            012210, г. Москва,<br>
            ул. Цветочная, д. 54, офис 406<br>
            <b>тел.:</b> 8-800-20066-122<br>
            <b>e-mail.:</b> info@INSPIRATION.ru
            </address> 

        </section>

        
        
        <div class="copyright">
            Сopyright © SPA_INSPIRATION
        </div>
    </footer>
    
</body>
