<!doctype html>
<html lang="ru">
<head>
  <title>Админ-панель</title>
</head>
<body>
<?php
  $host = 'localhost';  // Хост, у нас все локально
  $user = 'root';    // Имя созданного вами пользователя
  $pass = ''; // Установленный вами пароль пользователю
  $db_name = 'my_db';   // Имя базы данных
  $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

  // Ругаемся, если соединение установить не удалось
  if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
  }
?>
    <?php
  //Если переменная Name передана
  if (isset($_POST["Name"])) {
    //Вставляем данные, подставляя их в запрос
    $sql = mysqli_query($link, "INSERT INTO `products` (`Name`, `Price`) VALUES ('{$_POST['Name']}', '{$_POST['Price']}')");
    //Если вставка прошла успешно
    if ($sql) {
      echo '<p>Данные успешно добавлены в таблицу.</p>';
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }
?>
<form action="" method="post">
  <table>
    <tr>
      <td>Наименование:</td>
      <td><input type="text" name="Name"></td>
    </tr>
    <tr>
      <td>Цена:</td>
      <td><input type="text" name="Price" size="3"> руб.</td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="OK"></td>
    </tr>
  </table>
</form>
<?php
  //Получаем данные
  $sql = mysqli_query($link, 'SELECT `ID`, `Name` FROM `products`');
  while ($result = mysqli_fetch_array($sql)) {
      echo "{$result['ID']}) {$result['Name']} - <a href='?del={$result['ID']}'>Удалить</a><br>";
  }
?>
  <?php
  //Получаем данные
  $sql = mysqli_query($link, 'SELECT `ID`, `Name` FROM `products`');
  while ($result = mysqli_fetch_array($sql)) {
      echo "{$result['ID']}) {$result['Name']} - <a href='?del={$result['ID']}'>Удалить</a><br>";
  }
?>
    </body>
</html>
