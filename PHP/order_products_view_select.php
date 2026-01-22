<?php
ini_set("display_errors", 0);

include "db.php";
  or die("MySQL 접속 실패");

$sql = "SELECT * FROM v_order_products_with_order LIMIT 200";
$ret = mysqli_query($con, $sql);

if(!$ret) {
  echo "조회 실패<br>";
  echo "실패 원인: " . mysqli_error($con);
  exit();
}

echo "<h1>Order Products (with Orders info)</h1>";
echo "<a href='main.html'>메뉴로</a><br><br>";

echo "<table border='1'>";
echo "<tr>
        <th>order_id</th>
        <th>product_id</th>
        <th>add_to_cart_order</th>
        <th>reordered</th>
        <th>user_id</th>
        <th>eval_set</th>
        <th>order_number</th>
        <th>order_dow</th>
        <th>order_hour_of_day</th>
        <th>days_since_prior_order</th>
      </tr>";

while($row = mysqli_fetch_assoc($ret)) {
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

mysqli_close($con);
?>