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
    category_id int primary key auto_increment,
    name varchar(50)
);

create table product(
    product_id int primary key auto_increment, 
    name varchar(100), 
    price decimal(10,2),
    category_id varchar(50) references category(category_id),
    qty int,
    description longtext,
    img_url varchar(255),
    rate decimal(5,2)
);

create table comment(
    comment_id int primary key auto_increment,
    message longtext,
    username varchar(50) references user(username),
    product_id int references product(product_id),
    comment_created_at timestamp default current_timestamp
);

create table rating(
    rating_id int primary key auto_increment,
    rate int(1),
    username varchar(50) references user(username),
    product_id int references product(product_id)
);

create table likes(
    likes_id int primary key auto_increment,
    username varchar(50) references user(username),
    comment_id int references comment(comment_id)
);

create table h_trans(
    h_trans_id int primary key auto_increment,
    subtotal decimal(10,2) not null,
    username varchar(50) references user(username)
);

create table d_trans(
    d_trans_id int primary key auto_increment,
    qty int(5),
    total decimal(10,2) not null,
    h_trans_id int references h_trans(h_trans_id),
    product_id int references product(product_id)
);

create table admin(
    username varchar(50) primary key,
    password varchar(50),
    role varchar(1)
);

create table wisata(
    wisata_id int primary key auto_increment,
    tgl_dipesan date,
    sesi int(1),
    qty_orang int(2)
);

-- create table ads(

-- );

create table cart(
    cart_id int primary key auto_increment,
    product_id int references product(product_id),
    price decimal(10,2),
    qty int(5),
    username varchar(50) references user(username)
);

insert into user (username, password, telp, poin) VALUES
('ferdi','ferdi123','08123456789',0),
('tasya','tasya123','08198765432',0);

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Electronics'),
(2, 'Clothing'),
(3, 'Books'),
(4, 'Appliances'),
(5, 'Footwear'),
(6, 'Fiction Books'),
(7, 'Sports Equipment'),
(8, 'Home and Garden'),
(9, 'Toys'),
(10, 'Beauty and Personal Care'),
(11, 'Automotive'),
(12, 'Jewelry'),
(13, 'Movies'),
(14, 'Music'),
(15, 'Pet Supplies'),
(16, 'Office Supplies'),
(17, 'Health and Wellness'),
(18, 'Food and Beverages'),
(19, 'Outdoor Recreation'),
(20, 'Art and Craft');

INSERT INTO `product` (`product_id`, `name`, `price`, `category_id`, `qty`, `description`, `img_url`) VALUES
(1, 'Jonathan Kenrick\'s Laptop', '1000.00', 18, 15, 'KWNDQP:OWNKDIWQNDOPWQNDwpqd', 'https://picsum.photos/id/125/200/300'),
(2, 'Jane\'s Smartphone', '500.00', 12, 10, 'A sleek smartphone with advanced features.', 'https://picsum.photos/id/126/200/300'),
(3, 'Gaming Console', '300.00', 8, 20, 'Next-gen gaming console for immersive gaming experience.', 'https://picsum.photos/id/127/200/300'),
(4, 'Wireless Headphones', '80.00', 15, 50, 'Enjoy music without the hassle of wires.', 'https://picsum.photos/id/128/200/300'),
(5, 'Coffee Maker', '50.00', 10, 25, 'Brew your favorite coffee with ease.', 'https://picsum.photos/id/129/200/300'),
(6, 'Fitness Tracker', '120.00', 5, 15, 'Monitor your health and stay active.', 'https://picsum.photos/id/130/200/300'),
(7, 'Digital Camera', '250.00', 7, 12, 'Capture moments with high-quality photos.', 'https://picsum.photos/id/131/200/300'),
(8, 'Portable Speaker', '70.00', 15, 40, 'Listen to music on the go with this portable speaker.', 'https://picsum.photos/id/132/200/300'),
(9, 'Laptop Stand', '30.00', 18, 50, 'Improve ergonomics with this adjustable laptop stand.', 'https://picsum.photos/id/133/200/300'),
(10, 'Bluetooth Mouse', '20.00', 18, 30, 'Wireless mouse for convenient computing.', 'https://picsum.photos/id/134/200/300'),
(11, 'External Hard Drive', '120.00', 14, 18, 'Expand your storage capacity with this external hard drive.', 'https://picsum.photos/id/135/200/300'),
(12, 'Desktop Monitor', '200.00', 13, 8, 'Large monitor for immersive computing experience.', 'https://picsum.photos/id/136/200/300');

insert into comment(comment_id, message, username, product_id) VALUES
('0','Test123456', 'ferdi', 1),
('0','Test123456', 'tasya', 2),
('0','Test123456', 'ferdi', 3),
('0','Test123456', 'ferdi', 4),
('0','Test123456', 'tasya', 5),
('0','Test123456', 'ferdi', 6),
('0','Test123456', 'ferdi', 7),
('0','Test123456', 'tasya', 8),
('0','Test123456', 'ferdi', 9),
('0','Test123456', 'tasya', 12);

insert into rating VALUES
('0',5,'tasya',1),
('0',4,'tasya',1),
('0',5,'ferdi',10),
('0',3,'tasya',9),
('0',1,'ferdi',2),
('0',3,'ferdi',1),
('0',4,'ferdi',1);

insert into likes VALUES
('0', 'tasya', 1),
('0', 'tasya', 3),
('0', 'tasya', 4),
('0', 'ferdi', 5),
('0', 'ferdi', 2);

insert into h_trans VALUES
('0', 230000, 'tasya'),
('0', 300000, 'ferdi');

insert into d_trans VALUES
('0', 2, 30000, 1, 5),
('0', 2, 200000, 1, 3),
('0', 4, 100000, 2, 2),
('0', 3, 200000, 2, 6);

insert into admin VALUES
('blaba', 'hiu', 'a'),
('blebe', 'bebek', 'a'),
('mulyono', '123', 'm');

insert into cart VALUES
('0', 1, 300000, 5, 'tasya'),
('0', 2, 100000, 3, 'ferdi');

insert into wisata (wisata_id, sesi, qty_orang) VALUES
('0', 2, 50),
('0', 1, 20);
