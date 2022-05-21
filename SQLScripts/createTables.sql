CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    company_name VARCHAR(125) NOT NULL,
    description TEXT,
    url VARCHAR(255) NOT NULL,
    visits INT DEFAULT 0 NOT NULL
)  ENGINE=INNODB;


CREATE TABLE IF NOT EXISTS reviews (
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    rating TINYINT UNSIGNED NOT NULL CHECK (
    rating > 0
    AND rating <= 5),
    comment TEXT,

    PRIMARY KEY (product_id, user_id),

    FOREIGN KEY (product_id)
    REFERENCES products(product_id),

    FOREIGN KEY (user_id)
    REFERENCES users(id)
)  ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS visits (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, `date`),
    FOREIGN KEY (product_id)
    REFERENCES products(product_id),
    FOREIGN KEY (user_id)
    REFERENCES users(id)
)  ENGINE=INNODB;