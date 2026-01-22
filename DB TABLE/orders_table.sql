-- orders_table.sql
-- XAMPP(MariaDB) compatible

USE hmwkdb;

DROP TABLE IF EXISTS orders;

CREATE TABLE orders (
  order_id INT NOT NULL,
  user_id INT NOT NULL,
  eval_set ENUM('prior','train','test') NOT NULL,
  order_number INT NOT NULL,
  order_dow TINYINT NOT NULL,
  order_hour_of_day TINYINT NOT NULL,
  days_since_prior_order DECIMAL(5,2) NULL,

  CONSTRAINT pk_orders PRIMARY KEY (order_id)
) ENGINE=InnoDB;

CREATE INDEX ix_orders_user_id ON orders (user_id);
CREATE INDEX ix_orders_eval_set ON orders (eval_set);
CREATE INDEX ix_orders_user_order_number ON orders (user_id, order_number);