drop database if exists durian_slumbung;

create database durian_slumbung;
use durian_slumbung;

create table user(
    username varchar(50) primary key,
    password varchar(50),
    telp varchar(11),
    poin int default 0
);

create table categories(
    category_id varchar(5) primary key,
    name varchar(50)
);

create table product(
    product_id varchar(5) primary key,
    name varchar(100), 
    price decimal(10,2),
    category_id varchar(5) references category(category_id),
    qty int,
    description longtext,
    img_url varchar(255),
    rate decimal(5,2)
);

create table comment(
    comment_id varchar(5) primary key,
    message longtext,
    username varchar(50) references user(username),
    product_id varchar(5) references product(product_id),
    comment_created_at timestamp default current_timestamp
);

create table rating(
    rate int(1),
    username varchar(50) references user(username),
    product_id varchar(5) references product(product_id)
);

create table likes(
    likes_id varchar(5) primary key,
    username varchar(50) references user(username),
    comment_id varchar(5) references comment(comment_id)
);

create table h_trans(
    h_trans_id varchar(5) primary key,
    invoice_number varchar(20) not null,
    subtotal decimal(10,2) not null,
    username varchar(50) references user(username)
);

create table d_trans(
    d_trans_id varchar(5) primary key,
    qty int(5),
    total decimal(10,2) not null,
    h_trans_id varchar(5) references h_trans(h_trans_id),
    product_id varchar(5) references product(product_id)
);

create table admin(
    username varchar(50) primary key,
    password varchar(50),
    role varchar(1)
);

create table wisata(
    wisata_id varchar(5) primary key,
    tgl_dipesan date,
    sesi int(1),
    qty_orang int(5)
);

-- create table ads(

-- );

create table cart(
    cart_id varchar(5) primary key,
    product_id varchar(5) references product(product_id),
    price decimal(10,2),
    qty int(5),
    username varchar(50) references user(username)
);

-- Insert dummy data for the user table
INSERT INTO user (username, password, telp, poin)
VALUES
    ('user01', 'pass01', '12345678901', 100),
    ('user02', 'pass02', '98765432109', 50),
    ('user03', 'pass03', '55511122334', 75),
    ('user04', 'pass04', '11122233344', 20),
    ('user05', 'pass05', '99988877766', 30),
    ('user06', 'pass06', '44455566677', 80),
    ('user07', 'pass07', '77766655544', 60),
    ('user08', 'pass08', '22233344455', 45),
    ('user09', 'pass09', '66677788899', 10),
    ('user10', 'pass10', '88899900011', 5);

-- Insert dummy data for the categories table
INSERT INTO categories (category_id, name)
VALUES
    ('C0001', 'Electronics'),
    ('C0002', 'Clothing'),
    ('C0003', 'Books'),
    ('C0004', 'Home and Garden'),
    ('C0005', 'Toys'),
    ('C0006', 'Sports and Outdoors'),
    ('C0007', 'Beauty and Personal Care'),
    ('C0008', 'Automotive'),
    ('C0009', 'Health and Household'),
    ('C0010', 'Pet Supplies');

-- Insert dummy data for the product table
INSERT INTO product (product_id, name, price, category_id, qty, description, img_url, rate)
VALUES
    ('P0001', 'Smartphone', 499.99, 'C0001', 100, 'High-end smartphone with great features.', 'https://picsum.photos/id/125/200/300', 4.5),
    ('P0002', 'T-shirt', 19.99, 'C0002', 200, 'Comfortable cotton T-shirt in various colors.', 'https://picsum.photos/id/125/200/300', 4.0),
    ('P0003', 'Programming Book', 29.99, 'C0003', 50, 'Learn programming from scratch.', 'https://picsum.photos/id/125/200/300', 4.8),
    ('P0004', 'Coffee Maker', 89.99, 'C0004', 30, 'Brew your favorite coffee at home.', 'https://picsum.photos/id/125/200/300', 4.2),
    ('P0005', 'Board Game', 24.99, 'C0005', 80, 'Fun for the whole family.', 'https://picsum.photos/id/125/200/300', 4.6),
    ('P0006', 'Outdoor Tent', 149.99, 'C0006', 15, 'Perfect for camping trips.', 'https://picsum.photos/id/125/200/300', 4.3),
    ('P0007', 'Skin Care Set', 39.99, 'C0007', 100, 'Keep your skin healthy and radiant.', 'https://picsum.photos/id/125/200/300', 4.7),
    ('P0008', 'Car Jump Starter', 79.99, 'C0008', 50, 'Never worry about a dead battery.', 'https://picsum.photos/id/125/200/300', 4.4),
    ('P0009', 'Vitamins', 19.99, 'C0009', 120, 'Essential vitamins for a healthy life.', 'https://picsum.photos/id/125/200/300', 4.9),
    ('P0010', 'Pet Toy Set', 14.99, 'C0010', 150, 'Entertain your furry friends.', 'https://picsum.photos/id/125/200/300', 4.1);
    
