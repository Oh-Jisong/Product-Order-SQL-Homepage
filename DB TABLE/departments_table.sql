-- departments_table.sql
-- XAMPP(MariaDB) compatible

USE hmwkdb;

DROP TABLE IF EXISTS departments;

CREATE TABLE departments (
  department_id INT NOT NULL,
  department VARCHAR(70) NOT NULL,
  CONSTRAINT pk_departments PRIMARY KEY (department_id)
) ENGINE=InnoDB;