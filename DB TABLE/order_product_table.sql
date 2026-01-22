-- order_product_table.sql

USE hmwkdb;

DROP TABLE IF EXISTS order_products;

CREATE TABLE order_products (
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  add_to_cart_order INT NOT NULL,
  reordered TINYINT NOT NULL,

  -- Instacart 표준: (order_id, product_id)가 사실상 유니크 키
  CONSTRAINT pk_order_products PRIMARY KEY (order_id, product_id),

  CONSTRAINT fk_op_orders
    FOREIGN KEY (order_id) REFERENCES orders (order_id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,

  CONSTRAINT fk_op_products
    FOREIGN KEY (product_id) REFERENCES products (product_id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

  CONSTRAINT chk_reordered CHECK (reordered IN (0,1)),
  CONSTRAINT chk_add_to_cart_order CHECK (add_to_cart_order >= 1)
) ENGINE=InnoDB;

-- 분석/조회 성능
CREATE INDEX ix_op_product_id ON order_products (product_id);
CREATE INDEX ix_op_reordered ON order_products (reordered);

-- 파생 테이블을 "저장"하지 말고 VIEW로(중복 방지, 제출용으로도 깔끔)
DROP VIEW IF EXISTS v_order_products_with_order;

CREATE VIEW v_order_products_with_order AS
SELECT
  op.order_id,
  op.product_id,
  op.add_to_cart_order,
  op.reordered,
  o.user_id,
  o.eval_set,
  o.order_number,
  o.order_dow,
  o.order_hour_of_day,
  o.days_since_prior_order
FROM order_products op
JOIN orders o
  ON op.order_id = o.order_id;