-- aisles_table.sql
-- XAMPP(MariaDB) compatible

USE hmwkdb;

DROP TABLE IF EXISTS aisles;

CREATE TABLE aisles (
  aisle_id INT NOT NULL,
  aisle VARCHAR(70) NOT NULL,
  CONSTRAINT pk_aisles PRIMARY KEY (aisle_id)
) ENGINE=InnoDB;