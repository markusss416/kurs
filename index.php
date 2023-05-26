<?php 
include "db.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['exit'])) {
  session_unset();
  session_destroy();
  header("Location: /");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $login = $_POST["login"];
  $password = $_POST["password"];
   // Логіка реєстрації користувача

  // Перевірка, чи існує користувач з таким логіном
  $check_user_query = "SELECT * FROM users WHERE login = '". $login ."' AND password = '". $password ."'";
  $check_user_result = $conn->query($check_user_query);
  if ($check_user_result->num_rows > 0) {
    $user_row = $check_user_result->fetch_assoc();
    $user_id = $user_row["id"];
    $_SESSION["id"] = $user_id;
    if($login == 'admin'){
      header("Location: admin.php?id=". $_SESSION["id"]);
    } else {
      header("Location: user.php?id=". $_SESSION["id"]);
    }
  } else {
    $error_text = "Помилка входу<br><br>";
  }
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, user-scalable=0">
<meta name="description" content="Spy mailen">
<title>Українські авіалінії</title>
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
        <h3 class="main-form-title">Вхід</h3>
        <?php echo $error_text; ?>
        <label class="form-label">
          <p>Логін</p>
          <input type="text" name="login" class="text-el" required value="">
        </label>
        <label class="form-label">
          <p>Пароль</p>
          <input type="password" name="password" class="text-el" required value="">
        </label>
        <button type="submit" class="form-btn form-btn-el">Увійти</button>
        <footer class="form-footer">
          <a href="registration.php">Зареєструватись</a>
        </footer>
      </form>
    </div>
  </section>
</div>

</body>
</html>