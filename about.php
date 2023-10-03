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
            <a href="contacts.php">Контакты</a>
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
            <img src="/images/Spa.jpg" alt="INSPIRATION" width=250px height=250px >
            <h2>О нас</h2>
            <div>
            Мы - спа-салон с хорошей репутацией, который предоставляет высококачественные услуги по уходу за кожей и телом. 
            <br>Наша команда состоит из высококвалифицированных специалистов, которые используют только самые лучшие косметические средства и технологии для достижения максимального эффекта.
            <br>Мы предлагаем широкий спектр услуг, включая массаж, обертывания, пилинги, программы по уходу за лицом и телом, а также индивидуальные процедуры. 
            <br>Все наши специалисты имеют высокую квалификацию и опыт работы в индустрии красоты.
            <br>Наша цель - помочь нашим клиентам достичь максимального расслабления и улучшения состояния кожи и тела. 
            <br>Мы гарантируем высокое качество услуг и индивидуальный подход к каждому клиенту.
            <br>Если вы ищете качественный спа-салон в вашем городе, то мы будем рады видеть вас у нас. 
            <br>Свяжитесь с нами, чтобы узнать больше о наших услугах и забронировать свою первую процедуру.
            </div>

        </section>

        
        
        <div class="copyright">
            Сopyright © SPA_INSPIRATION
        </div>
    </footer>
    
</body>
