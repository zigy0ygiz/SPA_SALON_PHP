  <html>
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>spa</title>
  </head>
  <body>

    <form action="process_login.php" method="post" class="enter">
      <div class="logpas">
        <div class="input_data">
          <label for="login">Логин</label>
          <input name="login" type="text" >
        </div>
        <div class="input_data">
          <label for="password">Пароль</label>
          <input name="password" type="password">
        </div>
        <div class="entry">
          <input name="submit" type="submit" value="Войти">
        </div>
        <!-- <div>
        <a href='registration.php'>Зарегистрироваться</a>
        </div> -->
        <div>
          <?php
          session_start();
          $msg = $_SESSION['errorMsg'] ?? null;
          if ($msg) {
            echo "$msg".PHP_EOL;
            echo "<a href='index.php'>Продолжить без авторизации</a>";
        } 
          ?>
        </div>
      </div>
    </form>  

  </body>
  </html>

?>