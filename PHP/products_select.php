<?php
header('Content-Type: text/html; charset=utf-8');
include "db.php";

$sql = "SELECT
          p.product_id,
          p.product_name,
          p.aisle_id,
          a.aisle,
          p.department_id,
          d.department
        FROM products p
        JOIN aisles a
          ON p.aisle_id = a.aisle_id
        JOIN departments d
          ON p.department_id = d.department_id
        LIMIT 200";

$ret = mysqli_query($con, $sql);

if(!$ret){
  echo "products 데이터 조회 실패<br>";
  echo "실패 원인 :" . mysqli_error($con);
  exit();
}

echo "<h1>Products 정보</h1>";
echo "<a href='main.html'>전체 메뉴 화면으로 돌아가기</a>";

echo "<table border='1'>";
echo "<tr>
        <th>product_id</th>
        <th>product_name</th>
        <th>aisle_id</th>
        <th>aisle</th>
        <th>department_id</th>
        <th>department</th>
      </tr>";

while($row = mysqli_fetch_assoc($ret)){
  echo "<tr>";
  echo "<td>{$row['product_id']}</td>";
  echo "<td>{$row['product_name']}</td>";
  echo "<td>{$row['aisle_id']}</td>";
  echo "<td>{$row['aisle']}</td>";
  echo "<td>{$row['department_id']}</td>";
  echo "<td>{$row['department']}</td>";
  echo "</tr>";
}

echo "</table>";
mysqli_close($con);
?>
