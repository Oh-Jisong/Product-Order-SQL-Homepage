<?php
header('Content-Type: text/html; charset=utf-8');
include "db.php";

$order_id = isset($_POST["order_id"]) ? (int)$_POST["order_id"] : 0;
$product_id = isset($_POST["product_id"]) ? (int)$_POST["product_id"] : 0;
$add_to_cart_order = isset($_POST["add_to_cart_order"]) ? (int)$_POST["add_to_cart_order"] : 0;
$reordered = isset($_POST["reordered"]) ? (int)$_POST["reordered"] : 0;

if ($order_id <= 0 || $product_id <= 0 || $add_to_cart_order <= 0 || !in_array($reordered, [0,1], true)) {
  echo "입력값이 올바르지 않습니다.<br>";
  echo "<a href='insert.php'>뒤로</a>";
  exit();
}

$sql = "INSERT INTO order_products (order_id, product_id, add_to_cart_order, reordered)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "iiii", $order_id, $product_id, $add_to_cart_order, $reordered);

try {
  mysqli_stmt_execute($stmt);
  echo "<h1>입력 성공</h1>";
  echo "order_id = {$order_id}<br>";
  echo "product_id = {$product_id}<br>";
  echo "<br><a href='order_product_date_select.php'>(3) 조회로 이동</a>";
  echo "<br><a href='insert.php'>추가 입력</a>";
  echo "<br><a href='main.html'>메뉴로</a>";
} catch (mysqli_sql_exception $e) {
  echo "<h1>입력 실패</h1>";
  echo "오류: " . htmlspecialchars($e->getMessage()) . "<br><br>";

  echo "※ 자주 나오는 원인<br>";
  echo "- orders 테이블에 없는 order_id를 넣음(FK)<br>";
  echo "- products 테이블에 없는 product_id를 넣음(FK)<br>";
  echo "- (order_id, product_id) 조합이 이미 존재(중복 PK)<br><br>";

  echo "<a href='insert.php'>뒤로</a>";
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>
