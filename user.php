<?php 
include('db.php'); 
session_start();
$user_id = $_SESSION["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["flight"]) && isset($_POST["date"])) {
  $flight = $_POST["flight"];
  $date = $_POST["date"];
  $insert_flight_query = "INSERT INTO flight (type_id, user_id, date_flight) VALUES ('". $flight ."', '". $user_id ."', '". $date ."')";
    if ($conn->query($insert_flight_query) === TRUE) {
      header("Location: user.php?id=". $_SESSION["id"]);
    } else {
      echo "Помилка замовлення: " . $conn->error;
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
      <h1 class="admin-section-title">Адмін панель</h1>
      <h3><?php echo ('<a href="index.php?id='. $_SESSION["id"] .'&exit=1" class="nav__link">Вийти</a>');?></h3>
      <hr>
      <div class="admin-section-block">
        <h2 class="admin-section-block-title">Мої замовлення</h2>
        <table class="main-table">
          <thead>
            <tr>
              <th class="table-flight">Рейс</th>
              <th class="table-date">Дата</th>
              <th class="table-status">Статус</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              // Запит SQL з використанням JOIN для об'єднання таблиць flight і flight_type
              $sql_my_flight = "SELECT f.*, (SELECT name FROM flight_type WHERE id = f.type_id) AS flight_type_name
        FROM flight f
        WHERE f.user_id = '".$user_id."'";
                      $result_my_flight = $conn->query($sql_my_flight);

              if ($result_my_flight->num_rows > 0) {
                  while ($row_my_flight = $result_my_flight->fetch_assoc()) {
                    if($row_my_flight["status"] == 1){
                      $status = 'green';
                    }else {
                      $status = 'red';
                    }
                    echo('<tr>
                      <td class="table-flight">'. $row_my_flight["flight_type_name"] .'</td>
                      <td class="table-date">'. $row_my_flight["date_flight"] .'</td>
                      <td class="table-status">
                        <div class="status status-'. $status .'"></div>
                      </td>
                    </tr>');
                  }
              } else {
                  echo "Немає результатів.";
              }
            ?>
          </tbody>
        </table>
      </div>
      <div class="admin-section-block">
        <form action="user.php?id=<?php echo($_SESSION["id"]); ?>" method="POST" class="main-section-form">
          <h3 class="main-form-title">Замовити чартер</h3>
          <label class="form-label">
            <p>Рейс</p>
            <select name="flight" class="text-el">
              <?php
                $sql_select = 'SELECT * FROM flight_type';
                $result_select = mysqli_query($conn, $sql_select);
                // Обробка результату запиту
                if (mysqli_num_rows($result_select) > 0) {
                  // Виведення результату запиту
                  while($row_select = mysqli_fetch_assoc($result_select)) {
                    echo '<option value="'. $row_select["id"] .'">'. $row_select["name"] .'</option>';
                  }
                } else {
                  echo "Результатів не знайдено";
                }
              ?>
            </select>
          </label>
          <label class="form-label">
            <p>Дата</p>
            <input type="date" name="date" class="text-el" required value="">
          </label>
          <button type="submit" class="form-btn form-btn-el">Замовити</button>
        </form>
      </div>
    </div>
  </section>
</div>

</body>
</html>