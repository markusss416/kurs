<?php 
include('db.php'); 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["flight"])) {
  $flight_type = $_POST["flight"];
  $insert_flight_type = "INSERT INTO flight_type (name) VALUES ('". $flight_type ."')";
    
    if ($conn->query($insert_flight_type) === TRUE) {
        header("Location: admin.php?id=". $_SESSION["id"]);
      
    } else {
      echo "Помилка реєстрації користувача: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, user-scalable=0">
<meta name="description" content="Spy mailen">
<title>Особистий кабінет - Українські авіалінії</title>
<link href="./css/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="javascript/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="javascript/main.js"></script>
</head>
<body>

<div id="root">
  <section class="admin-section">
    <div class="wrapper admin-section-wrapper">
      <div class="admin-section-router">
        <a href="admin.php">на головну</a>
      </div>
      <h1 class="admin-section-title">Адмін панель</h1>
      <h3><?php echo ('<a href="index.php?id='. $_SESSION["id"] .'&exit=1" class="nav__link">Вийти</a>');?></h3>
      <hr>
      <div class="admin-section-block">
        <form action="admin-add-flight.php?id=<?php echo($_SESSION["id"]); ?>" method="POST" class="main-section-form">
          <h3 class="main-form-title">Добавлення рейсу</h3>
          <label class="form-label">
            <p>Назва рейсу</p>
            <input type="text" name="flight" class="text-el" value="">
          </label>
          <button type="submit" class="form-btn form-btn-el">Добавити</button>
        </form>
      </div>
    </div>
  </section>
</div>

</body>
</html>