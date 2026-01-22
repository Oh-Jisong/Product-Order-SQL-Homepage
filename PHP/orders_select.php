<?php
header('Content-Type: text/html; charset=utf-8');
include "db.php";

$sql = "SELECT
          order_id,
          user_id,
          eval_set,
          order_number,
          order_dow,
          order_hour_of_day,
          days_since_prior_order
        FROM orders
        LIMIT 200";

$ret = mysqli_query($con, $sql);

if(!$ret){
  echo "orders 데이터 조회 실패<br>";
  echo "실패 원인 :" . mysqli_error($con);
  exit();
}

echo "<h1>Orders 정보</h1>";
echo "<a href='main.html'>전체 메뉴 화면으로 돌아가기</a>";

echo "<table border='1'>";
echo "<tr>
        <th>order_id</th>
        <th>user_id</th>
        <th>eval_set</th>
        <th>order_number</th>
        <th>order_dow</th>
        <th>order_hour_of_day</th>
        <th>days_since_prior_order</th>
      </tr>";

while($row = mysqli_fetch_assoc($ret)){
  echo "<tr>";
  echo "<td>{$row['order_id']}</td>";
  echo "<td>{$row['user_id']}</td>";
  echo "<td>{$row['eval_set']}</td>";
  echo "<td>{$row['order_number']}</td>";
  echo "<td>{$row['order_dow']}</td>";
  echo "<td>{$row['order_hour_of_day']}</td>";
  echo "<td>{$row['days_since_prior_order']}</td>";
  echo "</tr>";
}

echo "</table>";
mysqli_close($con);
?>
