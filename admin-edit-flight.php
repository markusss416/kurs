<?php 
include('db.php'); 
session_start();

$flight_id = $_GET["flight_id"];
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["flight_id"])) {
  $flight_type_sql = "SELECT * FROM flight_type WHERE id='". $flight_id ."'";
  $result_flights = $conn->query($flight_type_sql);
    $row_flight_type = $result_flights->fetch_assoc();
    $flight_name = $row_flight_type["name"];
  
  
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["flight"])) {
  $flight = $_POST["flight"];
  $sql_flight = "UPDATE `flight_type` SET `name`=? WHERE `id`=?";
    $stmt = $conn->prepare($sql_flight);
    if (!$stmt) {
        echo "Помилка підготовки запиту: " . $conn->error;
        exit();
    }
    // Прив'язка параметрів та виконання запиту
    $stmt->bind_param("ss", $flight, $flight_id);
    if (!$stmt->execute()) {
        echo "Помилка виконання запиту: " . $stmt->error;
        exit();
    }else{

      header("Location: admin.php?id=" . $_SESSION['id']);
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
        <form action="#" method="POST" class="main-section-form">
          <h3 class="main-form-title">Редагування рейсу</h3>
          <label class="form-label">
            <p>Назва рейсу</p>
            <input type="text" name="flight" class="text-el" value="<?php echo $flight_name; ?>">
          </label>
          <button type="submit" class="form-btn form-btn-el">Змінити</button>
        </form>
      </div>
    </div>
  </section>
</div>

</body>
</html>