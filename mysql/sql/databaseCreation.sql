CREATE TABLE Customers (
    CustomerID int AUTO_INCREMENT,
    FirstName varchar(255) NOT NULL,
    LastName varchar(255) NOT NULL,
    Email varchar(320) NOT NULL,
    PRIMARY KEY (CustomerID)
);

CREATE TABLE Products (
    ProductName varchar(255),
    Price float NOT NULL,
    Quantity int NOT NULL,
    ProductImage varchar(512),
    PRIMARY KEY (ProductName)
);

CREATE TABLE Orders (
    OrderID int AUTO_INCREMENT,
    OrderTime timestamp NOT NULL,
    CustomerID int NOT NULL,
    ProductName varchar(255) NOT NULL,
    Quantity int NOT NULL, 
    Tax float,
    Donation float,
    PRIMARY KEY (OrderID)
);

INSERT INTO Products
VALUES ('Clarinet', 25, 4, '/images/clarinet.jpg');

INSERT INTO Products
VALUES ('Flute', 25, 1, '/images/flute.jpg');

INSERT INTO Products
VALUES ('Saxophone', 45, 2, '/images/saxophone.jpg');

INSERT INTO Products
VALUES ('Trumpet', 25, 10, '/images/trumpet.jpg');

INSERT INTO Products
VALUES ('French Horn', 50, 3, '/images/french_horn.jpg');

INSERT INTO Products
VALUES ('Trombone', 30, 2, '/images/trombone.jpg');

INSERT INTO Products
VALUES ('Tuba', 60, 0, '/images/tuba.jpg');