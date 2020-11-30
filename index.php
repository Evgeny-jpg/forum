<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">    
<meta name="viewport"
      content="width=device-width,user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    
<style>    
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
            }
    body {
        margin: 30px;
        font-family: Arial, sans-serif;
    }
    input, textarea {
        margin: 5px;
        width: 300px;
    }
    form {
        display: flex;
        flex-direction: column;
    }
</style>        
    <form action="" method="POST">
    <input type="text" name="username" placeholder="Ваше имя">
    <textarea name="comment" cols="30" rows="5" placeholder="Ваш комментарий"></textarea>
    <input type="submit">
    </form>    
<hr>    
    <h2>Форум</h2> 

<?php
    $host = 'localhost';  
    $user = 'root';    
    $pass = ''; 
    $db_name = 'myforum1';  
    $link = mysqli_connect($host, $user, $pass, $db_name);
 
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }
  
    if (isset($_POST["username"]) && ($_POST["username"]!='')) {

    $date=date("Y-m-d H:i:s");
      $sql = mysqli_query($link, "INSERT INTO `comments` (`username`, `comment`,`data`) VALUES ('{$_POST['username']}', '{$_POST['comment']}','$date')");
    if ($sql) {
      echo '<p>Данные успешно добавлены в таблицу.</p>';
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }
?>
  <?php

  $sql = mysqli_query($link, 'SELECT `username`, `comment`, `data` FROM `comments` ORDER BY `data` DESC');
  while ($result = mysqli_fetch_array($sql)) {
      echo "{$result['data']} {$result['username']} оставил(а) комментарий: {$result['comment']} <br>";
  }
?> 


    
</body>
</html>