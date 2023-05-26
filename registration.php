<?php include('db.php'); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $login = $_POST["login"];
  $name = $_POST["name"];
  $surname = $_POST["surname"];
  $password = $_POST["password"];
  $phone = $_POST["phone"];
   // Логіка реєстрації користувача

  // Перевірка, чи існує користувач з таким логіном
  $check_user_query = "SELECT * FROM users WHERE login = '". $login ."'";
  $check_user_result = $conn->query($check_user_query);

  if ($check_user_result->num_rows > 0) {
    echo "Користувач з таким логіном вже існує!";
  } else {
    // Вставка нового користувача в базу даних
    $insert_user_query = "INSERT INTO users (login, name, surname, phone, password) VALUES ('". $login ."', '". $name ."', '". $surname ."', '". $phone ."', '". $password ."')";
    session_start();
    if ($conn->query($insert_user_query) === TRUE) {
      $user_id_query = "SELECT * FROM users WHERE login = '". $login ."' AND password = '". $password ."'";
      $user_id_result = $conn->query($user_id_query);
      if ($user_id_result->num_rows > 0) {// Отримання ID користувача
        $user_row = $user_id_result->fetch_assoc();
        $user_id = $user_row["id"];
        $_SESSION["id"] = $user_id;
        header("Location: user.php?id=". $_SESSION["id"]);
      }
    } else {
      $error_text = "Помилка реєстрації<br><br>";
    }
  }
}

?>


<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, user-scalable=0">
<meta name="description" content="Spy mailen">
<title>Реєстрація - Українські авіалінії</title>
<link href="./css/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="javascript/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="javascript/main.js"></script>
</head>
<body>

<div id="root">
  <section class="main-section">
    <div class="wrapper main-section-wrapper">
      <h1 class="main-section-title"><span>Українські авіалінії:</span><br>Зануртеся у світ незабутніх чартерних польотів</h1>
      <form action="#" method="POST" class="main-section-form">
        <h3 class="main-form-title">Реєстрація</h3>
        <?php echo $error_text; ?>
        <label class="form-label">
          <p>Логін</p>
          <input type="text" name="login" class="text-el" required value="">
        </label>
        <label class="form-label">
          <p>Пароль</p>
          <input type="password" name="password" class="text-el" required value="">
        </label>
        <label class="form-label">
          <p>Ім'я</p>
          <input type="text" name="name" class="text-el" required value="">
        </label>
        <label class="form-label">
          <p>Прізвище</p>
          <input type="text" name="surname" class="text-el" required value="">
        </label>
        <label class="form-label">
          <p>Телефон для підтвердження заявки</p>
          <input type="number" name="phone" class="text-el" required value="">
        </label>
        <button type="submit" class="form-btn form-btn-el">Зареєструватись</button>
        <footer class="form-footer">
          <a href="index.php">Вхід</a>
        </footer>
      </form>
    </div>
  </section>
</div>

</body>
</html>