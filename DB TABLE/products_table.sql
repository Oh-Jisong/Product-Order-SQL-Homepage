-- products_table.sql

USE hmwkdb;

DROP TABLE IF EXISTS products;

CREATE TABLE products (
  product_id INT NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  aisle_id INT NOT NULL,
  department_id INT NOT NULL,
  CONSTRAINT pk_products PRIMARY KEY (product_id),
  CONSTRAINT fk_products_aisles
    FOREIGN KEY (aisle_id) REFERENCES aisles (aisle_id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
  CONSTRAINT fk_products_departments
    FOREIGN KEY (department_id) REFERENCES departments (department_id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE INDEX ix_products_aisle_id ON products (aisle_id);
CREATE INDEX ix_products_department_id ON products (department_id);