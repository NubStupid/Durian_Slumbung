-- Create the 'categories' table
CREATE TABLE categories (
    category_id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Insert dummy data into the 'categories' table
INSERT INTO categories (category_id, name) VALUES
    (1, 'Electronics'),
    (2, 'Clothing'),
    (3, 'Books');

-- Create the 'products' table
CREATE TABLE products (
    product_id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

-- Insert dummy data into the 'products' table
INSERT INTO products (product_id, name, price, category_id) VALUES
    (1, 'Laptop', 999.99, 1),
    (2, 'T-shirt', 19.99, 2),
    (3, 'Programming Book', 29.99, 3);

-- Create the 'customers' table
CREATE TABLE customers (
    customer_id INT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

-- Insert dummy data into the 'customers' table
INSERT INTO customers (customer_id, first_name, last_name, email) VALUES
    (1, 'John', 'Doe', 'john.doe@example.com'),
    (2, 'Jane', 'Smith', 'jane.smith@example.com');

-- Create the 'orders' table
CREATE TABLE orders (
    order_id INT PRIMARY KEY,
    customer_id INT,
    order_date DATE NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

-- Insert dummy data into the 'orders' table
INSERT INTO orders (order_id, customer_id, order_date, total_amount) VALUES
    (1, 1, '2023-01-01', 999.99),
    (2, 2, '2023-01-02', 49.98);

-- Create the 'order_items' table
CREATE TABLE order_items (
    order_item_id INT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- Insert dummy data into the 'order_items' table
INSERT INTO order_items (order_item_id, order_id, product_id, quantity, price) VALUES
    (1, 1, 1, 1, 999.99),
    (2, 2, 2, 2, 39.98);