<!doctype html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title>신규 매출 정보 입력</title>
</head>
<body>
  <h1>신규 매출 정보 입력 (order_products)</h1>

  <form method="post" action="insert_result.php">
    Order ID: <input type="number" name="order_id" required><br><br>
    Product ID: <input type="number" name="product_id" required><br><br>
    Add to Cart Order: <input type="number" name="add_to_cart_order" min="1" required><br><br>
    Reordered (0 or 1): <input type="number" name="reordered" min="0" max="1" required><br><br>

    <input type="submit" value="신규 입력">
  </form>

  <br>
  <a href="main.html">전체 메뉴로</a>
</body>
</html>