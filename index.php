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

    <!-- Навигация -->
    <nav>
        <section class="navigation">
            <a href="about.php">О нас</a>
            <a href="contacts.php">Контакты</a>
        </section>

        <section class="entrance">
        
            <?php 
            
            $auth = $_SESSION['auth'] ?? null;
            $_SESSION['errorMsg'] = null;
// Вход/выход пользователя
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

    <!-- Информация о персональных скидках -->
    <section class="personal_offer">
            <div class="stock" >
                <?php

                // Обратный отсчет по истечению персонально скидки
                if($_SESSION['auth']) {
                    $dateLog = $_SESSION['date'];
                    $dateAct = $dateLog + 86400;
                    $infoTime =  getTimeAct($dateAct);
                    if ($infoTime){
                        echo "До истечения персональной скидки осталось $infoTime";
                        $disc = $_SESSION['discount']; 
                    }
                    echo "<p>Ваша скидка - $disc %</p>";
                
                ?>
            </div>
            <div class="stock">
                <?php
                if(!$_SESSION['userBirthday']){
                ?>

                <!-- Ввод др, проверка остатка дней до др, поздравление пользователя -->
                <form action="addBirthday.php" method="post">
                    <p>Получите скидку в день рождение на услуги салона 5% </p>
                    <div class="input_data">
                        <label for="birthday">Дата рождения</label>
                        <input name="birthday" type="date">
                    </div>
                    <div class="entry">
                        <input name="submit" type="submit" value="сохранить">
                    </div>

                <?php
                }else {
                    $dateBirthday = strtotime($_SESSION['userBirthday']);
                    $infoDB =  getTimeBD($dateBirthday);
                    echo "$infoDB";
                }
            } else {
                echo "Получите скидку 2% после авторизации!";
                
            }
                ?>
            </div>

            
        </section>

    <!-- Основной раздел -->
    <main>
        


        <section class="info">
            <img src="/images/INSPIRATION.jpg" alt="INSPIRATION" width=250px height=250px >
            <h2>Вдохновляйтесь в spa-салоне INSPIRATION!</h2>
            <div>
                Spa-салон "INSPIRATION" - это место, где каждый может найти свое вдохновение. Здесь вы сможете расслабиться и забыть о повседневных заботах, насладиться приятной атмосферой и получить профессиональный уход за своим телом.
                <br>В салоне "INSPIRATION" работают только опытные специалисты, которые знают, как сделать ваш отдых максимально комфортным и полезным. Они предложат вам широкий выбор процедур, таких как массаж, обертывания, пилинги, а также различные виды спа-процедур для лица и тела.
                <br>Каждый клиент может выбрать процедуру, которая подходит именно ему. Например, если вы хотите расслабиться и отдохнуть, то можно выбрать массаж или ароматерапию. Если же вы хотите получить более интенсивный уход, то можно обратиться к процедурам, которые направлены на улучшение тонуса кожи и уменьшение целлюлита.
                <br>Если вы хотите отдохнуть и расслабиться, то спа-салон "INSPIRATION" станет прекрасным местом для этого. Здесь вы найдете все необходимое для того, чтобы отдохнуть и получить удовольствие от процедур.
            </div>

        </section>

        <section class="product">
            <h2>НАШИ ПРОЦЕДУРЫ</h2>
            <?php

            $data = file_get_contents( 'product.txt' );
            $product = json_decode( $data, true );
           
            //Услуги 
            for ($i=1;$i<=count($product);$i++){
                $disc = $_SESSION['discount'];
                $name = $product[$i]['name'];
                $description = $product[$i]['description'];
                $imgPath = $product[$i]['imgPath'];
                
                if($auth){
                    $price = floor($product[$i]['price'] - $product[$i]['price']* $disc/100);
                }else{
                    $price = $product[$i]['price'];
                }
                
                echo "<div class='services'>
                    
                    <div>
                    <img src='$imgPath' alt='INSPIRATION' width=150px height=150px >
                    <h3>$name</h3>
                    <div>$description</div>
                    <div class='price'>Цена - $price р.</div>
                    </div>
                
                </div>";
            }

            ?>

        </section>
    </main>

    <!-- Подвал -->
    <footer>
        
        <div class="copyright">
            Сopyright © SPA_INSPIRATION
        </div>
    </footer>
    
</body>
