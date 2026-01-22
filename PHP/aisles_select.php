<?php
include "db.php";

$sql = "SELECT * FROM aisles";
$ret = mysqli_query($con, $sql);

if(!$ret){
  echo "aisles 데이터 조회 실패<br>";
  echo "실패 원인 :" . mysqli_error($con);
  exit();
}

echo "<h1>Aisles 정보</h1>";
echo "<a href='main.html'>전체 메뉴 화면으로 돌아가기</a>";

echo "<table border='1'>";
echo "<tr><th>Aisles ID</th><th>Aisles NAME</th></tr>";

while($row = mysqli_fetch_assoc($ret)){
  echo "<tr>";
  echo "<td>{$row['aisle_id']}</td>";
  echo "<td>{$row['aisle']}</td>";
  echo "</tr>";
}

echo "</table>";
mysqli_close($con);
?>