<?php
header('Content-Type: text/html; charset=utf-8');
include "db.php";

$order_id = isset($_GET["order_id"]) ? (int)$_GET["order_id"] : 0;

if ($order_id <= 0) {
  echo "order_id가 올바르지 않습니다.<br>";
  echo "<a href='orders_num.html'>돌아가기</a>";
  exit();
}

$sql = "SELECT
          order_id, user_id, eval_set, order_number,
          order_dow, order_hour_of_day, days_since_prior_order
        FROM orders
        WHERE order_id = ?";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $order_id);
mysqli_stmt_execute($stmt);
$ret = mysqli_stmt_get_result($stmt);

if(!$ret || mysqli_num_rows($ret) == 0){
  echo "해당 order_id의 주문이 없습니다.<br>";
  echo "<a href='orders_num.html'>돌아가기</a>";
  exit();
}

$row = mysqli_fetch_assoc($ret);
?>
<!doctype html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title>주문 정보 수정</title>
</head>
<body>
  <h1>주문 정보 수정</h1>

  <form method="post" action="orders_num_update_result.php">
    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">

    order_id: <?php echo $row['order_id']; ?><br><br>
    user_id(참고): <?php echo $row['user_id']; ?><br><br>

    eval_set:
    <select name="eval_set" required>
      <option value="prior" <?php if($row['eval_set']=="prior") echo "selected"; ?>>prior</option>
      <option value="train" <?php if($row['eval_set']=="train") echo "selected"; ?>>train</option>
      <option value="test"  <?php if($row['eval_set']=="test")  echo "selected"; ?>>test</option>
    </select>
    <br><br>

    order_number: <input type="number" name="order_number" min="1" value="<?php echo $row['order_number']; ?>" required><br><br>
    order_dow(0~6): <input type="number" name="order_dow" min="0" max="6" value="<?php echo $row['order_dow']; ?>" required><br><br>
    order_hour_of_day(0~23): <input type="number" name="order_hour_of_day" min="0" max="23" value="<?php echo $row['order_hour_of_day']; ?>" required><br><br>

    days_since_prior_order(없으면 빈칸):
    <input type="text" name="days_since_prior_order" value="<?php echo ($row['days_since_prior_order'] === NULL ? "" : $row['days_since_prior_order']); ?>">
    <br><br>

    <input type="submit" value="수정 반영">
  </form>

  <br>
  <a href="orders_num.html">다른 order_id 조회</a> |
  <a href="main.html">전체 메뉴로</a>
</body>
</html>
<?php
mysqli_stmt_close($stmt);
mysqli_close($con);
?>