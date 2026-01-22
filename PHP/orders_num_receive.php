<?php
header('Content-Type: text/html; charset=utf-8');
include "db.php";

$ID = isset($_POST["orderID"]) ? (int)$_POST["orderID"] : 0;

echo "<h1>주문 조회 결과</h1>";
echo "입력 order_id : " . $ID . "<br><br>";

if ($ID <= 0) {
  echo "order_id가 올바르지 않습니다.<br>";
  echo "<a href='orders_num.html'>다시 입력하기</a>";
  exit();
}

/* 1) orders 테이블에서 주문 1건 조회 */
$sql_o = "SELECT
            order_id, user_id, eval_set, order_number,
            order_dow, order_hour_of_day, days_since_prior_order
          FROM orders
          WHERE order_id = ?";

$stmt_o = mysqli_prepare($con, $sql_o);
mysqli_stmt_bind_param($stmt_o, "i", $ID);
mysqli_stmt_execute($stmt_o);
$ret_o = mysqli_stmt_get_result($stmt_o);

if(!$ret_o){
  echo "orders 조회 실패<br>";
  echo "실패 원인 :" . mysqli_error($con);
  exit();
}

if(mysqli_num_rows($ret_o) == 0){
  echo "orders 테이블에 해당 order_id가 없습니다.<br>";
  echo "<br><a href='orders_num.html'>다시 입력하기</a>";
  echo "<br><a href='main.html'>메뉴로</a>";
  mysqli_stmt_close($stmt_o);
  mysqli_close($con);
  exit();
}

$o = mysqli_fetch_assoc($ret_o);

echo "<h2>주문 기본 정보 (orders)</h2>";
echo "<table border='1'>";
echo "<tr>
        <th>order_id</th><th>user_id</th><th>eval_set</th><th>order_number</th>
        <th>order_dow</th><th>order_hour_of_day</th><th>days_since_prior_order</th>
      </tr>";
echo "<tr>";
echo "<td>{$o['order_id']}</td>";
echo "<td>{$o['user_id']}</td>";
echo "<td>{$o['eval_set']}</td>";
echo "<td>{$o['order_number']}</td>";
echo "<td>{$o['order_dow']}</td>";
echo "<td>{$o['order_hour_of_day']}</td>";
echo "<td>{$o['days_since_prior_order']}</td>";
echo "</tr>";
echo "</table>";

echo "<br><a href='orders_num_update.php?order_id={$ID}'>이 주문 정보 수정하기</a>";
echo " | <a href='main.html'>전체 메뉴로</a>";

/* 2) 해당 주문에 담긴 상품 목록 조회 */
$sql_p = "SELECT
            order_id, product_id, add_to_cart_order, reordered
          FROM order_products
          WHERE order_id = ?
          ORDER BY add_to_cart_order ASC";

$stmt_p = mysqli_prepare($con, $sql_p);
mysqli_stmt_bind_param($stmt_p, "i", $ID);
mysqli_stmt_execute($stmt_p);
$ret_p = mysqli_stmt_get_result($stmt_p);

echo "<h2>이 주문의 상품 목록 (order_products)</h2>";

if(!$ret_p){
  echo "order_products 조회 실패<br>";
  echo "실패 원인 :" . mysqli_error($con);
  exit();
}

if(mysqli_num_rows($ret_p) == 0){
  echo "이 주문에 연결된 상품이 없습니다.<br>";
} else {
  echo "<table border='1'>";
  echo "<tr><th>order_id</th><th>product_id</th><th>add_to_cart_order</th><th>reordered</th></tr>";

  while($row = mysqli_fetch_assoc($ret_p)){
    echo "<tr>";
    echo "<td>{$row['order_id']}</td>";
    echo "<td>{$row['product_id']}</td>";
    echo "<td>{$row['add_to_cart_order']}</td>";
    echo "<td>{$row['reordered']}</td>";
    echo "</tr>";
  }
  echo "</table>";
}

mysqli_stmt_close($stmt_o);
mysqli_stmt_close($stmt_p);
mysqli_close($con);
?>