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
    img_url varchar(255)
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
    product_id int references product(product_id)
);

create table h_trans(
    h_trans_id int primary key auto_increment,
    subtotal decimal(10,2) not null,
    username varchar(50) references user(username)
);

create table d_trans(
    d_trans_id int primary key auto_increment,
    total decimal(10,2) not null,
    h_trans_id int references h_trans(h_trans_id),
    product_id int references product(product_id)
);

create table admin(
    username varchar(50) primary key,
    password varchar(50)
);

create table wisata(
    wisata_id int primary key auto_increment,
    tgl_dipesan date not null,
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
(12, 'Desktop Monitor', '200.00', 13, 8, 'Large monitor for immersive computing experience.', 'https://picsum.photos/id/136/200/300'),
(13, 'Graphic Tablet', '150.00', 11, 10, 'Ideal for digital artists and illustrators.', 'https://picsum.photos/id/137/200/300');
