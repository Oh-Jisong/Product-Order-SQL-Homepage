<?php
header('Content-Type: text/html; charset=utf-8');
include "db.php";

$dow = isset($_POST["dow"]) ? (int)$_POST["dow"] : -1;
$hour = isset($_POST["hour"]) ? (int)$_POST["hour"] : -1;

$sql = "SELECT
          order_id, product_id, add_to_cart_order, reordered,
          user_id, eval_set, order_number, order_dow, order_hour_of_day, days_since_prior_order
        FROM v_order_products_with_order
        WHERE order_dow = ? AND order_hour_of_day = ?
        LIMIT 200";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "ii", $dow, $hour);
mysqli_stmt_execute($stmt);
$ret = mysqli_stmt_get_result($stmt);

if(!$ret){
  echo "조회 실패<br>";
  echo "실패 원인 :" . mysqli_error($con);
  exit();
}

echo "<h1>조회 결과</h1>";
echo "dow = {$dow}, hour = {$hour}<br><br>";
echo "<a href='main.html'>전체 메뉴로</a> | <a href='send.html'>다시 입력</a>";

echo "<br><br><table border='1'>";
echo "<tr>
        <th>order_id</th><th>product_id</th><th>add_to_cart_order</th><th>reordered</th>
        <th>user_id</th><th>eval_set</th><th>order_number</th><th>order_dow</th><th>order_hour_of_day</th><th>days_since_prior_order</th>
      </tr>";

while($row = mysqli_fetch_assoc($ret)){
  echo "<tr>";
  echo "<td>{$row['order_id']}</td>";
  echo "<td>{$row['product_id']}</td>";
  echo "<td>{$row['add_to_cart_order']}</td>";
  echo "<td>{$row['reordered']}</td>";
  echo "<td>{$row['user_id']}</td>";
  echo "<td>{$row['eval_set']}</td>";
  echo "<td>{$row['order_number']}</td>";
  echo "<td>{$row['order_dow']}</td>";
  echo "<td>{$row['order_hour_of_day']}</td>";
  echo "<td>{$row['days_since_prior_order']}</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_stmt_close($stmt);
mysqli_close($con);
?>