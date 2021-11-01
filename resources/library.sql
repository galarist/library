DROP DATABASE IF EXISTS library;
CREATE DATABASE library;
USE library;

/*CREATE USERS TABLE*/
CREATE TABLE users (
    userID int NOT NULL AUTO_INCREMENT,
    permission int,
    firstName varchar(255),
    lastName varchar(255),
    username varchar(255),
    email varchar(255),
    password varchar(255),
    PRIMARY KEY (userID)
);

INSERT INTO users
    (userID, permission, firstName, lastName, username, email, password)
VALUES 
    (1, 1, "John", "Doe", "John", "John@example.com", "$2y$12$RSy9zywha1Qlg0ml2fYD4OfnZrESDu2v5h8jOXwNr4dO/HURLF6nO"),
    (2, 1, "Jane", "Doe", "Jane", "Jane@example.com", "$2y$12$RSy9zywha1Qlg0ml2fYD4OfnZrESDu2v5h8jOXwNr4dO/HURLF6nO");

/*CREATE TABLE FOR BOOKS*/
CREATE TABLE books (
    bookID int NOT NULL AUTO_INCREMENT,
    title varchar(255),
    author varchar(255),
    bookPlot LONGTEXT,
    published int,
    ranking float,
    copies int,
    PRIMARY KEY (bookID)
);
/*CREATE TABLE FOR BOOK COVERS*/
CREATE TABLE covers (
    bookID int NOT NULL references books(bookID),
    cover varchar(255),
    PRIMARY KEY (bookID)
);

ALTER TABLE covers 
ADD FOREIGN KEY (bookID) REFERENCES books(bookID);

ALTER TABLE covers
ADD CONSTRAINT FK_BooCov_Cascade_Delete
FOREIGN KEY (bookID) 
REFERENCES books(bookID)
ON DELETE CASCADE;