-- Insert dummy data for the comment table
INSERT INTO comment (comment_id, message, username, product_id)
VALUES
    ('CM001', 'Great product!', 'user01', 'P0001'),
    ('CM002', 'Love the design.', 'user02', 'P0002'),
    ('CM003', 'Very informative book.', 'user03', 'P0003'),
    ('CM004', 'Excellent coffee maker!', 'user04', 'P0004'),
    ('CM005', 'Fun game for the family.', 'user05', 'P0005'),
    ('CM006', 'Easy to set up and use.', 'user06', 'P0006'),
    ('CM007', 'Fantastic skincare set.', 'user07', 'P0007'),
    ('CM008', 'Saved me a few times!', 'user08', 'P0008'),
    ('CM009', 'Best vitamins ever!', 'user09', 'P0009'),
    ('CM010', 'My pets love these toys.', 'user10', 'P0010');

-- Insert dummy data for the rating table
INSERT INTO rating (rate, username, product_id)
VALUES
    (4, 'user01', 'P0001'),
    (5, 'user02', 'P0002'),
    (4, 'user03', 'P0003'),
    (5, 'user04', 'P0004'),
    (4, 'user05', 'P0005'),
    (5, 'user06', 'P0006'),
    (4, 'user07', 'P0007'),
    (5, 'user08', 'P0008'),
    (4, 'user09', 'P0009'),
    (5, 'user10', 'P0010');

-- Insert dummy data for the likes table
INSERT INTO likes (likes_id, username, comment_id)
VALUES
    ('L0001', 'user01', 'CM001'),
    ('L0002', 'user02', 'CM002'),
    ('L0003', 'user03', 'CM003'),
    ('L0004', 'user04', 'CM004'),
    ('L0005', 'user05', 'CM005'),
    ('L0006', 'user06', 'CM006'),
    ('L0007', 'user07', 'CM007'),
    ('L0008', 'user08', 'CM008'),
    ('L0009', 'user09', 'CM009'),
    ('L0010', 'user10', 'CM010');

-- Insert dummy data for the h_trans table
INSERT INTO h_trans (h_trans_id, subtotal, username)
VALUES
    ('HT001', 719.98, 'user01'),
    ('HT002', 39.98, 'user02'),
    ('HT003', 29.99, 'user03'),
    ('HT004', 149.99, 'user04'),
    ('HT005', 124.95, 'user05'),
    ('HT006', 314.97, 'user06'),
    ('HT007', 239.92, 'user07'),
    ('HT008', 159.98, 'user08'),
    ('HT009', 199.80, 'user09'),
    ('HT010', 74.95, 'user10');

-- Insert dummy data for the d_trans table
INSERT INTO d_trans (d_trans_id, qty, total, h_trans_id, product_id)
VALUES
    ('DT001', 2, 499.99, 'HT001', 'P0001'),
    ('DT002', 1, 19.99, 'HT002', 'P0002'),
    ('DT003', 1, 29.99, 'HT003', 'P0003'),
    ('DT004', 1, 89.99, 'HT004', 'P0004'),
    ('DT005', 3, 74.97, 'HT005', 'P0005'),
    ('DT006', 1, 149.99, 'HT006', 'P0006'),
    ('DT007', 2, 79.98, 'HT007', 'P0007'),
    ('DT008', 1, 39.99, 'HT008', 'P0008'),
    ('DT009', 2, 39.98, 'HT009', 'P0009'),
    ('DT010', 1, 14.99, 'HT010', 'P0010');

-- Insert dummy data for the admin table
INSERT INTO admin (username, password, role)
VALUES
    ('admin01', 'adminpass01', 'A'),
    ('admin02', 'adminpass02', 'A'),
    ('mulyono', '123', 'M');

-- Insert dummy data for the wisata table
INSERT INTO wisata (wisata_id, tgl_dipesan, sesi, qty_orang)
VALUES
    ('W0001', '2023-12-01', 1, 5),
    ('W0002', '2023-12-02', 2, 8),
    ('W0003', '2023-12-03', 1, 3),
    ('W0004', '2023-12-04', 2, 6),
    ('W0005', '2023-12-05', 1, 4),
    ('W0006', '2023-12-06', 2, 10),
    ('W0007', '2023-12-07', 1, 7),
    ('W0008', '2023-12-08', 2, 12),
    ('W0009', '2023-12-09', 1, 9),
    ('W0010', '2023-12-10', 2, 15);

-- Insert dummy data for the cart table
INSERT INTO cart (cart_id, product_id, price, qty, username)
VALUES
    ('C0001', 'P0001', 499.99, 2, 'user01'),
    ('C0002', 'P0002', 19.99, 1, 'user02'),
    ('C0003', 'P0003', 29.99, 1, 'user03'),
    ('C0004', 'P0004', 89.99, 1, 'user04'),
    ('C0005', 'P0005', 24.99, 3, 'user05'),
    ('C0006', 'P0006', 149.99, 1, 'user06'),
    ('C0007', 'P0007', 39.99, 2, 'user07'),
    ('C0008', 'P0008', 79.99, 1, 'user08'),
    ('C0009', 'P0009', 19.99, 2, 'user09'),
    ('C0010', 'P0010', 14.99, 1, 'user10');
