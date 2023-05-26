<?php 
include('db.php'); 
session_start();
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"]) && isset($_GET["flight_id"])){
  $flight_id = $_GET["flight_id"];
  $sql_delete_flight = "DELETE FROM flight WHERE id = '". $flight_id ."'";
      $result = mysqli_query($conn, $sql_delete_flight);
      if($result) {
            header("Location: admin.php?id=". $_SESSION["id"]);
      }
}
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["approve"]) && isset($_GET["flight_id"])){
  $flight_id = $_GET["flight_id"];
  $sql_course = "UPDATE `flight` SET `status`='1' WHERE `id`=?";
    $stmt = $conn->prepare($sql_course);
    if (!$stmt) {
        echo "Помилка підготовки запиту: " . $conn->error;
        exit();
    }
    // Прив'язка параметрів та виконання запиту
    $stmt->bind_param("s", $flight_id);
    if (!$stmt->execute()) {
        echo "Помилка виконання запиту: " . $stmt->error;
        exit();
    }else{

      header("Location: admin.php?id=" . $_SESSION['id']);
    }
}
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cancel"]) && isset($_GET["flight_id"])){
  $flight_id = $_GET["flight_id"];
  $sql_course = "UPDATE `flight` SET `status`='0' WHERE `id`=?";
    $stmt = $conn->prepare($sql_course);
    if (!$stmt) {
        echo "Помилка підготовки запиту: " . $conn->error;
        exit();
    }
    // Прив'язка параметрів та виконання запиту
    $stmt->bind_param("s", $flight_id);
    if (!$stmt->execute()) {
        echo "Помилка виконання запиту: " . $stmt->error;
        exit();
    }else{

      header("Location: admin.php?id=" . $_SESSION['id']);
    }
}
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete_flight"]) && isset($_GET["flight_id"])){
  $flight_id = $_GET["flight_id"];
  $sql_delete_flight_type = "DELETE FROM flight_type WHERE id = '". $flight_id ."'";
      $result_flight_type = mysqli_query($conn, $sql_delete_flight_type);
  $sql_delete_flights = "DELETE FROM flight WHERE type_id = '". $flight_id ."'";
      $result = mysqli_query($conn, $sql_delete_flights);
      if($result_flight_type) {
            header("Location: admin.php?id=". $_SESSION["id"]);
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
        <h2 class="admin-section-block-title">Заявки</h2>
        <table class="main-table">
          <thead>
            <tr>
              <th class="table-name">Ім'я</th>
              <th class="table-flight">Рейс</th>
              <th class="table-phone">Телефон</th>
              <th class="table-date">Дата</th>
              <th class="table-status">Статус</th>
              <th class="table-action">Дії</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              // Запит SQL з використанням JOIN для об'єднання таблиць flight і flight_type
              $sql_flights = "SELECT f.*, u.phone AS user_phone, u.name AS user_name, ft.name AS flight_type_name
                FROM flight f
                JOIN users u ON f.user_id = u.id
                JOIN flight_type ft ON f.type_id = ft.id";
                      $result_flights = $conn->query($sql_flights);

              if ($result_flights->num_rows > 0) {
                  while ($row_flights = $result_flights->fetch_assoc()) {
                    if($row_flights["status"] == '1') {
                      $status = 'green';
                      $status_button = 'Скасувати';
                      $status_action = 'cancel';
                    }else {
                      $status = 'red';
                      $status_button = 'Підтвердити';
                      $status_action = 'approve';
                    }
                    
                    echo('<tr>
                            <td class="table-name">'. $row_flights["user_name"] .'</td>
                            <td class="table-flight">'. $row_flights["flight_type_name"] .'</td>
                            <td class="table-phone">'. $row_flights["user_phone"] .'</td>
                            <td class="table-date">'. $row_flights["date_flight"] .'</td>
                            <td class="table-status">
                              <div class="status status-'. $status .'"></div>
                            </td>
                            <td class="table-action">
                              <div class="table-action-list">
                                <a href="admin.php?delete=true&flight_id='. $row_flights["id"] .'" class="form-btn form-btn-small form-btn-remove table-action-btn">Видалити</a>
                                <a href="admin.php?'. $status_action .'=true&flight_id='. $row_flights["id"] .'" class="form-btn form-btn-small table-action-btn">'. $status_button .'</a>
                              </div>
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
    </div>
  </section>
  <section class="admin-section">
    <div class="wrapper admin-section-wrapper">
      <div class="admin-section-block">
        <h2 class="admin-section-block-title">Рейси <a href="admin-add-flight.php" class="form-btn form-btn-small">Добавити рейс</a></h2>
        <table class="main-table">
          <thead>
            <tr>
              <th class="table-name">Назва</th>
              <th class="table-action">Дії</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $sql_flights_type = "SELECT * FROM flight_type";
            $result_flights_type = $conn->query($sql_flights_type);

              if ($result_flights_type->num_rows > 0) {
                  while ($row_flights_type = $result_flights_type->fetch_assoc()) {
                    echo('<tr>
                            <td class="table-name">'. $row_flights_type["name"] .'</td>
                            <td class="table-action">
                              <div class="table-action-list">
                                <a href="admin.php?delete_flight=true&flight_id='. $row_flights_type["id"] .'" class="form-btn form-btn-small form-btn-remove table-action-btn">Видалити</a>
                                <a href="admin-edit-flight.php?flight_id='. $row_flights_type["id"] .'" class="form-btn form-btn-small table-action-btn">Редагувати</a>
                              </div>
                            </td>
                          </tr>');
                }
              }

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

</body>
</html>