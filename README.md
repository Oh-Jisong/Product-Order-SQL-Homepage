# Instacart DB Web Practice Project

PHP와 MySQL을 사용하여 주문(Order) 데이터 조회 및 관리 기능을 구현한 개인 학습용 웹 프로젝트입니다.  
단순 과제 목적이 아니라 **데이터베이스 설계, SQL 작성, PHP-MySQL 연동 흐름을 직접 학습하기 위해 개인적으로 구현한 실습 프로젝트**입니다.

---

## 목차

- [Project Overview](#project-overview)
- [Project Features](#project-features)
  - [Data 조회 기능](#data-조회-기능)
  - [조건 기반 조회](#조건-기반-조회)
  - [데이터 관리 기능](#데이터-관리-기능)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Database Configuration](#database-configuration)
- [Execution Method](#execution-method)
- [기능 예시/설명](#기능-예시설명)
- [What I Learned](#what-i-learned)
- [향후 계획](#향후-계획)
- [Author](#author)
- [Note](#note)
- [깃헙 업로드 순서](#깃헙-업로드-순서)

---

## Project Overview

이 프로젝트는 공개 Instacart 주문 데이터 구조를 기반으로 다음 목표를 가지고 제작되었습니다.

- 관계형 데이터베이스 테이블 구조 설계
- 외래키 기반 데이터 무결성 관리
- PHP를 이용한 MySQL 연동 실습
- 웹 페이지 기반 데이터 조회 및 입력 기능 구현
- 실제 서비스 흐름과 유사한 CRUD 구조 이해

---

## Project Features

### Data 조회 기능

- Aisles 테이블 조회
- Departments 테이블 조회
- Orders 테이블 조회
- Products 테이블 조회
- 주문 + 상품 + 날짜 기반 통합 조회

---

### 조건 기반 조회

- 요일(Day of Week) + 시간대(Hour) 기반 주문 데이터 조회
- 특정 Order ID 입력 후 해당 주문 데이터 조회

---

### 데이터 관리 기능

- 신규 주문 데이터 입력
- Order ID 기반 데이터 수정

---

## Tech Stack

- **Backend**: PHP (mysqli)
- **Database**: MySQL (InnoDB)
- **Server**: Apache (XAMPP)
- **Frontend**: HTML (Basic UI)

---

## Project Structure
```bash
order_page/
┣ PHP/
┃ ┣ db.php
┃ ┣ main.html
┃ ┣ aisles_select.php
┃ ┣ departments_select.php
┃ ┣ orders_select.php
┃ ┣ products_select.php
┃ ┣ order_product_date_select.php
┃ ┣ send.html
┃ ┣ receive.php
┃ ┣ insert.php
┃ ┣ insert_result.php
┃ ┣ orders_num.html
┃ ┣ orders_num_receive.php
┃ ┣ orders_num_update.php
┗ SQL/
┣ aisles.sql
┣ departments.sql
┣ orders.sql
┣ products.sql
┣ order_products.sql
```

---
## Database Configuration

### DB Name
```
hmwkdb
```

### db.php Example

```php
<?php
$con = mysqli_connect("localhost", "root", "", "hmwkdb");
mysqli_set_charset($con, "utf8");

if(!$con){
  die("DB 연결 실패: ".mysqli_connect_error());
}
?>
```

---

## Execution Method

### XAMPP 실행

* Apache Start

* MySQL Start

### 프로젝트 이동 경로
```
C:\xampp\htdocs\order_page\PHP
```

### 브라우저 접속
```
http://localhost/order_page/PHP/main.html
```

---

## 기능 예시/설명

| 기능             | 설명              |
| -------------- | --------------- |
| Aisles 조회      | 상품 진열 카테고리 조회   |
| Departments 조회 | 상품 부서 정보 조회     |
| Order 조회       | 주문 상세 정보 확인     |
| 조건 검색          | 요일/시간 기반 주문 필터링 |
| 신규 입력          | 주문 데이터 추가       |
| 수정 기능          | 주문 번호 기반 데이터 수정 |

---

## What I Learned

이 프로젝트를 통해 다음 내용을 직접 구현하며 학습했습니다.

- MySQL 외래키 제약 조건 관리
- 테이블 간 관계 설계
- PHP mysqli 함수 활용
- HTML Form → PHP → DB 데이터 흐름 이해
- 실무에서 사용하는 CRUD 구조 흐름 이해

---

## 향후 계획

1. CSS UI 디자인 적용
2. Pagination 기능 추가
3. 검색 필터 UI 개선
4. Prepared Statement 적용 (보안 강화)
5. 관리자 로그인 기능 추가

---

## Author

* PHP + MySQL Database Web Project
* Localhost 기반 실습 프로젝트

---

## Note

본 프로젝트는 학습 목적의 개인 실습 프로젝트이며  
상용 서비스 목적이 아닌 데이터베이스 및 백엔드 구조 이해를 목표로 제작되었습니다.

---

## 깃헙 업로드 순서

터미널 (order_page 폴더 위치에서)

```bash
git init
git add .
git commit -m "Initial commit - PHP MySQL order management project"
git branch -M main
git remote add origin https://github.com/본인아이디/instacart-order-management-php.git
git push -u origin main
```
