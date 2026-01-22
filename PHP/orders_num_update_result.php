<?php
header('Content-Type: text/html; charset=utf-8');
include "db.php";

$order_id = isset($_POST["order_id"]) ? (int)$_POST["order_id"] : 0;
$eval_set = isset($_POST["eval_set"]) ? $_POST["eval_set"] : "";
$order_number = isset($_POST["order_number"]) ? (int)$_POST["order_number"] : 0;
$order_dow = isset($_POST["order_dow"]) ? (int)$_POST["order_dow"] : -1;
$order_hour_of_day = isset($_POST["order_hour_of_day"]) ? (int)$_POST["order_hour_of_day"] : -1;

$ds = isset($_POST["days_since_prior_order"]) ? trim($_POST["days_since_prior_order"]) : "";
$days_since_prior_order = ($ds === "") ? null : (float)$ds;

if ($order_id <= 0 || $order_number <= 0 || $order_dow < 0 || $order_dow > 6 || $order_hour_of_day < 0 || $order_hour_of_day > 23) {
  echo "입력값이 올바르지 않습니다.<br>";
  echo "<a href='main.html'>메뉴로</a>";
  exit();
}

if (!in_array($eval_set, ["prior","train","test"], true)) {
  echo "eval_set 값이 올바르지 않습니다.<br>";
  echo "<a href='main.html'>메뉴로</a>";
  exit();
}

/* days_since_prior_order는 NULL 가능 */
$sql = "UPDATE orders
        SET eval_set = ?,
            order_number = ?,
            order_dow = ?,
            order_hour_of_day = ?,
            days_since_prior_order = ?
        WHERE order_id = ?";

$stmt = mysqli_prepare($con, $sql);

/* NULL 처리를 위해 bind 전에 타입 맞추기 */
if ($days_since_prior_order === null) {
  // mysqli에서 NULL 바인딩: 변수 자체를 null로 두고 'd'로 바인딩해도 동작하긴 하는데,
  // 환경별 이슈 줄이려면 SET ... = NULL 분기하는 게 더 안전함.
  $sql2 = "UPDATE orders
           SET eval_set = ?,
               order_number = ?,
               order_dow = ?,
               order_hour_of_day = ?,
               days_since_prior_order = NULL
           WHERE order_id = ?";
  $stmt2 = mysqli_prepare($con, $sql2);
  mysqli_stmt_bind_param($stmt2, "siiii", $eval_set, $order_number, $order_dow, $order_hour_of_day, $order_id);
  $ok = mysqli_stmt_execute($stmt2);
  mysqli_stmt_close($stmt2);
} else {
  mysqli_stmt_bind_param($stmt, "siiidi", $eval_set, $order_number, $order_dow, $order_hour_of_day, $days_since_prior_order, $order_id);
  $ok = mysqli_stmt_execute($stmt);
}

if ($ok) {
  echo "<h1>수정 성공</h1>";
  echo "order_id = {$order_id}<br><br>";
  echo "<a href='orders_num.html'>다른 주문 조회</a> | ";
  echo "<a href='main.html'>메뉴로</a>";
} else {
  echo "<h1>수정 실패</h1>";
  echo "실패 원인: " . htmlspecialchars(mysqli_error($con)) . "<br>";
  echo "<a href='main.html'>메뉴로</a>";
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>